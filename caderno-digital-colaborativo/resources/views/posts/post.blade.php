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
    <div class="row">
        <form role="form"  method="POST" action="/comment" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input class="col-sm-10 center-align" type="text" name="comentario" id="comentario" class="form-control" value="" required="required" title="">
            <input class="col-sm-2" type="hidden" name="publicacao" value="{{$post->publicacao_id}}">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
    <span><a href="/post/{{ $post->publicacao_id }}">Saiba mais</a></span>
</article>