<?php

namespace App\models\dao;

use Illuminate\Database\Eloquent\Model;

class UsuarioGamificacao extends Model {
    /*
     * *  MÉTODOS DE DEFINIÇÃO DE RELACIONAMENTO
     */

    protected $table = 'usuario_gamificacao'; //define a tabela a ser operada

    protected $primaryKey = 'usuario_gamificacao_id'; // or null

    public $fillable = [
        'usuario_id',
        'gacao_id',
        'usuario_acao_id',
        'data',
        'pontos'
    ];

    public $timestamps = false;   //desabilita a gravação de data de alteração na tabela



}
