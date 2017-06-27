@extends('layouts.app')

@section('content')


<div class="panel panel-default">
    <div class="panel-body">
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th style="text-align:center">Seguindo</th>
                    <th style="text-align:center">*</th>
                </tr>
            </thead>
            <tbody>
                @foreach($seguindo as $seguidor)
                    <tr>
                        <td>{{$seguidor['usuario_nome']}}</td>
                        <td>botao</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{$id_usuario}}

@endsection
