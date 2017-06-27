<article class="post ifBlock">
    <div class="post-header clearfix title"> 
        <span class="pull-left">#{{$post->publicacao_id}}</span>
        <span class="pull-right">{{$post->publicacao_dt}} </span>
    </div>
    <div class="post-img">
        <img src="{{ asset('storage')}}/{{ $post->midia->midia_href}}" class="img-responsive">
    </div>
    <div class="post-info clearfix title">
        <div class="col-sm-12">
            <span class="pull-left">AutorId: {{$post->usuario_id_autor}}</span>
            <span class="pull-right"> Professor: {{$post->usuario_id_professor}}</span>
        </div>
        <div class="col-sm-3 pull-right">
            <button  class="btn btn-default like btn-login form-control" type="submit" name="like" id="like" value="" disabled="disabled">
                @php
                    $contagemLike = 0;
                    $liked = '';
                @endphp
                @if (count($likes) > 0)
                    @foreach ($likes as $like)
                        @if ($like->publicacao_id == $post->publicacao_id and $like->comentario_id == null)
                            @php
                            $contagemLike++;
                            @endphp
                        @endif
                    @endforeach
                    {{$contagemLike }}
                    @foreach ($likes as $like)
                        @if($idUser == $like->usuario_id and $like->comentario_id == null and $like->publicacao_id == $post->publicacao_id)
                            @php
                            $liked = 'liked'
                            @endphp
                        @endif
                    @endforeach
                @endif
                <i class="fa {{$liked}} fa-heart"></i>
            </button>
        </div>
    </div>
    <div class="post-desc">
        <p>
            Descrição:  {{$post->publicacao_descricao}}
        </p>
    </div>
    <span><a href="/post/{{ $post->publicacao_id }}">Saiba mais</a></span>
</article>