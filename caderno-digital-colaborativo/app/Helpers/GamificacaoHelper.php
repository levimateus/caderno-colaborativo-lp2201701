<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewMessage
 *
 * @author Jane Asher
 */


use Carbon\Carbon;

class GamificacaoHelper {
    
    public static function getNivelDescricao($pontos){
        $gnivel_pontos = \App\models\dao\GamificacaoNivel::
                where('gnivel_pontos', '<', $pontos)
                ->orderBy('gnivel_pontos', 'desc')
                ->first();
        return $gnivel_pontos->gnivel_nome;
        
    }
    
    public static function gamificacao($usuarioId , $acao, $publicaoId){
        
        $pontos = GamificacaoHelper::verificaPontos($acao);
        GamificacaoHelper::adicionaPontos($usuarioId, $pontos);
        GamificacaoHelper::registrarGamificacao($usuarioId, $acao, $publicaoId, $pontos);
    }
    
    
    public static function verificaPontos($acao){
        $gacao = App\models\dao\GamificacaoAcao::where('gacao_descricao', $acao)->first();
        return $gacao->gacao_pontos;
    }
    
    
    public static function adicionaPontos($usuarioId, $pontos){        
        $usuario = \App\models\dao\Usuario::where('usuario_id', $usuarioId)->first();
        $pontosAtuais = $usuario->usuario_experiencia;
        
        $usuario->usuario_experiencia = $pontosAtuais + $pontos;
        $usuario->save();
    }
    
    public static function registrarGamificacao($usuarioId, $acao, $publicaoId, $pontos){
        $gacao = App\models\dao\GamificacaoAcao::where('gacao_descricao', $acao)->first();
        
        $usuarioGamificacao = new \App\models\dao\UsuarioGamificacao();
        $usuarioGamificacao->usuario_id = $usuarioId;
        $usuarioGamificacao->gacao_id =  $gacao->gacao_id;
        $usuarioGamificacao->usuario_acao_id =  $publicaoId;
        $usuarioGamificacao->data =  Carbon::now();
        $usuarioGamificacao->pontos =  $pontos;        
        $usuarioGamificacao->save();
    }
}
