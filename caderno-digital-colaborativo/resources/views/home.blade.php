@extends('layouts.app')

@section('content')
<div class="container">
    
    @foreach($posts as $post)
   		@if($post->publicacao_status == 1)
       		@include('posts.post')
        @endif
    @endforeach
    
    <!-- POST modal -->
    <button type="button" class="btn btn-primary pull-right" id="abrir_novo_post" data-toggle="modal" data-target=".newPost">+</button>

    
    <div class="modal_post">
        @include('modal_post')
    </div>
</div>
@endsection
