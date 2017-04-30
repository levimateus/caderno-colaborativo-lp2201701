<?php

namespace App\models\dao;

use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    protected $table = 'denuncia'; //define a tabela a ser operada
    public    $timestamps = false; //desabilita a gravação de data na alteração na tabela

    /*
    **  MÉTODOS DE DEFINIÇÃO DE RELACIONAMENTO
    */

    /*  Referencia...
    */
    
    public function autor(){
    	return $this->belongsTo('Apps\models\dao\Usuario', 'usuario_id_autor');
    }

    public function avaliador(){
    	return $this->belongsTo('Apps\models\dao\Usuario', 'usuario_id_avaliador');
    }

    public function comentario(){
    	return $this->belongsTo('Apps\models\dao\Comentario');
    }

    public function publicacao(){
    	return $this->belongsTo('Apps\models\dao\Publicacao');
    }

}
