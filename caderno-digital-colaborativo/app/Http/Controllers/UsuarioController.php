<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\dao\Usuario;

class UsuarioController extends Controller
{

	 public function index()
    {
        return view('csv');
    }


    public function importar(Request $request){
        echo "importando";

    	//$f 				= $request->file('arquivo');
    	$listaRegistros = $this->lerArquivo(/*$f*/);

        foreach ($listaRegistros as $registro) {
            $linha = array(
                    'nome'       => $registro['Nome'].PHP_EOL,
                    'sobrenome'  => $registro['Sobrenome'].PHP_EOL,
                    'prontuario' => $registro['Prontuario'].PHP_EOL,
                    'password'   => $registro['RG'].PHP_EOL,
                    'dataNasc'   => $registro['DataNasc'].PHP_EOL,
                );

            Usuario::inserir($linha);
        }
    }
    
   	public function lerArquivo(/*$f*/){
        $f = fopen('C:\Users\Aluno\Desktop\caderno-digital-colaborativo\listaImportar.csv', 'r');

        $delimitador = ';';
        $cerca = '"';
        $listaRegistros = array();
        if ($f) {

            // Ler cabecalho do arquivo
            $cabecalho = fgetcsv($f, 0, $delimitador, $cerca);
            // Enquanto nao terminar o arquivo
            while (!feof($f)) {

                // Ler uma linha do arquivo
                $linha = fgetcsv($f, 0, $delimitador, $cerca);
                if (!$linha) {
                    continue;
                }

                // Montar registro com valores indexados pelo cabecalho
                $registro = array_combine($cabecalho, $linha);

                // Obtendo o nome
                $listaRegistros[] = $registro;


            }
            fclose($f);
        }
        return $listaRegistros;
    }
}


