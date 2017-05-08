<article class="post ifBlock">
    <h4> {{$post->publicacao_area}} </h4>
    <div class="post-img">
        <img src="{{ asset('storage')}}/{{ $post->midia->midia_href}}" class="img-responsive">

    </div>

    <span>
        Area: {{$post->publicacao_area}}
    </span>
    
    <div class="post-info clearfix">
        <span>
            AutorId: {{$post->usuario_id_autor}}
        </span>
        <span>
            Professor: {{$post->usuario_id_professor}}
        </span>
    </div>
    <hr>
    <h5>Descrição</h5>
    <p>
        {{$post->publicacao_descricao}}
    </p>
    <hr>
    <div class="comments">
        @foreach($comments as $comment)
            @if($post->publicacao_id == $comment->publicacao_id)
                @include('comments.comment')
            @endif
        @endforeach
    </div>
    <span><a href="/post/{{ $post->publicacao_id }}">Saiba mais</a></span>
</article>