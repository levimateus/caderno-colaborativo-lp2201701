@extends('layouts.app')

@section('content')
<div class="container">
    <article class="post ifBlock">
        <h4>Titulo do post</h4>
        <div class="post-img">
            <img src="{{ asset('img/aula.jpg') }}" class="img-responsive">
        </div>
        <div class="post-info clearfix">
            <span>
                Autor: Luís Takahashi
            </span>
            <span>
                Professor: Bortoletto
            </span>
        </div>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non porta lectus. Vestibulum tempor fermentum est, eu blandit ipsum ultrices a. Pellentesque gravida, odio at congue elementum, nibh elit pellentesque dolor, a suscipit turpis lacus ac nisl. Nullam suscipit, tortor eget dapibus ullamcorper, dolor justo finibus nulla, vitae ultricies dolor turpis non mauris. Curabitur ornare eu risus sit amet efficitur. Proin molestie nunc sed mi fringilla, non egestas eros lobortis. Cras fringilla dolor viverra quam interdum, ut iaculis ipsum feugiat. Vestibulum purus odio, venenatis nec nisl a, pellentesque laoreet erat. Curabitur tempor ligula ac nisl faucibus aliquet. Duis consequat neque vel lorem finibus ullamcorper. Ut tempor condimentum erat, vitae mollis mi porttitor nec. Integer maximus nibh ac lobortis semper. Nam semper metus in velit tristique mattis. </p>
        <span><a href="#">Saiba mais</a></span>
    </article>
    <article class="post ifBlock">
        <h4>Titulo do post</h4>
        <div class="post-img">
            <img src="{{ asset('img/bannerif.jpg') }}" class="img-responsive"> 
        </div>
        <div class="post-info clearfix">
            <span>
                Autor: Luís Takahashi
            </span>
            <span>
                Professor: Bortoletto
            </span>
        </div>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non porta lectus. Vestibulum tempor fermentum est, eu blandit ipsum ultrices a. Pellentesque gravida, odio at congue elementum, nibh elit pellentesque dolor, a suscipit turpis lacus ac nisl. Nullam suscipit, tortor eget dapibus ullamcorper, dolor justo finibus nulla, vitae ultricies dolor turpis non mauris. Curabitur ornare eu risus sit amet efficitur. Proin molestie nunc sed mi fringilla, non egestas eros lobortis. Cras fringilla dolor viverra quam interdum, ut iaculis ipsum feugiat. Vestibulum purus odio, venenatis nec nisl a, pellentesque laoreet erat. Curabitur tempor ligula ac nisl faucibus aliquet. Duis consequat neque vel lorem finibus ullamcorper. Ut tempor condimentum erat, vitae mollis mi porttitor nec. Integer maximus nibh ac lobortis semper. Nam semper metus in velit tristique mattis. </p>
        <span><a href="#">Saiba mais</a></span>
    </article>
    <article class="post ifBlock">
        <h4>Titulo do post</h4>
        <div class="post-img">
            <img src="{{ asset('img/aula1.jpg') }}" class="img-responsive">  
        </div>
        <div class="post-info clearfix">
            <span>
                Autor: Luís Takahashi
            </span>
            <span>
                Professor: Bortoletto
            </span>
        </div>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non porta lectus. Vestibulum tempor fermentum est, eu blandit ipsum ultrices a. Pellentesque gravida, odio at congue elementum, nibh elit pellentesque dolor, a suscipit turpis lacus ac nisl. Nullam suscipit, tortor eget dapibus ullamcorper, dolor justo finibus nulla, vitae ultricies dolor turpis non mauris. Curabitur ornare eu risus sit amet efficitur. Proin molestie nunc sed mi fringilla, non egestas eros lobortis. Cras fringilla dolor viverra quam interdum, ut iaculis ipsum feugiat. Vestibulum purus odio, venenatis nec nisl a, pellentesque laoreet erat. Curabitur tempor ligula ac nisl faucibus aliquet. Duis consequat neque vel lorem finibus ullamcorper. Ut tempor condimentum erat, vitae mollis mi porttitor nec. Integer maximus nibh ac lobortis semper. Nam semper metus in velit tristique mattis. </p>
        <span><a href="#">Saiba mais</a></span>
    </article>
    <!-- POST modal -->
    <button type="button" class="btn btn-primary pull-right" id="abrir_novo_post" data-toggle="modal" data-target=".bs-example-modal-lg">Novo Post</button>

    <div class="modal_post">
        @include('modal_post')
    </div>
</div>
@endsection
