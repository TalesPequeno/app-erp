@extends('layouts.app2')

@section('content')
<div class="container">
    <h1>Editar Produto</h1>

    <form action="{{ route('produtos.update', $produto->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $produto->nome) }}" required>
        </div>
        
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao">{{ old('descricao', $produto->descricao) }}</textarea>
        </div>

        <div class="form-group">
            <label for="preco">Preço</label>
            <input type="number" class="form-control" id="preco" name="preco" value="{{ old('preco', $produto->preco) }}" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="quantidade">Quantidade</label>
            <input type="number" class="form-control" id="quantidade" name="quantidade" value="{{ old('quantidade', $produto->quantidade) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar Produto</button>
    </form>
</div>
@endsection
