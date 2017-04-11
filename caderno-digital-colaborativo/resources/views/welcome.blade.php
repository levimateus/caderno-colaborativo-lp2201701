<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css"/>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <nav class="menu">
                    <div class="container">
                      <div class="row centered">
                        <div class="col-md-4 col-xs-4">
                          <h1><i class="fa fa-camera-retro"></i><b class="hidden-xs">Caderno colaborativo</b></h1>
                        </div>
                        <div class="col-md-4 col-xs-8 page">
                            Crítica social construtiva
                        </div>
                        <div class="col-md-4 hidden-xs">
                            @if (Auth::check())
                                <a href="{{ url('/home') }}">Home</a>
                            @else
                                <a href="{{ url('/login') }}">Login</a>
                            <!--<a href="{{ url('/register') }}">Register</a>-->
                            @endif
                        </div>
                      </div>
                    </div>
                  </nav>
            @endif
            <main>
            <div class="container">
                <div class="content">
                    <div class="title m-b-md">
                        IFSP - Caderno Colaborativo
                    </div>

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
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
