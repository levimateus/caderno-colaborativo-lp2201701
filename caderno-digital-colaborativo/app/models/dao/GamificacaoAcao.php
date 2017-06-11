<?php

namespace App\models\dao;

use Illuminate\Database\Eloquent\Model;

class GamificacaoAcao extends Model {
    /*
     * *  MÉTODOS DE DEFINIÇÃO DE RELACIONAMENTO
     */

    protected $table = 'gamificacao_acao'; //define a tabela a ser operada

    protected $primaryKey = 'gacao_id'; // or null

    public $fillable = [
        'gacao_descricao',
        'gacao_pontos'
    ];

    public $timestamps = false;   //desabilita a gravação de data de alteração na tabela



}
