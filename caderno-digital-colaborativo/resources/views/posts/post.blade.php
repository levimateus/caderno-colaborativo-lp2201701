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
                        id="abrir_report" 
                        data-toggle="modal" 
                        data-target=".newReport.post{{$post->publicacao_id}}"
                    >
                        <button class="btn btn-if-down pull-right" type="button"  >
                            Denunciar <i class="fa fa-bullhorn" aria-hidden="true"></i>    
                        </button>
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
        <div class="col-sm-12">
            <span class="pull-left">AutorId: {{$post->usuario_id_autor}}</span>
            <span class="pull-right"> Professor: {{$post->usuario_id_professor}}</span>
        </div>
        <div class="col-sm-3 pull-right">
            <form role="form"  method="POST" action="/like" accept-charset="UTF-8" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="publicacao" value="{{$post->publicacao_id}}">
                <button  class="btn btn-default like btn-login form-control" type="submit" name="like" id="like" value="">
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
            </form>
        </div>
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

<div class="report-modal">
    @include('report.reportModal')
</div>