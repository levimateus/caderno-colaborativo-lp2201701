<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\dao\Denuncia;
use App\Mail\Report;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class DenunciaController extends Controller
{

    public function index()
    {
        $professor = DB::table('usuario')->where('usuario_cargo', Auth::id())->get();

        if (!empty($professor[0])) {
            $reports = DB::table('denuncia')->where('usuario_id_avaliador', Auth::id())->get();
            return view('report.reports', compact('reports'));
        } else {
            $message = "Opa! :( parece que você não é um professor";
            return redirect('home')->with('message', $message);
        }
    }

    public function bloquear($id) {
        $report = new Report;
        $data = $collection->get();
        $collection->update(array("status" => "sent"));
    }


    public function novaDenuncia(Request $request) {
        $report = new Denuncia;

        $report->denuncia_motivo = $request->input('denuncia_motivo');
        $report->denuncia_dt = Carbon::now();
        $report->usuario_id_autor = Auth::id();
        $report->usuario_id_avaliador = $request->input('usuario_id_avaliador');
        $report->publicacao_id = $request->input('publicacao_id');
        $report->comentario_id = $request->input('comentario_id');

        if ($report->save()) {
            $message = "Denuncia enviada com sucesso! :)";
        } else {
            $message = "Ocorreu um erro inesperado! :(";
        }

        $prof = DB::table('usuario')->where('usuario_id', $report->usuario_id_avaliador)->get();

        if ($prof[0]->usuario_email) {
            $email = $prof[0]->usuario_email;
            \Mail::to($email)->send(new Report);
        }


        return redirect('home')->with('message', $message);
    }
}
