@extends('layouts.app2')

@section('content')
<div class="container">
    <h1>Lista de Estoques</h1>
    <a href="{{ route('estoques.create') }}" class="btn btn-primary mb-3">Adicionar Estoque</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Produto ID</th>
                <th>Quantidade</th>
                <th>Localização</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estoques as $estoque)
            <tr>
                <td>{{ $estoque->id }}</td>
                <td>{{ $estoque->produto_id }}</td>
                <td>{{ $estoque->quantidade }}</td>
                <td>{{ $estoque->localizacao }}</td>
                <td>
                    <a href="{{ route('estoques.show', $estoque->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('estoques.edit', $estoque->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('estoques.destroy', $estoque->id) }}" method="POST" style="display:inline-block;">
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
