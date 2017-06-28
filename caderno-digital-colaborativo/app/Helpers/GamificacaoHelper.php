<?php
namespace App\Helpers;
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
use App\models\dao\GamificacaoAcao;
use App\models\dao\UsuarioGamificacao;

class GamificacaoHelper {
    
    public static function getNivelDescricao($pontos){
        if($pontos==NULL){
            $pontos = 0;
        }
        $gnivel_pontos = \App\models\dao\GamificacaoNivel::
                where('gnivel_pontos', '<=', $pontos)
                ->orderBy('gnivel_pontos', 'desc')
                ->first();
        
        return $gnivel_pontos->gnivel_nome;
        
    }
    
    public static function gamificacao($usuarioId , $acao, $publicaoId){
        
        $pontos = GamificacaoHelper::verificaPontos($acao);
        GamificacaoHelper::adicionaPontos($usuarioId, $pontos);
        GamificacaoHelper::registrarGamificacao($usuarioId, $acao, $publicaoId, $pontos);
    }
    
    public static function retiraPonto($usuarioId , $acao, $publicaoId){
        
        $pontos = GamificacaoHelper::getPontosGanhos($usuarioId , $acao, $publicaoId);
        GamificacaoHelper::removerPontosdoPerfil($usuarioId, $pontos);
        GamificacaoHelper::removerGamificacao($usuarioId , $acao, $publicaoId);        
    }
        
    private static function getPontosGanhos($usuarioId , $acao, $publicacaoId){
        $gacao = GamificacaoAcao::where('gacao_descricao', $acao)->first();
        
        $usuario_gamificacao = UsuarioGamificacao::
                where('usuario_id', $usuarioId)
                ->where('gacao_id', $gacao->gacao_id)
                ->where('usuario_acao_id', $publicacaoId)
                ->first();
        return $usuario_gamificacao->pontos;
    }
    
    
    private static function removerPontosdoPerfil($usuarioId, $pontos){        
        $usuario = \App\models\dao\Usuario::where('usuario_id', $usuarioId)->first();
        $pontosAtuais = $usuario->usuario_experiencia;
        
        $usuario->usuario_experiencia = $pontosAtuais - $pontos;
        $usuario->save();
    }
    
    private static function removerGamificacao($usuarioId , $acao, $publicacaoId){
        $gacao = GamificacaoAcao::where('gacao_descricao', $acao)->first();
        
        $usuario_gamificacao = UsuarioGamificacao::
                where('usuario_id', $usuarioId)
                ->where('gacao_id', $gacao->gacao_id)
                ->where('usuario_acao_id', $publicacaoId)
                ->delete();
    }
    
    private static function verificaPontos($acao){
        $gacao = GamificacaoAcao::where('gacao_descricao', $acao)->first();
        return $gacao->gacao_pontos;
    }
    
    
    private static function adicionaPontos($usuarioId, $pontos){        
        $usuario = \App\models\dao\Usuario::where('usuario_id', $usuarioId)->first();
        $pontosAtuais = $usuario->usuario_experiencia;
        
        $usuario->usuario_experiencia = $pontosAtuais + $pontos;
        $usuario->save();
    }
    
    private static function registrarGamificacao($usuarioId, $acao, $publicaoId, $pontos){
        $gacao = GamificacaoAcao::where('gacao_descricao', $acao)->first();
        
        $usuarioGamificacao = new UsuarioGamificacao();
        $usuarioGamificacao->usuario_id = $usuarioId;
        $usuarioGamificacao->gacao_id =  $gacao->gacao_id;
        $usuarioGamificacao->usuario_acao_id =  $publicaoId;
        $usuarioGamificacao->data =  Carbon::now();
        $usuarioGamificacao->pontos =  $pontos;        
        $usuarioGamificacao->save();
    }
}
