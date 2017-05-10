<?php

namespace App\models\dao;

use Illuminate\Database\Eloquent\Model;

class Midia extends Model {
    /*
     * *  MÉTODOS DE DEFINIÇÃO DE RELACIONAMENTO
     */

    protected $primaryKey = 'midia_id'; // or null
    public $fillable = [
        'midia_tipo',
        'midia_href'
    ];
    protected $table = 'midia'; //define a tabela a ser operada
    public $timestamps = false;   //desabilita a gravação de data de alteração na tabela

    public function usuario() {
        return $this->belongsTo('App\models\dao\Usuario');
    }

    public function publicacao() {
        return $this->belongsTo('App\models\dao\Publicacao');
    }

}
