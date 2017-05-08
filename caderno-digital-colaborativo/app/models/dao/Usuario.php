<?php

namespace App\models\dao;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\models\dao\Iftag;

class Usuario extends Model
{       
    
    protected $table      = 'usuario';	//define a tabela a ser operada
    public    $timestamps =  false;			//desabilita a gravação de data de alteração na tabela

    private function lerArquivo($f){
        $delimitador = ';';
        $cerca = '"';
        
        if ($f) {

            // Ler cabecalho do arquivo
            $cabecalho = fgetcsv($f, 0, $delimitador, $cerca);
            // Enquanto nao terminar o arquivo
            while (!feof($f)) {

                // Ler uma linha do arquivo
                $linha = fgetcsv($f, 0, $delimitador, $cerca);
                if (!$linha) {
                    continue;
                }

                // Montar registro com valores indexados pelo cabecalho
                $registro = array_combine($cabecalho, $linha);

                // Obtendo o nome
                $listaRegistros[] = $registro;
            }
            fclose($f);
        }
        return $listaRegistros;
    }

    public function importar($f){
        $listaRegistros = lerArquivo($f);

        foreach ($listaRegistros as $registro) {
            $linha = array(
                    nome        => $registro['Nome'].PHP_EOL,
                    sobrenome   => $registro['Sobrenome'].PHP_EOL,
                    prontuario   => $registro['Prontuario'].PHP_EOL,
                    password   => $registro['RG'].PHP_EOL,
                    dataNasc   => $registro['DataNasc'].PHP_EOL,
                );

            inserir($linha);
        }
    }

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

    public function inserir(Array $dados)
    {
        // Validate the request...

        $usuario = new Usuario;

        $usuario->usuario_nome          = isset($dados->nome)       ? '' : $dados->nome;
        $usuario->usuario_sobrenome     = isset($dados->sobrenome)  ? '' : $dados->sobrenome;
        $usuario->usuario_data_nasc     = isset($dados->dataNasc)   ? '' : $dados->dataNasc;
        $usuario->usuario_data_cadastro = $date = date('Y-m-d H:i');
        $usuario->usuario_prontuario    = isset($dados->prontuario) ? '' : $dados->prontuario;
        $usuario->email                 = isset($dados->email)      ? '' : $dados->email;
        $usuario->passoword             = isset($dados->password)   ? '' : $dados->password;
        $usuario->usuario_descricao     = isset($dados->descricao)  ? '' : $dados->descricao;
//o que deveria fazer essas 3 linhas abaixo?
//        $usuario->usuario_cargo         = isset($dados->0)          ? '' : $dados->0;
//        $usuario->usuario_experiencia   = isset($dados->0)          ? '' : $dados->0;
//        $usuario->usuario_estado_acesso = isset($dados->0)          ? '' : $dados->0;
        
        $usuario->save();
    }

}
