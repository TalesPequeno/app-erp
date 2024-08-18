@extends('layouts.app2')

@section('content')
<div class="container">
    <h1>Detalhes do Fornecedor</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $fornecedor->nome }}</h5>
            <p class="card-text"><strong>CNPJ:</strong> {{ $fornecedor->cnpj }}</p>
            <p class="card-text"><strong>Telefone:</strong> {{ $fornecedor->telefone }}</p>
            <p class="card-text"><strong>Email:</strong> {{ $fornecedor->email }}</p>
            <p class="card-text"><strong>Endereço:</strong> {{ $fornecedor->endereco }}</p>
        </div>
    </div>

    <a href="{{ route('fornecedores.index') }}" class="btn btn-secondary mt-3">Voltar</a>
</div>
@endsection
