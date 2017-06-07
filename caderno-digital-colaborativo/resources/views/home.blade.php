@extends('layouts.app')

@section('content')
<div class="container">

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-6 col-sm-6 pull-left">
                <div class="input-group">
                    <div class="input-group-addon">Filtrar por</div>
                    <select name="tipo_filtro" id="tipo_filtro" class="form-control">
                        <option value="nenhum">Nenhum</option>
                        <option value="seguidores">Seguidores</option>
                        <option value="iftags">IfTags</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 pull-right">
                <div class="input-group">
                    <input type="text" class="form-control" name="pesquisa" placeholder="Procurar...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </span>
                </div>
            </div>  
        </div>
    </div>  
    
    
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
