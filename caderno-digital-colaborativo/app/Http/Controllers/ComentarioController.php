<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\dao\Comentario;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ComentarioController;
use Illuminate\Http\RedirectResponse;
use App\Helpers\GamificacaoHelper;

class ComentarioController extends Controller
{
    static function listarTodos() {
    	return Comentario::listarTodos();
    }

    public function comentar(Request $request) {
        $coment = new Comentario;
        $coment->comentario_conteudo = $request->input('comentario');
        $coment->comentario_pub_dt = Carbon::now();
        $coment->status = 1;
        $coment->publicacao_id = $request->input('publicacao');
        $coment->usuario_id = Auth::id();
        $coment->save();

        //adicionando pontos para usuario do comentario
        GamificacaoHelper::gamificacao(Auth::id(), 'comentario', $coment->comentario_id);
        
        return redirect('post/' . $request->input('publicacao'));
    }


    public static function updateStatusComent($id, $status) {
        $updatePost = DB::table('comentario')
                        ->where('comentario_id', $id )
                        ->update(array("status" => $status));

        If ($updatePost) {

            return true;
        } else {
            
            return false;
        }

    }
}
