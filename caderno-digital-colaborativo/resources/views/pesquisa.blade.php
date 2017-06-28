@extends('layouts.app')

@section('content')
<div class="container">

    @foreach($usuarios as $usuario)
    	<article class="post ifBlock">
			 	<div class="row">
	   		@if(isset($midias))
			 @foreach($midias as $foto)

				 
				 	@if($usuario->media_id == $foto->midia_id)
						<div class="col-lg-3">
							<img src="{{ asset('storage')}}/{{ $foto->midia_href}}" class="img-rounded" alt="" width="150">
						</div>

					@else
						<div class="col-lg-3">
							<img src="{{asset('img')}}/avatar-default.png" class="img-rounded alt="" width="150">
						</div>
					@endif

					 	
			 	
			 @endforeach
			@else
				<div class="col-lg-3">
					<img src="{{asset('img')}}/avatar-default.png" class="img-rounded alt="" width="150">
				</div>

			@endif
			<div class="col-lg-9">
						<a href="/perfil/{{$usuario->usuario_id}}"><h3>{{$usuario->usuario_nome.' '.$usuario->usuario_sobrenome}}</h3></a>
					</div>

					<div class="col-lg-9">
						<p>{{$usuario->usuario_descricao}}</p>
					</div>
			 	</div>
			 </article>
    @endforeach

</div>
@endsection