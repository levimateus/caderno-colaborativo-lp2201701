@extends('layouts.app')

@section('content')
<div class="container">
    <div class="login-page">
          <form class="form-signin" role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <h2 class="form-signin-heading">Entre no Caderno Colaborativo</h2>
            
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="inputEmail" class="sr-only">Email</label>
                <input id="email" type="email" class="form-control" placeholder="Insira aqui seu email" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="inputEmail" class="sr-only">Senha</label>
                <input id="password" type="password" class="form-control" placeholder="Insira aqui sua senha" name="password" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <button class="btn btn-lg btn-block" type="submit">Sign in</button>
          </form>
        </div> 
</div>
@endsection
