<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\dao\Denuncia;

use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

class DenunciaController extends Controller
{
    public function novaDenuncia(Request $request) {
        $report = new Denuncia;

        $report->denuncia_motivo = $request->input('denuncia_motivo');
        $report->denuncia_dt = Carbon::now();
        $report->usuario_id_autor = Auth::id();
        $report->usuario_id_avaliador = $request->input('usuario_id_avaliador');
        $report->publicacao_id = $request->input('publicacao_id');
        $report->comentario_id = $request->input('comentario_id');

        $report->save();

        return redirect('home');
    }
}
