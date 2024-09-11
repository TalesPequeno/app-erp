@extends('layouts.app2')

@section('content')
<div class="container-fluid p-0">
    <div class="row no-gutters">
        <div class="col-12 pl-3">
            <h1 class="page-title">Produtos</h1>
            <hr class="separator-fullwidth">
        </div>
    </div>
    <div class="row no-gutters align-items-center">
        <div class="col-3 pl-3">
            <div class="search-box">
                <form action="#" method="GET">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Procurar Produto" name="search">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-9 text-right pr-3">
            <button class="btn btn-light mr-2">
                <i class="fas fa-file-export"></i> Export
            </button>
            <a href="{{ route('produtos.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Novo Produto
            </a>
        </div>
        <div class="row no-gutters">
        <div class="col-12 pl-3 pr-3">
            <table class="table mt-4">
                <thead class="thead-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Ações</th>
                    </tr>
        </thead>
        <tbody>
            @foreach($produtos as $produto)
                <tr>
                    <td>{{ $produto->nome }}</td>
                    <td>{{ $produto->descricao }}</td>
                    <td>{{ $produto->preco }}</td>
                    <td>{{ $produto->quantidade }}</td>
                    <td>
                        <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-warning">Editar</a>
                        <a href="{{ route('produtos.show', $produto->id) }}" class="btn btn-info">Visualizar</a>
                        <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
