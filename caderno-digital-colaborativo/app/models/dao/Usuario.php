<?php

namespace App\models\dao;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\models\dao\Iftag;

class Usuario extends Model
{       
    
    protected $table = 'usuario';
    public $timestamps = false;
    protected $primaryKey = 'usuario_id';
    

    /*
    **  MÉTODOS DE DEFINIÇÃO DE RELACIONAMENTO
    */

    /*  Referencia...
    */

	public function fotoPerfil(){
    	return $this->hasOne('App\models\dao\Midia');
    }

    //interesses
    public function iftags(): BelongsToMany{
        return $this->belongsToMany(Iftag::class,'relacionamento_interesses' , 'publicacao_id', 'iftag_id');
    }

    //seguidores
      public function seguidores(): BelongsToMany{
        return $this->belongsToMany(Usuario::class,'relacionamento_seguidores' , 'usuario_id_seguidor', 'usuario_id_seguindo');
    }

      public function seguindo(): BelongsToMany{
        return $this->belongsToMany(Usuario::class,'relacionamento_seguidores' , 'usuario_id_seguindo', 'usuario_id_seguidor');
    }


    /*  É referenciado por...
    */

    public function publicacoes(){
    	return $this->hasMany('App\models\dao\Publicacao', 'publicacao_id_autor');
    }

 	public function citacoesPublicacoes(){
 		return $this->hasMany('App\models\dao\Publicacao', 'publicacao_id_professor');
    }

    public function comentarios(){
    	return $this->hasMany('App\models\dao\Comentario');
    }

    public function denuncias(){
    	return $this->hasMany('App\models\dao\Denuncias', 'usuario_id_autor');
    }

    public function avaliacoesDenuncias(){
    	return $this->hasMany('App\models\dao\Denuncias', 'usuario_id_avaliador');
    }

    /*  inserir novo registro
    */

    public static function inserir(Array $dados)
    {
        date_default_timezone_set('Brazil/East');
        // Validate the request...

        $usuario = new Usuario;

        $usuario->usuario_nome          = isset($dados['nome'])       ? '' : $dados['nome'];
        $usuario->usuario_sobrenome     = isset($dados['sobrenome'])  ? '' : $dados['sobrenome'];
        $usuario->usuario_data_nasc     = isset($dados['dataNasc'])   ? '' : $dados['dataNasc'];
        $usuario->usuario_data_cadastro = date('Y-m-d H:i:s');
        $usuario->usuario_prontuario    = isset($dados['prontuario']) ? '' : $dados['prontuario'];
        //$usuario->usuario_email         = isset($dados['email'])      ? '' : $dados['email'];
        $usuario->usuario_senha         = isset($dados['prontuario'])   ? '' : $dados['prontuario'];
        //$usuario->usuario_descricao     = isset($dados['descricao'])  ? '' : $dados['descricao'];
        //$usuario->usuario_cargo         = isset($dados['cargo'])       ? '' : $dados['cargo'];
        //$usuario->usuario_experiencia   = isset($dados['experiencia'])  ? '' : $dados['experiencia'];
        //$usuario->usuario_estado_acesso = isset($dados['estadoAcesso'])  ? '' : $dados['estadoAcesso'];

        $usuario->usuario_cargo = 0;
        $usuario->usuario_estado_acesso = 0;
        $usuario->usuario_experiencia = 0;
        $usuario->usuario_estado_acesso = 0;

        $usuario->save();
    }

}
