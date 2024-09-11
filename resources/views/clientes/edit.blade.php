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
            <h1 class="page-title">Editar Cliente</h1>
            <hr class="separator-fullwidth">
        </div>
    </div>
    <div class="row no-gutters justify-content-center">
        <div class="col-md-8 col-lg-6 pl-3 pr-3">
            <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nome" name="nome" required placeholder="Nome" value="{{ old('nome', $cliente->nome) }}">
                    <label for="nome">Nome</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nome_fantasia" name="nome_fantasia" placeholder="Nome Fantasia" value="{{ old('nome_fantasia', $cliente->nome_fantasia) }}">
                    <label for="nome_fantasia">Nome Fantasia</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" placeholder="CPF/CNPJ" maxlength="18" value="{{ old('cpf_cnpj', $cliente->cpf_cnpj) }}" oninput="formatCpfCnpj(this)">
                    <label for="cpf_cnpj">CPF/CNPJ</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" placeholder="Data de Nascimento" value="{{ old('data_nascimento', $cliente->data_nascimento ? $cliente->data_nascimento->format('Y-m-d') : '') }}">
                    <label for="data_nascimento">Data de Nascimento</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="{{ old('email', $cliente->email) }}">
                    <label for="email">E-mail</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="Telefone" value="{{ old('telefone', $cliente->telefone) }}">
                    <label for="telefone">Telefone</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="tel" class="form-control" id="celular" name="celular" placeholder="Celular" value="{{ old('celular', $cliente->celular) }}">
                    <label for="celular">Celular</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço" value="{{ old('endereco', $cliente->endereco) }}">
                    <label for="endereco">Endereço</label>
                </div>
                <div class="row g-2">
                    <div class="col-md-3 form-floating mb-3">
                        <input type="text" class="form-control" id="numero" name="numero" placeholder="Número" value="{{ old('numero', $cliente->numero) }}">
                        <label for="numero">Número</label>
                    </div>
                    <div class="col-md-9 form-floating mb-3">
                        <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Complemento" value="{{ old('complemento', $cliente->complemento) }}">
                        <label for="complemento">Complemento</label>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md-6 form-floating mb-3">
                        <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" value="{{ old('bairro', $cliente->bairro) }}">
                        <label for="bairro">Bairro</label>
                    </div>
                    <div class="col-md-6 form-floating mb-3">
                        <input type="text" class="form-control" id="cep" name="cep" placeholder="CEP" maxlength="9" value="{{ old('cep', $cliente->cep) }}" oninput="formatCep(this)">
                        <label for="cep">CEP</label>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md-6 form-floating mb-3">
                        <select class="form-select" id="pais" name="pais">
                            <option value="">Selecione o País</option>
                            @foreach($paises as $pais)
                                <option value="{{ $pais->id }}" {{ old('pais', $cliente->pais) == $pais->id ? 'selected' : '' }}>{{ $pais->nome_pt }}</option>
                            @endforeach
                        </select>
                        <label for="pais">País</label>
                    </div>
                    <div class="col-md-6 form-floating mb-3">
                        <select class="form-select" id="estado" name="estado" {{ $estados->isEmpty() ? 'disabled' : '' }}>
                            <option value="">Selecione o Estado</option>
                            @foreach($estados as $estado)
                                <option value="{{ $estado->id }}" {{ old('estado', $cliente->estado) == $estado->id ? 'selected' : '' }}>{{ $estado->nome }}</option>
                            @endforeach
                        </select>
                        <input type="text" class="form-control" id="estado_input" name="estado_input" placeholder="Estado" style="display: none;">
                        <label for="estado">Estado</label>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md-6 form-floating mb-3">
                        <select class="form-select" id="cidade" name="cidade" {{ $cidades->isEmpty() ? 'disabled' : '' }}>
                            <option value="">Selecione a Cidade</option>
                            @foreach($cidades as $cidade)
                                <option value="{{ $cidade->id }}" {{ old('cidade', $cliente->cidade) == $cidade->id ? 'selected' : '' }}>{{ $cidade->nome }}</option>
                            @endforeach
                        </select>
                        <input type="text" class="form-control" id="cidade_input" name="cidade_input" placeholder="Cidade" style="display: none;">
                        <label for="cidade">Cidade</label>
                    </div>
                    <div class="col-md-6 form-floating mb-3">
                        <select class="form-select" id="status" name="status">
                            <option value="ativo" {{ old('status', $cliente->status) == 'ativo' ? 'selected' : '' }}>Ativo</option>
                            <option value="inativo" {{ old('status', $cliente->status) == 'inativo' ? 'selected' : '' }}>Inativo</option>
                        </select>
                        <label for="status">Status</label>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" id="descricao" name="descricao" placeholder="Descrição">{{ old('descricao', $cliente->descricao) }}</textarea>
                    <label for="descricao">Descrição</label>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success btn-lg mr-2">Atualizar</button>
                    <a href="{{ route('clientes.index') }}" class="btn btn-outline-danger btn-lg ml-2">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/edit-cliente.js') }}"></script>

@endsection
