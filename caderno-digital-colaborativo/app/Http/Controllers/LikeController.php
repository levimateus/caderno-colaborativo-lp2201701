<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\dao\Like;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class LikeController extends Controller
{
    public function inserir(Request $request) {

        $existing_like = Like::where('publicacao_id', $request->input('publicacao'))->where('usuario_id', Auth::id())->first();

        if ($existing_like) {
            Like::where('publicacao_id', $request->input('publicacao'))->where('usuario_id', Auth::id())->delete();

            return redirect('home/');
        } else {
            $coment = new Like;
            $coment->usuario_id = Auth::id();
            $coment->publicacao_id = $request->input('publicacao');
            $coment->comentario_id = $request->input('comentario');
            $coment->save();

            return redirect('home/');
        }
    }

    static function verificaLike($idPublicacao = null, $idComentario = null) {
        $existing_like = Like::where('publicacao_id', $request->input('publicacao'))->where('usuario_id', Auth::id())->first();

        if ($existing_like) {
            return 'liked';
        }
    }
}