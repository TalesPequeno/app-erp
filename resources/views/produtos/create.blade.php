@extends('layouts.app2')

@section('content')
<div class="container">
    <h1>Criar Novo Produto</h1>

    <form action="{{ route('produtos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao"></textarea>
        </div>

        <div class="form-group">
            <label for="preco">Preço</label>
            <input type="number" class="form-control" id="preco" name="preco" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="quantidade">Quantidade</label>
            <input type="number" class="form-control" id="quantidade" name="quantidade" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Produto</button>
    </form>
</div>
@endsection
