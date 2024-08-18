@extends('layouts.app2')

@section('content')
<div class="container">
    <h1>Editar Estoque</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('estoques.update', $estoque->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="produto_id" class="form-label">ID do Produto</label>
            <input type="number" class="form-control" id="produto_id" name="produto_id" value="{{ old('produto_id', $estoque->produto_id) }}" required>
        </div>
        <div class="mb-3">
            <label for="quantidade" class="form-label">Quantidade</label>
            <input type="number" class="form-control" id="quantidade" name="quantidade" value="{{ old('quantidade', $estoque->quantidade) }}" required>
        </div>
        <div class="mb-3">
            <label for="localizacao" class="form-label">Localização</label>
            <input type="text" class="form-control" id="localizacao" name="localizacao" value="{{ old('localizacao', $estoque->localizacao) }}" required>
        </div>
        <button type="submit" class="btn btn-success">Atualizar</button>
        <a href="{{ route('estoques.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection
