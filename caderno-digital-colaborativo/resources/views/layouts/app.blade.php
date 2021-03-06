<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>IFSP - Caderno Colaborativo</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
    <div id="app">
        <nav class="menu">
            <div class="container">
              <div class="row centered">
                <div class="col-md-4 col-xs-4">
                    <a href="/home">
                        <h1><i class="fa fa-camera-retro"></i><b class="hidden-xs">Caderno colaborativo</b></h1>
                    </a>
                </div>
                <div class="col-md-4 hidden-xs page text-center">
                    Oi Giovanni Fofo
                </div>
                <div class="col-md-4 col-xs-8 text-right">
                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->usuario_nome }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{'/perfil/'.Auth::user()->usuario_id }}">Meu Perfil</a>
                                    </li>

                                    @if (Auth::user()->usuario_cargo == 3 || Auth::user()->usuario_cargo == 2)
                                        <li>
                                            <a href="/reports">Denuncias</a>
                                        </li>
                                    @endif
                                    @if (Auth::user()->usuario_cargo == 2)
                                        <li>
                                            <a href="/csv">Importar usuários</a>
                                        </li>
                                    @endif
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
              </div>
            </div>
        </nav>
        <main>
            <div class="container">
                @if(!empty(session('message')))
                <script type="text/javascript">
                    $(window).on('load',function(){
                        $('#abelinha').modal('show');
                    });
                </script>
                <div class="modal fade" id="abelinha">
                    <div class="modal-dialog  modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <a class="close" data-dismiss="modal">×</a>
                                <h3>Mensagem</h3>
                            </div>
                            <div class="modal-body">
                                <h4>
                                    {{ session('message') }}
                                </h4>
                            </div>
                            <div class="modal-footer">
                                <a href="#" class="btn btn-primary" data-dismiss="modal">Fechar mensagem</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
