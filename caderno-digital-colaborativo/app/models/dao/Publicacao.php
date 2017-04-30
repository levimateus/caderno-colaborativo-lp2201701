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

    
}
