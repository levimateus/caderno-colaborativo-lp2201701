@extends('layouts.app')

@section('content')

	@include('posts.post')
	
    <!-- POST modal -->
    <button type="button" class="btn" id="abrir_novo_post" data-toggle="modal" data-target=".bs-example-modal-lg">+</button>

    <div class="modal_post">
        @include('modal_post')
    </div>

@endsection