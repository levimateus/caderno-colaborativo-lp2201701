@extends('layouts.app')

@section('content')
<div class="container">


    <form action="/pesquisa" method="POST" accept-charset="UTF-8" >
    {{ csrf_field() }}
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-6 col-sm-6 pull-left">
                    <div class="input-group">
                        <div class="input-group-addon">Filtrar por</div>
                        <select name="tipo_pesquisa" id="tipo_pesquisa" class="form-control">
                            <option value="nenhum">Nenhum</option>
                            <option value="iftags">IfTags</option>
                            <option value="publicacoes">Publicações</option>
                            <option value="usuarios">Usuarios</option>
                            
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
    </form>
    
    
    @foreach($posts as $post)
   		@if($post->publicacao_status == 1)
       		@include('posts.post')
        @endif
    @endforeach
    
    <!-- POST modal -->
    @if (Auth::user()->usuario_estado_acesso != 3)
        <button type="button" class="btn btn-primary pull-right" id="abrir_novo_post" data-toggle="modal" data-target=".newPost">+</button>
    @endif
    

    <div class="modal_post">
        @include('modal_post')
    </div>
</div>
@endsection
