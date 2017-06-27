@extends('layouts.app')

@section('content')
<div class="container">


    @foreach($usuarios as $usuario)
   		

		<article class="post ifBlock">
		
			<div class="row">
				<div class="col-lg-3">
					<img src="https://vignette4.wikia.nocookie.net/renandstimpy/images/6/61/Generic_Placeholder_-_Profile.jpg/revision/latest?cb=20160130063931" class="img-rounded" alt="Image" width="150">
				</div>
				

			
				<div class="col-lg-9">
					<a href="/perfil/{{$usuario->usuario_id}}"><h3>{{$usuario->usuario_nome.' '.$usuario->usuario_sobrenome}}</h3></a>
				</div>

				<div class="col-lg-9">
					<p>{{$usuario->usuario_descricao}}</p>
				</div>
				
				<div class="col-lg-9">

					@if(1 == 1) <!-- aqui verificaremos se o usuário já é seguido -->
						<button class="btn btn-success">Seguir</button>
					@endif

					@if(1 == 1) <!-- idem -->
						<button class="btn btn-danger">Excluir</button>
					@endif
				</div>
			</div>
		</article>
    @endforeach

</div>
@endsection