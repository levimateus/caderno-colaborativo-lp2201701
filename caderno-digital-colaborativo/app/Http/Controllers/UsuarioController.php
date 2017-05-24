<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\dao\Usuario;
use Carbon\Carbon;
class UsuarioController extends Controller
{

	public function index()
    {
        return view('csv');
    }


    public function importar(Request $request){
        echo "<h1>Importação dos usuários</h1>"; 
    	$f  = $request->file('arquivo'); 
        //echo $f;
    	$listaRegistros = $this->lerArquivo($f);
        //echo "<h1>Essa parte é onde os dados são passados para o banco</h1>";        
        foreach ($listaRegistros as $registro) {            
            //Essa linha converte o texto em formato d/m/Y para um Date. Usamos a biblioteca Carbon. (http://carbon.nesbot.com/)
            $datanasc = Carbon::createFromFormat('d/m/Y', $registro['DataNasc']);
            $linha = array(
                    'nome'       => $registro['Nome'],
                    'sobrenome'  => $registro['Sobrenome'],
                    'prontuario' => $registro['Prontuario'],
                    'senha'      => $registro['RG'],
                    'dataNasc'   => $datanasc,   
                    'email'      => 'gu'.$registro['Prontuario'],
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
    
   	public function lerArquivo($arquivo){
        $f = fopen($arquivo, 'r');
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
        /*echo "<pre>";
        print_r($listaRegistros);
        echo "</pre>";*/

        return $listaRegistros;
    }
}


