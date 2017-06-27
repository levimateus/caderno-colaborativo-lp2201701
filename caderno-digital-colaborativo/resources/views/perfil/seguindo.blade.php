@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-body">
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th style="text-align:center">Seguindo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($seguindo as $seguidor)
                    <tr>
                        <td>
                            <div class="pull-left">
                                <a style="color:#000000;" href="{{'/perfil/'.$seguidor->usuario_id }}">
                                    {{$seguidor->usuario_nome}}
                                </a>
                            </div> 
                            <div class="pull-right">
                                <button class="btn btn-success">Seguir</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection