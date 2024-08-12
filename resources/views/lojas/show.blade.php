@extends('layouts.app2')

@section('content')
<div class="container">
    <h1>{{ $loja->nome_fantasia }}</h1>
    <p><strong>Razão Social:</strong> {{ $loja->razao_social }}</p>
    <p><strong>CNPJ:</strong> {{ $loja->cnpj }}</p>
    <p><strong>Endereço:</strong> {{ $loja->rua }}, {{ $loja->numero }}, {{ $loja->bairro }}, {{ $loja->cep }}, {{ $loja->cidade }}/{{ $loja->estado }} - {{ $loja->pais }}</p>
    <!-- Adicione mais detalhes conforme necessário -->
</div>
@endsection
