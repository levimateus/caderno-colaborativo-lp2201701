@extends('layouts.app')

@section('content')

@if(Session::has('message'))
{!! MessageHelper::displayAlert() !!}
@endif

<div class="panel panel-default">
	<div class="panel-body">
		{{-- foto de perfil --}}
		<div class="col-lg-4 col-sm-6 text-center">
			<div class="pull-left">
                <img class="img-circle img-responsive img-center"  width="200" src="{{$fotoPerfil}}" alt="">
				<h3>{{$usuario->usuario_nome}}</h3>
				<h3>{{$nivel_nome}}</h3>
                <button type="button" class="btn glyphicon glyphicon-picture" id="" data-toggle="modal" data-target=".perfil-foto-modal-lg"></button>
                <button type="button" class="btn glyphicon glyphicon-lock" id="" data-toggle="modal" data-target=".perfil-trocasenha-modal-lg"></button>
			</div>
		</div>
		{{-- foto de perfil --}}
		<div class="itens_perfil">
			{{-- primeiro painel --}}
			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
				<a href="{{'/seguindo/'.$id_usuario }}">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-user-plus fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
									<div class="huge">{{$seguindo}}</div>
									<div>Seguindo</div>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			{{-- primeiro painel --}}
			{{-- segundo painel --}}
			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
				<a href="{{'/seguidores/'.$id_usuario }}">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-users fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
									<div class="huge">{{$seguidores}}</div>
									<div>Seguidores</div>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			{{-- segundo painel --}}
		</div>
	</div>
</div>

<div class="meus_posts">
	@foreach($posts as $post)
		@if($post->publicacao_status == 1)
	   		@include('perfil.meus_posts')
	    @endif
	@endforeach
</div>

@include('perfil/modal_foto')
@include('perfil/modal_trocasenha')

@endsection
