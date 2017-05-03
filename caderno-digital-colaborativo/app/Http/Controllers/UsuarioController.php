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
        echo "<h1>Importação do post</h1>";

    	//$f 				= $request->file('arquivo');
    	$listaRegistros = $this->lerArquivo(/*$f*/);
        echo "<h1>Essa parte é onde os dados são passados para o banco</h1>";
        foreach ($listaRegistros as $registro) {
            $linha = array(
                    'nome'       => $registro['Nome'].PHP_EOL,
                    'sobrenome'  => $registro['Sobrenome'].PHP_EOL,
                    'prontuario' => $registro['Prontuario'].PHP_EOL,
                    'senha'      => $registro['RG'].PHP_EOL,
                    'dataNasc'   => implode("-",array_reverse(explode("/",$registro['DataNasc']))).PHP_EOL, 
                    'email'      => '',
                    'descricao'  => '',
                    'cargo'      => 0,
                    'experiencia' => 0,
                    'estadoAcesso' => 0
                );

            echo "<h3>Usuario</h3>";
            echo "<pre>";
            print_r($linha);
            echo "</pre>";
            echo "<br>";

            $usuario = new Usuario;
            $usuario->inserir($linha);
        }
    }
    
   	public function lerArquivo(/*$f*/){
        $f = fopen('..\listaImportar.csv', 'r');

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
        echo "<pre>";
        print_r($listaRegistros);
        echo "</pre>";

        return $listaRegistros;
    }
}


