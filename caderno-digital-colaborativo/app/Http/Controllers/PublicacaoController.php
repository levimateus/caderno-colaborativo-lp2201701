<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicacaoController extends Controller
{
    public function index(){
    	//exibir esta publicão
    }

    public function publicar(array $dados){
    	//adiciona uma nova publicação
    }

    public function excluir(){
    	//exclui publicação
    }

    public function editar(array $dados){
    	//edita publicação
    }

    public function curtir(){
    	//curte uma publicação
    }

    public function comentar(){
    	//comentar publicação
    }
}
