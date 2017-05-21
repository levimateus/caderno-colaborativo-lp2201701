<?php

namespace App\models\dao;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\models\dao\Iftag;

class Usuario extends Model
{       
    
    protected $table      = 'usuario';
    public    $timestamps = false;
    protected $primaryKey = 'usuario_id';
    

    /*
    **  MÉTODOS DE DEFINIÇÃO DE RELACIONAMENTO
    */

    /*  Referencia...
    */

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
        return $this->hasOne('App\models\dao\Midia', 'midia_id', 'media_id');
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
        /***** PARA TESTES *************/
        /*echo 'Fuso horário: '.date_default_timezone_get('America/Sao_Paulo');
        echo "<h1>Inserção no banco de dados</h1>";
        echo($dados['nome']);
        echo("<br>");
        echo($dados['sobrenome']);
        echo("<br>");
        echo($dados['dataNasc']);
        echo("<br>");*/
        
        $dataCadastro = date('Y-m-d H:i:s');

        //validacao simples: fazer uma validacao completa
        if($dados['nome']==""){
            return;
        }


        $usuario = new Usuario;


        $usuario->usuario_nome          =     array_key_exists('nome', $dados) 
                                                    ? utf8_decode($dados['nome']) : '';

        $usuario->usuario_sobrenome     =     array_key_exists('sobrenome', $dados) 
                                                    ? utf8_decode($dados['sobrenome']) : '';

        $usuario->usuario_data_nasc     =     array_key_exists('dataNasc', $dados) 
                                                    ? utf8_decode($dados['dataNasc']) : '';

        $usuario->usuario_data_cadastro  =    utf8_decode($dataCadastro);

        $usuario->usuario_prontuario    =     array_key_exists('prontuario', $dados) 
                                                    ? utf8_decode($dados['prontuario']) : '';

        $usuario->usuario_email         =     array_key_exists('email', $dados) 
                                                    ? utf8_decode($dados['email']) : '';

        $usuario->usuario_senha         = md5(array_key_exists('senha', $dados) 
                                                    ? utf8_decode($dados['senha']) : '');

        $usuario->usuario_descricao     =     array_key_exists('descricao', $dados) 
                                                    ? utf8_decode($dados['descricao']) : '';

        $usuario->usuario_cargo         =     array_key_exists('cargo', $dados) 
                                                    ? utf8_decode($dados['cargo']) : 0;

        $usuario->usuario_experiencia   =     array_key_exists('experiencia', $dados) 
                                                    ? utf8_decode($dados['experiencia']) : 0;

        $usuario->usuario_estado_acesso =     array_key_exists('estadoAcesso', $dados) 
                                                    ? utf8_decode($dados['estadoAcesso']) : 0;

        $usuario->media_id              =     array_key_exists('mediaId', $dados) 
                                                    ? utf8_decode($dados['mediaId']) : NULL;
        
        $usuario->save();
    }

}
