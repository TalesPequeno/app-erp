@extends('layouts.app2')

@section('content')
<div class="container">
    <h1>Detalhes do Estoque</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Produto ID: {{ $estoque->produto_id }}</h5>
            <p class="card-text"><strong>Quantidade:</strong> {{ $estoque->quantidade }}</p>
            <p class="card-text"><strong>Localização:</strong> {{ $estoque->localizacao }}</p>
        </div>
    </div>

    <a href="{{ route('estoques.index') }}" class="btn btn-secondary mt-3">Voltar</a>
</div>
@endsection
