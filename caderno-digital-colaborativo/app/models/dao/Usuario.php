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
    public function iftags() {
        return $this->belongsToMany(Iftag::class,'relacionamento_interesses' , 'publicacao_id', 'iftag_id');
    }

    //seguidores
      public function seguidores() {
        return $this->belongsToMany(Usuario::class,'relacionamento_seguidores' , 'usuario_id_seguidor', 'usuario_id_seguindo');
    }

      public function seguindo() {
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

    public function inserir($dados)
    {
        echo "<h1>Inserção no banco de dados</h1>";
        echo($dados['nome']);
        echo("<br>");
        echo($dados['sobrenome']);
        echo("<br>");
        echo($dados['dataNasc']);
        echo("<br>");
        
        //validacao simples: fazer uma validacao completa
        if($dados['nome']==""){
            return;
        }

        $usuario = new Usuario;

        $usuario->usuario_nome          =     utf8_decode($dados['nome']         );
        $usuario->usuario_sobrenome     =     utf8_decode($dados['sobrenome']    );
        $usuario->usuario_data_nasc     =     utf8_decode($dados['dataNasc']     );
        $usuario->usuario_prontuario    =     utf8_decode($dados['prontuario']   );
        $usuario->usuario_email         =     utf8_decode($dados['email']        );
        $usuario->usuario_senha         = md5(utf8_decode($dados['senha'])       );
        $usuario->usuario_descricao     =     utf8_decode($dados['descricao']    );
        $usuario->usuario_cargo         =     utf8_decode($dados['cargo']        );
        $usuario->usuario_experiencia   =     utf8_decode($dados['experiencia']  );
        $usuario->usuario_estado_acesso =     utf8_decode($dados['estadoAcesso'] );
        
        $usuario->save();
    }

}
