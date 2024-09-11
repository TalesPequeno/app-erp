@extends('layouts.app2')

@section('content')

<div class="container-fluid p-0">
    <div class="row no-gutters">
        <div class="col-12 pl-3">
            <h1 class="page-title">Detalhes do Cliente</h1>
            <hr class="separator-fullwidth">
        </div>
    </div>
    <div class="row no-gutters justify-content-center">
        <div class="col-md-8 col-lg-6 pl-3 pr-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Informações do Cliente</h5>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Nome:</dt>
                        <dd class="col-sm-8">{{ $cliente->nome }}</dd>

                        <dt class="col-sm-4">Nome Fantasia:</dt>
                        <dd class="col-sm-8">{{ $cliente->nome_fantasia ?? 'N/A' }}</dd>

                        <dt class="col-sm-4">CPF/CNPJ:</dt>
                        <dd class="col-sm-8">{{ $cliente->cpf_cnpj }}</dd>

                        <dt class="col-sm-4">Data de Nascimento:</dt>
                        <dd class="col-sm-8">{{ $cliente->data_nascimento ? $cliente->data_nascimento->format('d/m/Y') : 'N/A' }}</dd>

                        <dt class="col-sm-4">E-mail:</dt>
                        <dd class="col-sm-8">{{ $cliente->email }}</dd>

                        <dt class="col-sm-4">Telefone:</dt>
                        <dd class="col-sm-8">{{ $cliente->telefone }}</dd>

                        <dt class="col-sm-4">Celular:</dt>
                        <dd class="col-sm-8">{{ $cliente->celular }}</dd>

                        <dt class="col-sm-4">Endereço:</dt>
                        <dd class="col-sm-8">{{ $cliente->endereco }}</dd>

                        <dt class="col-sm-4">Número:</dt>
                        <dd class="col-sm-8">{{ $cliente->numero }}</dd>

                        <dt class="col-sm-4">Complemento:</dt>
                        <dd class="col-sm-8">{{ $cliente->complemento ?? 'N/A' }}</dd>

                        <dt class="col-sm-4">Bairro:</dt>
                        <dd class="col-sm-8">{{ $cliente->bairro }}</dd>

                        <dt class="col-sm-4">CEP:</dt>
                        <dd class="col-sm-8">{{ $cliente->cep }}</dd>

                        <dt class="col-sm-4">Cidade:</dt>
                        <dd class="col-sm-8">{{ $cliente->cidade }}</dd>

                        <dt class="col-sm-4">Estado:</dt>
                        <dd class="col-sm-8">{{ $cliente->estado }}</dd>

                        <dt class="col-sm-4">País:</dt>
                        <dd class="col-sm-8">{{ $cliente->pais }}</dd>

                        <dt class="col-sm-4">Status:</dt>
                        <dd class="col-sm-8">{{ ucfirst($cliente->status) }}</dd>

                        <dt class="col-sm-4">Descrição:</dt>
                        <dd class="col-sm-8">{{ $cliente->descricao ?? 'N/A' }}</dd>
                    </dl>
                </div>
                <div class="card-footer">
                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-primary">Editar</a>
                    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
