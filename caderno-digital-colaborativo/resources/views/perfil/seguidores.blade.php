@extends('layouts.app')

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">
		<div class="panel-title" style="padding-bottom:50px">
			<div class="pull-left">
				<h2>Seguidores</h2>
			</div>
			<div class="pull-right">
				<i class="fa fa-users fa-3x"></i>
			</div>
		</div>
	</div>
    <div class="panel-body">
        <table class="table table-striped table-hover table-responsive">
            <tbody>
                @foreach($seguidores as $seguidor)
                    <tr>
                        <td>
                            <div class="pull-left">
                                <a style="color:#000000;" href="{{'/perfil/'.$seguidor->usuario_id }}">
                               		{{$seguidor->usuario_nome}}
                                </a>
                            </div> 
                            @if($id_usuario == Auth::id())
                                @if($seguidor->usuario_id != Auth::id())
		                            @if($estou_seguindo[$seguidor->usuario_id] == true)
		                                <form role="form"  method="POST" action="/deixar-de-seguir" accept-charset="UTF-8" enctype="multipart/form-data">
		                                    {{ csrf_field() }}
		                                    <input type="hidden" name="id_usuario" value="{{$seguidor->usuario_id}}">
		                                    <input type="hidden" name="pagina" value="2">
		                                    <div class="pull-right">
		                                        <button class="btn btn-success">Seguindo</button>
		                                    </div>
		                                </form>
		                            @else
		                             <form role="form"  method="POST" action="/seguir" accept-charset="UTF-8" enctype="multipart/form-data">
		                                {{ csrf_field() }}
		                                <input type="hidden" name="id_usuario" value="{{$seguidor->usuario_id}}">
		                                <input type="hidden" name="pagina" value="2">
		                                <div class="pull-right">
		                                    <button class="btn btn-default">Seguir</button>
		                                </div>
		                            </form>
		                            @endif
								@else
									<div class="pull-right">
										<button class="btn btn-primary disabled">Você</button>
									</div>
		                        @endif
	                        @else
                                @if($seguidor->usuario_id != Auth::id())
		                        	@if($estou_seguindo[$seguidor->usuario_id] == true)
		                                <form role="form"  method="POST" action="/deixar-de-seguir" accept-charset="UTF-8" enctype="multipart/form-data">
		                                    {{ csrf_field() }}
		                                    <input type="hidden" name="id_usuario" value="{{$seguidor->usuario_id}}">
		                                    <input type="hidden" name="pagina" value="3">
		                                    <div class="pull-right">
		                                        <button class="btn btn-success">Seguindo</button>
		                                    </div>
		                                </form>
		                            @else
		                             <form role="form"  method="POST" action="/seguir" accept-charset="UTF-8" enctype="multipart/form-data">
		                                {{ csrf_field() }}
		                                <input type="hidden" name="id_usuario" value="{{$seguidor->usuario_id}}">
		                                <input type="hidden" name="pagina" value="3">
		                                <div class="pull-right">
		                                    <button class="btn btn-success">Seguir</button>
		                                </div>
		                            </form>
		                            @endif
		                        @else
			                        <div class="pull-right">
			                        	<button class="btn btn-primary disabled">Você</button>
			                        </div>
		                        @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection