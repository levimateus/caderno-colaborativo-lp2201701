<?php

namespace App\Http\Controllers;


use App\models\dao\Usuario;
use App\models\dao\Publicacao;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\dao\Comentario;
use App\models\dao\Midia;
use App\models\dao\Like;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;


class PesquisaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        switch ($request->tipo_pesquisa) {
            //case 'iftags':
            //  $usuarios = Usuario::pesquisarUsuariosNome($request->pesquisa);
            //  return view('pesquisa', compact('usuarios'));
            //  break;

            case 'publicacoes':
                $posts = Publicacao::pesquisarPostsDescricao($request->pesquisa);
                $professores = DB::table('usuario')->where('usuario_cargo', 3)->get();
                $comments = Comentario::listarTodos();
                $likes = Like::listarLikes();
                $idUser = Auth::id();



                return view('home', compact('posts','professores','comments', 'likes', 'idUser'));
            break;
                
            case 'usuarios':
                $usuarios = Usuario::pesquisarUsuariosNome($request->pesquisa);


                $midias = [];

                foreach ($usuarios as $usuario) {

                    $midiaId = $usuario->media_id;
                    if($midiaId != null){
                        $midia = Midia::findOrFail($midiaId);

                        $midias[] = $midia;
                    }
                    

                }
                return view('pesquisa', compact('usuarios', 'midias'));
            break;
        }
    }

}
