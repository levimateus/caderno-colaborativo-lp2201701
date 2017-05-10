<?php

namespace App\models\dao;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
	protected $table 	  = 'comentario';	 //define a tabela a ser operada
	public 	  $timestamps = false;			 //desabilita a gravação de data de alteração na tabela

    /*
    **  MÉTODOS DE DEFINIÇÃO DE RELACIONAMENTO
    */

	public function denuncias(){
		return $this->belongsTo('Apps\models\dao\Denuncia');
	}

	public function publicacao(){
		return $this->belongsTo('App\models\dao\Publicacao', 'publicacao_id');
	}

	public function usuario(){
		return $this->belongsTo('App\models\dao\Usuario', 'usuario_id');
	}


	
}
