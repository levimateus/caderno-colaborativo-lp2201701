<article class="report ifBlock">
    <h4>Denuncia: {{ $report->denuncia_id }}</h3> 
    @if ($report->status == 1) 
        <span class="pull-right">Status: Aguardando Avaliação</span>
    @else 
        <span class="pull-right">Status: Avaliado</span>
    @endif


    <h4>Data: {{ $report->denuncia_dt }} </h4>
    <h5>Autor da denuncia: {{ $report->usuario_id_autor }} </h5>
    <div class="report-content">
        <span>Motivo: </span>
        <p>
           {{ $report->denuncia_motivo }} 
        </p>
    </div>

    <form role="form"  method="POST" action="/report/block" accept-charset="UTF-8" enctype="multipart/form-data">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-if" data-toggle="tooltip" title="Bloquear Publicação">
            <i class="fa fa-lock" aria-hidden="true"></i>
        </button>

        @if ($report->publicacao_id)
            <span>Bloquear publicação!</span>
            <input type="hidden" name="postId" value="{{$report->publicacao_id}}">
        @else
            <span>Bloquear comentário!</span>
            <input type="hidden" name="postId" value="{{$report->comentario_id}}">
        @endif
        <input type="hidden" name="report" value="{{$report->denuncia_id}}">
    </form>

    <form role="form"  method="POST" action="/report/discard" accept-charset="UTF-8" enctype="multipart/form-data">
        {{ csrf_field() }}
        <button class="btn btn-if-down" data-toggle="tooltip" title="Descartar denuncia">
            <i class="fa fa-trash-o" aria-hidden="true"></i>
        </button>

        @if ($report->publicacao_id)
            <input type="hidden" name="postId" value="{{$report->publicacao_id}}">
        @else
            <input type="hidden" name="postId" value="{{$report->comentario_id}}">
        @endif
        <input type="hidden" name="report" value="{{$report->denuncia_id}}">

        <span>Descartar Denúncia!</span>
    </form>
    <span><a href="/post/{{ $report->denuncia_id }}">Saiba mais</a></span>
</article>