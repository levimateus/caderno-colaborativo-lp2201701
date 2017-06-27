<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\dao\Publicacao;
use App\models\dao\Like;
use Illuminate\Support\Facades\Storage;
use App\models\dao\Midia;
use App\models\dao\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        return view('perfil.perfil', compact('usuario', 'fotoPerfil', 'seguindo', 'seguidores','id_usuario','nivel_nome', 'comments', 'posts', 'likes', 'idUser', 'professores'));
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
        //corrigir query
        //seguindo
        $seguindo   = DB::table('relacionamento_seguidores')
        ->join('usuario', 'relacionamento_seguidores.usuario_id_seguidor', '=', 'usuario.usuario_id')
        ->select('usuario.usuario_nome')
        ->where('usuario_id_seguidor', '=', $id_usuario)->get();
        var_dump($seguindo);
        exit();
        // $seguidor1['usuario_nome'] = 'Guilherme';
        // $seguidor2['usuario_nome'] = 'Mateus';
        // $seguidor3['usuario_nome'] = 'Luis';
        // $seguidor4['usuario_nome'] = 'Gustavo';
        // $seguidor5['usuario_nome'] = 'Lucas';
        // $seguidor5['usuario_nome'] = 'Ana';
        // $seguindo = array();
        // array_push($seguindo, $seguidor1);
        // array_push($seguindo, $seguidor2);
        // array_push($seguindo, $seguidor3);
        // array_push($seguindo, $seguidor4);
        // array_push($seguindo, $seguidor5);

        return view('perfil.seguindo', compact('id_usuario','seguindo'));
    }

    public function getSeguidores($id_usuario = 0){
        return view('perfil.seguidores', compact('id_usuario'));
    }
}

