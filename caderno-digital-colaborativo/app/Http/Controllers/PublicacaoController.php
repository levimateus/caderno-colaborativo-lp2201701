<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\dao\Publicacao;
use App\models\dao\Comentario;
use App\models\dao\Midia;
use App\models\dao\Like;
use App\models\dao\Iftag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class PublicacaoController extends Controller
{
    public function index() {

        $professores = DB::table('usuario')->where('usuario_cargo', 3)->get();
        $comments = Comentario::listarTodos();
        $posts = Publicacao::listarPosts();
        $likes = Like::listarLikes();
        $idUser = Auth::id();

        return view('home', compact('posts','professores','comments', 'likes', 'idUser'));
    }

    public function show($id) {
        $professores = DB::table('usuario')->where('usuario_cargo', 3)->get();
        $comments = ComentarioController::listarTodos();
        $post = Publicacao::listarPostId($id);
        $likes = Like::listarLikes();
        $idUser = Auth::id();

        return view('posts.show', compact('post','professores','comments', 'likes', 'idUser'));
    }

    public function publicar(Request $request) {
        $post = new Publicacao;
        //$post->publicacao_descricao = $request->descricao;
        $post->publicacao_descricao = $request->input('descricao');
        $post->publicacao_area = $request->input('area');
        $post->publicacao_dt = Carbon::now();
        $post->publicacao_status = 1;
        $post->usuario_id_autor = Auth::id();
        $post->usuario_id_professor = $request->input('professor');
        $post->midia_id = $this->getObtainMedia($request);
        //$post->save();

        $iftag = new Iftag;
        $tagsExistentes = $iftag->listarIfTags();
        $tagsNomesExistentes = array();
        foreach ($tagsExistentes as $key => $tag) {
            $tagsNomesExistentes[] = $tag['iftag_nome']);
        }

        $tags = $request->input('tags');
        $tags = str_replace(' ', '', $tags);
        $tags = str_replace('.', '', $tags);
        $tags = str_replace(',', '', $tags);
        $tags = explode('#', $tags); 
        foreach ($tags as $key => $tag) {
            $iftag->publicacao_id;
            $iftag->iftag_nome = $tag;
            if (!in_array($tag, $tagsNomesExistentes)) {
                $iftag->save();
                $relacionamento = new RelacionamentoPublicacaoTag;
                // $relacionamento->iftag_id = 
                // $relacionamento->publicacao_id = 
            }
        }

        $post->publicacao_tags = $request->input('tags');

        return $this->index();
    }

    /**
     * Metodo auxliar para gravar a midia no Model dela e logo, retorna o id para salvar no post (publicacao).
     * @param type $request
     * @return int
     */
    private function getObtainMedia($request) {
        $uploadedfile = $request->file('midia');
        if ($uploadedfile->isValid()) {

            //dados do arquivo subido http://api.symfony.com/3.0/Symfony/Component/HttpFoundation/File/UploadedFile.html 
            //echo $uploadedfile->getClientOriginalName();            
            
            ////nesse comando vamos armazenar o upload e vai retornar a rota do arquivo que foi guardado.
            $rotadoarquivo = Storage::disk('public')->put('publicacoes', $uploadedfile); 
           
            //o arquivo é salvo com outro nome.

            $midia = new Midia;
            $midia->midia_tipo = 1; //TIPO 1.
            $midia->midia_href = $rotadoarquivo;
            $resultado = $midia->save(); //retorna true se foi salvo

            $idgerado = 0;

            if ($resultado) {
                $idgerado = $midia->getKey();
            } else {
                $idgerado = 0;
                //ou lancar excecao
            }

            return $idgerado;
        }else{
            //LANCAR EXCECAO
        }
    }

    /**
     * Teste usando a url "post/id da publicacao"
     * 
     * https://laravel.com/docs/5.4/controllers#defining-controllers
     * 
     * @param type $id
     */
    public function ver($id) {
        //https://laravel.com/docs/5.4/eloquent-relationships#one-to-one
        $post = Publicacao::findOrFail($id);
        $midia = $post->midia;
        /**
          para ver as imagens
          php artisan storage:link
         * 
         */
        echo asset("storage/".$midia->midia_href);
        echo "<img src ='".asset("storage/app/public/publicacoes/".$midia->midia_href)."' />";
    }

    public function excluir() {
        //exclui publicação
    }

    public function editar(array $dados){
        //edita publicação
    }

    public function curtir(){
        //curte uma publicação
    }

    public function comentar(){
        //comentar publicação
    }
}
