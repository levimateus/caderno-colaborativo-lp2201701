<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>IFSP - Caderno Colaborativo</title>

        <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css"/>
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
                        <div class="col-md-4 col-xs-8 page text-center">
                            Início
                        </div>
                        <div class="col-md-4 hidden-xs text-right">
                            @if (Auth::check())
                                <a href="{{ url('/home') }}">Início</a>
                            @else
                                <a href="{{ url('/login') }}">Entrar</a>
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
                        <div class="login-page ifBlock">
                            <div class=" form-signin">
                                <h4>Caderno Colaborativo</h4>
                                <br>
                                <p>Bem vindo ao caderno colaborativo, favor faça login para ter acesso ao sistema</p>
                                <a href="{{ url('/login') }}"><button class="btn btn-lg btn-block" type="submit">Entrar</button></a>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
