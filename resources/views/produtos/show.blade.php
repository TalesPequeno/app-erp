@extends('layouts.app2')

@section('content')
<div class="container">
    <h1>Detalhes do Produto</h1>

    <div class="card">
        <div class="card-header">
            <h3>{{ $produto->nome }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Descrição:</strong> {{ $produto->descricao }}</p>
            <p><strong>Preço:</strong> {{ $produto->preco }}</p>
            <p><strong>Quantidade:</strong> {{ $produto->quantidade }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Excluir</button>
            </form>
        </div>
    </div>
</div>
@endsection
