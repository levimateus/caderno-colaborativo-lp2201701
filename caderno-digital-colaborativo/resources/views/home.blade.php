@extends('layouts.app')

@section('content')
<div class="container">
    
    @foreach($posts as $post)
        @include('posts.post')
    @endforeach
    
    <!-- POST modal -->
    <button type="button" class="btn btn-primary pull-right" id="abrir_novo_post" data-toggle="modal" data-target=".bs-example-modal-lg">+</button>

    <div class="modal_post">
        @include('modal_post')
    </div>
</div>
@endsection
