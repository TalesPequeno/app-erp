@extends('layouts.app2')

@section('content')
<div class="container">
    <h1>Detalhes do Cliente</h1>

    <div class="card">
        <div class="card-header">
            <h3>{{ $cliente->nome }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Email:</strong> {{ $cliente->email }}</p>
            <p><strong>Telefone:</strong> {{ $cliente->telefone }}</p>
            <!-- Adicione mais detalhes conforme necessário -->
        </div>
        <div class="card-footer">
            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Excluir</button>
            </form>
        </div>
    </div>
</div>
@endsection
