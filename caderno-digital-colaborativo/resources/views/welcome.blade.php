@extends('layouts.app')

@section('content')
<div class="container">
    <div class="login-page ifBlock">
        <div class=" form-signin">
            <h4>Caderno Colaborativo</h4>
            <br>
            <p>Bem vindo ao caderno colaborativo, favor clique abaixo para ter acesso ao sistema</p>
            <a href="{{ url('/login') }}"><button class="btn btn-lg btn-block" type="submit">Entrar</button></a>
        </div>
    </div>
</div>
@endsection

