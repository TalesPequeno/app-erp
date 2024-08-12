@extends('layouts.app2')

@section('content')
<div class="container">
    <h1>Editar Loja: {{ $loja->nome_fantasia }}</h1>
    <form action="{{ route('lojas.update', $loja->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="razao_social">Razão Social</label>
            <input type="text" class="form-control" id="razao_social" name="razao_social" value="{{ old('razao_social', $loja->razao_social) }}" required>
        </div>
        
        <div class="form-group">
            <label for="nome_fantasia">Nome Fantasia</label>
            <input type="text" class="form-control" id="nome_fantasia" name="nome_fantasia" value="{{ old('nome_fantasia', $loja->nome_fantasia) }}" required>
        </div>
        
        <div class="form-group">
            <label for="cnpj">CNPJ</label>
            <input type="text" class="form-control" id="cnpj" name="cnpj" value="{{ old('cnpj', $loja->cnpj) }}" required>
        </div>
        
        <!-- Adicione mais campos conforme necessário -->
        
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="{{ route('lojas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
