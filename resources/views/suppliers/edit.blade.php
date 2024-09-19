@extends('layouts.app2')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container-fluid p-0">
    <div class="row no-gutters">
        <div class="col-12 pl-3">
            <h1 class="page-title">Editar Fornecedor</h1>
            <hr class="separator-fullwidth">
        </div>
    </div>
    <div class="row no-gutters justify-content-center">
        <div class="col-md-8 col-lg-6 pl-3 pr-3">
            <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nome" name="nome" required placeholder="Nome" value="{{ old('nome', $supplier->nome) }}">
                    <label for="nome">Nome</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nome_fantasia" name="nome_fantasia" placeholder="Nome Fantasia" value="{{ old('nome_fantasia', $supplier->nome_fantasia) }}">
                    <label for="nome_fantasia">Nome Fantasia</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" placeholder="CPF/CNPJ" maxlength="18" value="{{ old('cpf_cnpj', $supplier->cpf_cnpj) }}" oninput="formatCpfCnpj(this)">
                    <label for="cpf_cnpj">CPF/CNPJ</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="{{ old('email', $supplier->email) }}">
                    <label for="email">E-mail</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" value="{{ old('telefone', $supplier->telefone) }}">
                    <label for="telefone">Telefone</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="celular" name="celular" placeholder="Celular" value="{{ old('celular', $supplier->celular) }}">
                    <label for="celular">Celular</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço" value="{{ old('endereco', $supplier->endereco) }}">
                    <label for="endereco">Endereço</label>
                </div>

                <div class="row g-2">
                    <div class="col-md-3 form-floating mb-3">
                        <input type="text" class="form-control" id="numero" name="numero" placeholder="Número" value="{{ old('numero', $supplier->numero) }}">
                        <label for="numero">Número</label>
                    </div>
                    <div class="col-md-9 form-floating mb-3">
                        <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Complemento" value="{{ old('complemento', $supplier->complemento) }}">
                        <label for="complemento">Complemento</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="bairro" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" value="{{ old('bairro', $supplier->bairro) }}">
                </div>

                <div class="mb-3">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep" value="{{ old('cep', $supplier->cep) }}" maxlength="9" oninput="formatCep(this)">
                </div>

                <div class="mb-3">
                    <label for="cidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" value="{{ old('cidade', $supplier->cidade) }}">
                </div>

                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <input type="text" class="form-control" id="estado" name="estado" value="{{ old('estado', $supplier->estado) }}">
                </div>

                <div class="mb-3">
                    <label for="pais" class="form-label">País</label>
                    <input type="text" class="form-control" id="pais" name="pais" value="{{ old('pais', $supplier->pais) }}">
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <input type="text" class="form-control" id="status" name="status" value="{{ old('status', $supplier->status) }}">
                </div>

                <div class="form-floating mb-3">
                    <textarea class="form-control" id="descricao" name="descricao" placeholder="Descrição">{{ old('descricao', $supplier->descricao) }}</textarea>
                    <label for="descricao">Descrição</label>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success btn-lg mr-2">Atualizar</button>
                    <a href="{{ route('suppliers.index') }}" class="btn btn-outline-danger btn-lg ml-2">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/edit-supplier.js') }}"></script>

@endsection
