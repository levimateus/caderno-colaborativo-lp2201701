<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\dao\Comentario;

class ComentarioController extends Controller
{
    static function listarTodos() {
    	return Comentario::listarTodos();
    }
}
