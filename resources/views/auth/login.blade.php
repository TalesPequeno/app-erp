@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="text-center mb-4">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/img/logo1.png') }}" alt="Logo" class="mb-3" style="max-width: 200px;">
                </a>
                <h2 class="custom-title">{{ __('Entrar') }}</h2>
                <p class="custom-paragraph">{{ __('Digite suas credenciais para entrar.') }}</p>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('E-mail:') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="usuario@email.com" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Senha:') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Senha" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 d-flex justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Lembrar-me') }}
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="custom-link" href="{{ route('password.request') }}">
                                    {{ __('Esqueceu a senha?') }}
                                </a>
                            @endif
                        </div>
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Entrar') }}
                            </button>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('register') }}" class="custom-link">{{ __('Criar uma conta') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
