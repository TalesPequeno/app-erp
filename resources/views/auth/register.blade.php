@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="text-center mb-4">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/img/logo1.png') }}" alt="Logo" class="mb-3" style="max-width: 200px;">
                </a>
                <h2 class="custom-title">{{ __('Registro') }}</h2>
                <p class="custom-paragraph">{{ __('Crie sua conta agora.') }}</p>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Nome:') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nome">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="surname" class="form-label">{{ __('Sobrenome:') }}</label>
                            <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" placeholder="Sobrenome">
                            @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('E-mail:') }}</label>
                            <input id="email" type="email" class="form-control @error('custom_email_error') is-invalid @enderror @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="E-mail">
                            @error('custom_email_error')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Senha:') }}</label>
                            <input id="password" type="password" class="form-control @error('custom_password_error') is-invalid @enderror @error('custom_password_confirm_error') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Senha">
                            @error('custom_password_error')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @error('custom_password_confirm_error')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">{{ __('Confirmar Senha:') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar Senha">
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary w-100">
                                {{ __('Registrar') }}
                            </button>
                        </div>
                        <div class="text-center">
                            <a class="custom-link" href="{{ route('login') }}">Entrar com um usuário existente</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
