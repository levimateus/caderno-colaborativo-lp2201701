<?php

namespace App\models\dao;

use Illuminate\Database\Eloquent\Model;

class GamificacaoNivel extends Model {
    /*
     * *  MÉTODOS DE DEFINIÇÃO DE RELACIONAMENTO
     */

    protected $table = 'gamificacao_nivel'; //define a tabela a ser operada

    protected $primaryKey = 'gnivel_id'; // or null

    public $fillable = [
        'gnivel_nivel',
        'gnivel_pontos',
        'gnivel_nome',
        'gnivel_descricao',
    ];

    public $timestamps = false;   //desabilita a gravação de data de alteração na tabela



}
