<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\models\dao\Midia;
use App\models\dao\Usuario;
use Illuminate\Support\Facades\Auth;

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

        //carregando a foto do perfil
        $midia = $usuario->fotoPerfil;
        if ($midia != null) {
            //se existe colocamos a variavel fotoPerfil com o valor midia_href da tabela midia.
            $fotoPerfil = asset('storage') . '/' . $midia->midia_href;
        } else {
            //se nao existir carregamos a imagem do /public/img/avatar-default.png
            $fotoPerfil = asset('img') . '/' . 'avatar-default.png';
        }

        return view('perfil.perfil', compact('usuario', 'fotoPerfil'));
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

}

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\models\dao\Midia;
use App\models\dao\Usuario;
use Illuminate\Support\Facades\Auth;

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

        //carregando a foto do perfil
        $midia = $usuario->fotoPerfil;
        if ($midia != null) {
            //se existe colocamos a variavel fotoPerfil com o valor midia_href da tabela midia.
            $fotoPerfil = asset('storage') . '/' . $midia->midia_href;
        } else {
            //se nao existir carregamos a imagem do /public/img/avatar-default.png
            $fotoPerfil = asset('img') . '/' . 'avatar-default.png';
        }

        return view('perfil.perfil', compact('usuario', 'fotoPerfil'));
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

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\models\dao\Midia;
use App\models\dao\Usuario;
use Illuminate\Support\Facades\Auth;

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

        return view('perfil.perfil', compact('usuario', 'fotoPerfil', 'nivel_nome'));
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

}