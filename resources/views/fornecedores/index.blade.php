@extends('layouts.app2')

@section('content')
<div class="container">
    <h1>Lista de Fornecedores</h1>
    <a href="{{ route('fornecedores.create') }}" class="btn btn-primary mb-3">Adicionar Fornecedor</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CNPJ</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fornecedores as $fornecedor)
            <tr>
                <td>{{ $fornecedor->id }}</td>
                <td>{{ $fornecedor->nome }}</td>
                <td>{{ $fornecedor->cnpj }}</td>
                <td>{{ $fornecedor->telefone }}</td>
                <td>{{ $fornecedor->email }}</td>
                <td>
                    <a href="{{ route('fornecedores.show', $fornecedor->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('fornecedores.edit', $fornecedor->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('fornecedores.destroy', $fornecedor->id) }}" method="POST" style="display:inline-block;">
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
