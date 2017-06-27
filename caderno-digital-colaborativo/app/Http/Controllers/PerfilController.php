<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\dao\Publicacao;
use App\models\dao\Like;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\models\dao\Midia;
use App\models\dao\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class PerfilController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id_usuario = 0) {

        //Se o usuario nao eh espeficado no /perfil/{usuario_id} pegamos o usuario autenticado        
        if($id_usuario == 0){
            $id_usuario = Auth::id();
        }
        //procuramos o usuario na base de dados -> estamos usando sintaxes eloquent
        $usuario = Usuario::find($id_usuario);

        //quantidade de usuáros que está seguindo
        $seguindo   = DB::table('relacionamento_seguidores')->where('usuario_id_seguidor', '=', $id_usuario)->count('*');
        //quantidade de seguidores
        $seguidores = DB::table('relacionamento_seguidores')->where('usuario_id_seguindo', '=', $id_usuario)->count('*');

        $nivel_nome = \GamificacaoHelper::getNivelDescricao($usuario->usuario_experiencia);
        //carregando a foto do perfil
        $midia = $usuario->fotoPerfil;
        if ($midia != null) {
            //se existe colocamos a variavel fotoPerfil com o valor midia_href da tabela midia.
            $fotoPerfil = asset('storage') . '/' . $midia->midia_href;
        } else {
            //se nao existir carregamos a imagem do /public/img/avatar-default.png
            $fotoPerfil = asset('img') . '/' . 'avatar-default.png';
        }

        //recuperar os posts do usuário dono deste perfil
        $professores = DB::table('usuario')->where('usuario_cargo', 3)->get();
        $comments    = DB::table('comentario')->where('status',"!=", 2)->get();
        $posts       = Publicacao::listarPostsPerfil($id_usuario);
        $likes       = Like::listarLikes();
        $idUser      = Auth::id();


        //verificar se o usuário logado segue esse usuário, caso não esteja acessando o próprio perfil
        if ($id_usuario != Auth::id()) {
            $estou_seguindo = $this->verificaSeguidor($id_usuario);
        }

        return view('perfil.perfil', compact('usuario', 'fotoPerfil', 'seguindo', 'seguidores','id_usuario','nivel_nome', 'comments', 'posts', 'likes', 'idUser', 'professores','estou_seguindo'));
    }

    public function trocarFoto(Request $request) {

        $usuario_id = Auth::id();
        //obtemos o usuario do formulario de trocarFoto
        $usuario = Usuario::find($usuario_id);

        //modificamos o campo media_id com o gerado pelo upload
        $usuario->media_id = $this->getObtainMedia($request);

        //finalmente salvamos
        $usuario->save();

        //redireccionando para tela de perfil
        return redirect('perfil');
    }

    private function getObtainMedia($request) {
        $uploadedfile = $request->file('foto'); //modificamos para bater com o formulario de trocar foto        

        if ($uploadedfile->isValid()) {

            //dados do arquivo subido http://api.symfony.com/3.0/Symfony/Component/HttpFoundation/File/UploadedFile.html 
            //echo $uploadedfile->getClientOriginalName();            
            ////nesse comando vamos armazenar o upload e vai retornar a rota do arquivo que foi guardado.
            $rotadoarquivo = Storage::disk('public')->put('usuarios', $uploadedfile);

            //o arquivo é salvo com outro nome.

            $midia = new Midia;
            $midia->midia_tipo = 1; //TIPO 1.
            $midia->midia_href = $rotadoarquivo;
            $resultado = $midia->save(); //retorna true se foi salvo

            $idgerado = 0;

            if ($resultado) {
                $idgerado = $midia->getKey();
            } else {
                $idgerado = 0;
                //ou lancar excecao
            }

            return $idgerado;
        } else {
            //LANCAR EXCECAO
        }
    }

    public function getSeguindo($id_usuario = 0){
        //usuários que ele está seguindo
        $seguindo = DB::table('relacionamento_seguidores')
        ->join('usuario', 'relacionamento_seguidores.usuario_id_seguindo', '=', 'usuario.usuario_id')
        ->select('usuario.usuario_nome', 'usuario.usuario_sobrenome', 'usuario.usuario_id')
        ->where('relacionamento_seguidores.usuario_id_seguidor', '=', $id_usuario)->get();
        //verificar quais destes usuários estou seguindo
        $estou_seguindo = array(); 
        foreach ($seguindo as $seguido) {
            $estou_seguindo[$seguido->usuario_id] = $this->verificaSeguidor($seguido->usuario_id);
        }
        return view('perfil.seguindo', compact('id_usuario','seguindo','estou_seguindo'));
    }

    public function getSeguidores($id_usuario = 0){
        //usuários que estão o seguindo
        $seguidores = DB::table('relacionamento_seguidores')
        ->join('usuario', 'relacionamento_seguidores.usuario_id_seguidor', '=', 'usuario.usuario_id')
        ->select('usuario.usuario_nome', 'usuario.usuario_sobrenome', 'usuario.usuario_id')
        ->where('relacionamento_seguidores.usuario_id_seguindo', '=', $id_usuario)->get();
        //verificar quais destes usuários estou seguindo
        $estou_seguindo = array(); 
        foreach ($seguidores as $seguidor) {
            $estou_seguindo[$seguidor->usuario_id] = $this->verificaSeguidor($seguidor->usuario_id);
        }
        return view('perfil.seguidores', compact('id_usuario', 'seguidores', 'estou_seguindo'));
    }

    public function verificaSeguidor($id_usuario){
        $verifica = DB::table('relacionamento_seguidores')
        ->where('usuario_id_seguidor', '=', Auth::id())
        ->where('usuario_id_seguindo', '=', $id_usuario)
        ->first();
        if ($verifica) {
            return true;
        }else{
            return false;
        }
    }

    public function seguir(Request $request){
        $id_usuario = $request->input('id_usuario');
        DB::table('relacionamento_seguidores')->insert(
            ['usuario_id_seguidor' => Auth::id(), 'usuario_id_seguindo' => $id_usuario]
        );
        //veio pela tela de perfil (1)
        $pagina = $request->input('pagina');
        if ($pagina == 1) {
            return redirect('perfil/'.$id_usuario);
        }elseif ($pagina == 2) {
            return redirect('seguidores/'.Auth::id());
        }elseif($pagina == 3){
            return redirect('seguidores/'.$id_usuario);
        }elseif ($pagina == 4) {
            return redirect('seguindo/'.Auth::id());
        }elseif($pagina == 5){
            return redirect('seguindo/'.$id_usuario);
        }
    }

    public function deixarDeSeguir(Request $request){
        $id_usuario = $request->input('id_usuario');
        $relacionamento_seguidores = DB::table('relacionamento_seguidores')
        ->where('usuario_id_seguidor', '=', Auth::id())
        ->where('usuario_id_seguindo', '=', $id_usuario)->delete();
        //veio pela tela de perfil (1)
        $pagina = $request->input('pagina');
        if ($pagina == 1) {
            return redirect('perfil/'.$id_usuario);
        }elseif ($pagina == 2) {
            return redirect('seguidores/'.Auth::id());
        }elseif($pagina == 3){
            return redirect('seguidores/'.$id_usuario);
        }elseif ($pagina == 4) {
            return redirect('seguindo/'.Auth::id());
        }elseif($pagina == 5){
            return redirect('seguindo/'.$id_usuario);
        }
    }
}

