<?php

namespace App\models\dao;

use Illuminate\Database\Eloquent\Model;

class RelacionamentoPublicacaoTag extends Model
{

    /*
    **  MÉTODOS DE DEFINIÇÃO DE RELACIONAMENTO
    */
    public $fillable = [
                'iftag_id',
                'publicacao_id'];

    protected $table	  = 'relacionamento_publicacao_tags';	//define a tabela a ser operada	
    public    $timestamps = false;		//desabilita a gravação de data na alteração na tabela

    //interesses

    public function listarRelacionamentoPublicacaoTags() {
        return Iftag::all();
    }

}