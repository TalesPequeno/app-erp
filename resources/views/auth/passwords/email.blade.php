@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="text-center mb-4">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/img/logo1.png') }}" alt="Logo" class="mb-3" style="max-width: 200px;">
                </a>
                <h2 class="custom-title">{{ __('Esqueceu a senha?') }}</h2>
                <p class="custom-paragraph">{{ __('Não se preocupe! Insira o seu e-mail de cadastro e enviaremos instruções para você.') }}</p>
            </div>
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="row mb-3">
                            @error('email')
                                <span class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label for="email" class="col-md-2 col-form-label text-md-end form-label">{{ __('E-mail:') }}</label>
                            <div class="col-md-9">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Redefinir senha') }}
                                </button>
                                <a href="{{ route('login') }}"><span class="btn btn-secondary">Voltar</span></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
