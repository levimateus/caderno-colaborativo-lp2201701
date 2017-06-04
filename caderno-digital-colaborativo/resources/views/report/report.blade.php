<article class="report ifBlock">
    <h4>Denuncia: {{ $report->denuncia_id }}</h3>
    <h4>Data: {{ $report->denuncia_dt }} </h4>
    <h5>Autor da denuncia: {{ $report->usuario_id_autor }} </h5>
    <div class="report-content">
        <span>Motivo: </span>
        <p>
           {{ $report->denuncia_motivo }} 
        </p>
    </div>

    <form role="form"  method="POST" action="/report/block/{{ $report->denuncia_id }}" accept-charset="UTF-8" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($report->publicacao_id)
            <input type="hidden" name="id" value="{{$report->publicacao_id}}">
        @else
            <input type="hidden" name="id" value="{{$report->comentario_id}}">
        @endif

        <button type="submit" class="btn btn-if" data-toggle="tooltip" title="Bloquear Publicação">
            <i class="fa fa-lock" aria-hidden="true"></i>
        </button>
    </form>

    <form role="form"  method="POST" action="/report/discard/{{ $report->denuncia_id }}" accept-charset="UTF-8" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($report->publicacao_id)
            <input type="hidden" name="id" value="{{$report->publicacao_id}}">
        @else
            <input type="hidden" name="id" value="{{$report->comentario_id}}">
        @endif
        <button class="btn btn-if-down" data-toggle="tooltip" title="Descartar denuncia">
            <i class="fa fa-trash-o" aria-hidden="true"></i>
        </button>
    </form>
    <span><a href="/post/{{ $report->denuncia_id }}">Saiba mais</a></span>
</article>