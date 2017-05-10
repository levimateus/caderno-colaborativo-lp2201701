<?php

namespace App\models\dao;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
	public      $fillable     = [
		'uduario_id',
		'publicacao_id',
		'comentario_id']; 
	protected $table 	  = 'like_relacionamento';	 //define a tabela a ser operada
	public 	  $timestamps = false;			 //desabilita a gravação de data de alteração na tabela

    /*
    **  MÉTODOS DE DEFINIÇÃO DE RELACIONAMENTO
    */

	public function denuncias(){
		return $this->belongsTo('Apps\models\dao\Denuncia');
	}

	static function listarTodos() { 
        return Comentario::all();
    }

	
}
