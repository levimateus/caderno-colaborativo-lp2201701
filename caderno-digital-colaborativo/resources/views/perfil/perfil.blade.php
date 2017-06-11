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
		<div class="items">
			{{-- primeiro painel --}}
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-shopping-cart fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">124</div>
								<div>Seguindo</div>
							</div>
						</div>
					</div>
					<a href="#">
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			{{-- primeiro painel --}}
			{{-- segundo painel --}}
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-shopping-cart fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">124</div>
								<div>Seguidores</div>
							</div>
						</div>
					</div>
					<a href="#">
						<div class="panel-footer">
							<span class="pull-left">View Details</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			{{-- segundo painel --}}
		</div>
                
	</div>


</div>


    <div class="">
        @include('perfil/modal_foto')
    </div>

    <div class="">
        @include('perfil/modal_trocasenha')
    </div>

@endsection