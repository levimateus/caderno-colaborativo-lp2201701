<article class="report ifBlock">
    <div class="report-modal-user">
        @include('report.reportModalUser')
    </div>
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

    <!-- Caso já tenha sido avaliado não é exibido essa opção de bloquear o post ou o comentário -->
    @if ($report->status == 1)

        <hr>
        <b><span>Penitencializar autor do objeto da denuncia</span></b><br>
        <a 
            id="abrir_report" 
                data-toggle="modal" 
                data-target=".newReport.report{{$report->denuncia_id}}"
        >
            <button  class="btn btn-default btn-if-down form-control text-center" type="button" data-toggle="tooltip" title="Penitencializar autor" >
                <i class="fa fa-address-card" aria-hidden="true"></i>
            </button>
        </a><br>
        <form role="form"  method="POST" action="/report/block" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            @if ($report->publicacao_id)
                <hr>
                <b><span>Bloquear publicação!</span></b><br>
                <button type="submit" class="btn btn-if form-control text-center" data-toggle="tooltip" title="Bloquear Publicação">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                </button>
                <input type="hidden" name="postId" value="{{$report->publicacao_id}}"><br>
            @else
                <hr>
                <b><span>Bloquear comentário!</span></b><br>
                <button type="submit" class="btn btn-if form-control text-center" data-toggle="tooltip" title="Bloquear Comentário">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                </button>
                <input type="hidden" name="comentId" value="{{$report->comentario_id}}"><br>
            @endif
            <input type="hidden" name="report" value="{{$report->denuncia_id}}">
        </form>
    @endif

    <form role="form"  method="POST" action="/report/discard" accept-charset="UTF-8" enctype="multipart/form-data">
        {{ csrf_field() }}
        <hr>
        <b><span>Descartar Denúncia!</span></b><br>
        <button class="btn btn-if-down form-control text-center" data-toggle="tooltip" title="Descartar denuncia">
            <i class="fa fa-trash-o" aria-hidden="true"></i>
        </button>

        @if ($report->publicacao_id)
            <input type="hidden" name="postId" value="{{$report->publicacao_id}}">
        @else
            <input type="hidden" name="comentId" value="{{$report->comentario_id}}">
        @endif
        <input type="hidden" name="report" value="{{$report->denuncia_id}}">

    </form>
    <span><a href="/post/{{ $report->denuncia_id }}">Saiba mais</a></span>
</article>