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
					<h3>{{$usuario->usuario_nome.' '.$usuario->usuario_sobrenome}}</h3>
				</div>
			</div>

			
		</article>

    @endforeach

</div>
@endsection