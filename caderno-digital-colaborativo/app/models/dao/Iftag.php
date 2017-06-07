<?php

namespace App\models\dao;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\models\dao\Publicacao;
use App\models\dao\Usuario;

class Iftag extends Model
{

    /*
    **  MÉTODOS DE DEFINIÇÃO DE RELACIONAMENTO
    */
    public $fillable = ['iftag_nome'];

    protected $table	  = 'iftag';	//define a tabela a ser operada	
    public    $timestamps = false;		//desabilita a gravação de data na alteração na tabela
    protected $primaryKey = 'iftag_id'; // or null

    //interesses
    static function listarIftags() { 
        return Iftag::all();
    }

    public function iftagsUsuario(): BelongsToMany{
        return $this->belongsToMany(Usuario::class,'relacionamento_interesses' , 'iftag_id', 'usuario_id');
    }

    public function iftagsPublicacao(): BelongsToMany{
        return $this->belongsToMany(Publicacao::class, 'relacionamento_publicacao_tags', 'iftag_id', 'publicacao_id');
    }
}
