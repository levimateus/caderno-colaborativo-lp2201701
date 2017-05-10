<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\dao\Like;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ComentarioController;
use Illuminate\Http\RedirectResponse;

class ComentarioController extends Controller
{
    static function listarTodos() {
    	return Comentario::listarTodos();
    }

    public function inserir(Request $request) {
        $coment = new Like;
        $coment->comentario_conteudo = $request->input('comentario');
        $coment->comentario_pub_dt = Carbon::now();
        $coment->status = 1;
        $coment->publicacao_id = $request->input('publicacao');
        $coment->usuario_id = Auth::id();
        $coment->save();

        return redirect('post/' . $request->input('publicacao'));
    }
}
