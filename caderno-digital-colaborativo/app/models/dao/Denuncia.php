<?php

namespace App\models\dao;

use App\models\dao\Denuncia;

use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    const ATIVO = 1;
    const INATIVO = 2;
    const AVALIADO = 3;


    public      $fillable     = [
        'denuncia_motivo', 
        'denuncia_dt', 
        'usuario_id_autor', 
        'usuario_id_avaliador', 
        'publicacao_id', 
        'comentario_id'];
    protected   $table        = 'denuncia';   //define a tabela a ser operada
    public      $timestamps   =  false;     //desabilita a gravação de data de alteração na tabela
    protected $primaryKey = 'denuncia_id';

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
