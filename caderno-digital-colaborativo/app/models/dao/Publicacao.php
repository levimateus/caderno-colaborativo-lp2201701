<?php

namespace App\models\dao;

use Illuminate\Database\Eloquent\Model; 
use App\models\dao\Iftag;

class Publicacao extends Model
{

	/*
	**  MÉTODOS DE DEFINIÇÃO DE RELACIONAMENTO
	*/
	public      $fillable     = [
		'publicacao_titulo', 
		'publicacao_legenda', 
		'publicacao_status', 
		'publicacao_dt', 
		'publicacao_tags', 
		'usuario_id_autor', 
		'usuario_id_publicacao', 
		'publicacao_descricao', 
		'publicacao_area'];
	protected   $table        = 'publicacao';	//define a tabela a ser operada
	public      $timestamps   =  false;		//desabilita a gravação de data de alteração na tabela
	protected $primaryKey = 'publicacao_id'; // or null
	
	/*  Referencia...
	*/

	static function listarPosts() { 
		return Publicacao::all();
	}
	
	static function listarPostId($id) { 
		return static::where('publicacao_id', '=', $id)->get()->first();;
	}

	public function autor(){
		return $this->belongsTo('App\models\dao\Usuario', 'usuario_id_autor', 'usuario_id');
	}

	public function professor(){
		return $this->belongsTo('App\models\dao\Usuarios', 'usuario_id_professor', 'usuario_id');
	}

	//interesses
//    public function iftags(): BelongsToMany{
//        return $this->belongsToMany(Iftag::class,'relacionamento_publicacao_tags' , 'publicacao_id', 'iftag_id');
//    }

	/*  É referenciado por...
	*/

	public function comentarios(){
		return $this->hasMany('App\models\dao\Comentario');
	}

	public function denuncias(){
		return $this->hasMany('App\models\dao\Denuncia');
	}

	public function  midia(){
		return $this->hasOne('App\models\dao\Midia', 'midia_id', 'midia_id');
	}


	public function like(Post $post) {
		$existing_like = Like::withTrashed()->wherePostId($post->id)->whereUserId(Auth::id())->first();

		if (is_null($existing_like)) {
			Like::create([
				'post_id' => $post->id,
				'user_id' => Auth::id()
			]);
		} else {
			if (is_null($existing_like->deleted_at)) {
				$existing_like->delete();
			} else {
				$existing_like->restore();
			}
		}
	}

	public function isLikedByMe($id){
		$post = $this->listarPostId($id);
		if (Like::whereUserId(Auth::id())->wherePostId($post->publicacao_id)->exists()){
			return 'true';
		}
		return 'false';
	}

	public function likes(){
		return $this->belongsToMany('App\User', 'likes');
	}
	
}
