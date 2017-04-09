<?php

namespace App\models\dao;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\models\dao\Iftag;

class Usuario extends Authenticatable
{       
    use Notifiable;

    protected $hidden = [
        'usuario_senha', 'remember_token',
    ];

    protected $fillable = [
        'usuario_nome',
        'usuario_sobrenome',
        'usuario_data_nasc',
        'usuario_data_cadastro',
        'usuario_prontuario',
        'email',
        'senha',
        'usuario_descricao',
        'usuario_cargo',
        'usuario_experiencia',
        'usuario_estado_acesso'
    ];

    
    protected $table      = 'usuario';	//define a tabela a ser operada
    public    $timestamps =  false;			//desabilita a gravação de data de alteração na tabela

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

}
