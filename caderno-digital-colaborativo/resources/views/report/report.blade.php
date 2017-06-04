<article class="report ifBlock">
    <h3>{{ $report->denuncia_id }}</h3>
    <p>
       {{ $report->denuncia_motivo }} 
    </p>
    {{ $report->denuncia_dt }}
    {{ $report->usuario_id_autor }}
    <span><a href="/post/{{ $report->denuncia_id }}">Saiba mais</a></span>
</article>