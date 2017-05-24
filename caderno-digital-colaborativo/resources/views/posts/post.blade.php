<article class="post ifBlock">
    <div class="post-header clearfix title"> 
        <span class="pull-left">#{{$post->publicacao_id}}</span>
        <span class="dropdown pull-right">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
                <li>
                    <a 
                        type="button" 
                        class="pull-right" 
                        id="abrir_report" 
                        data-toggle="modal" 
                        data-target=".newReport.post{{$post->publicacao_id}}"
                    >
                        Denunciar <i class="fa fa-bullhorn" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
        </span>

        <span class="pull-right">{{$post->publicacao_dt}} </span>
    </div>
    <div class="post-img">
        <img src="{{ asset('storage')}}/{{ $post->midia->midia_href}}" class="img-responsive">

    </div>
    <div class="post-info clearfix title">
        <span class="pull-left">AutorId: {{$post->usuario_id_autor}}</span>
        <span class="pull-right"> Professor: {{$post->usuario_id_professor}}</span>
    </div>
    <div class="post-desc">
        <p>
            Descrição:  {{$post->publicacao_descricao}}
        </p>
    </div>
    <div class="comments">
        @foreach($comments as $comment)
            @if($post->publicacao_id == $comment->publicacao_id)
                @include('comments.comment')
            @endif
        @endforeach
    </div>
    <form role="form"  method="POST" action="/comment" accept-charset="UTF-8" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="clearfix">
            <input class="col-sm-9 center-align" type="text" placeholder="Comente aqui.." name="comentario" id="comentario" class="form-control" value="" required="required" title="">
            <input type="hidden" name="publicacao" value="{{$post->publicacao_id}}">

            <button type="submit" class="btn btn-primary btn-if col-sm-3">Enviar</button>
        </div>
    </form>
    <span><a href="/post/{{ $post->publicacao_id }}">Saiba mais</a></span>
</article>

<div class="report">
    @include('report.report')
</div>