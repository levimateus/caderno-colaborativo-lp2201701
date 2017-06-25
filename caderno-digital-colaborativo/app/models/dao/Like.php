<?php

namespace App\models\dao;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Like extends Model
{
        protected $primaryKey = 'like_id'; // or null
	
	public      $fillable     = [
		'uduario_id',
		'publicacao_id',
		'comentario_id']; 
	protected $table 	  = 'likes_relacionamento';	 //define a tabela a ser operada
	public 	  $timestamps = false;			 //desabilita a gravação de data de alteração na tabela

    /*
    **  MÉTODOS DE DEFINIÇÃO DE RELACIONAMENTO
    */

	public function denuncias(){
		return $this->belongsTo('Apps\models\dao\Denuncia');
	}

	static function listarLikes() { 
		return Like::all();
	}

	
}
