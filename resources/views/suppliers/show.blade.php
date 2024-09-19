@extends('layouts.app2')

@section('content')

<div class="container-fluid p-0">
    <div class="row no-gutters">
        <div class="col-12">
            <h1 class="page-title">Detalhes do Fornecedor</h1>
            <hr class="separator-fullwidth">
        </div>
    </div>
    
    <div class="row no-gutters justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Informações do Fornecedor</h5>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Nome:</dt>
                        <dd class="col-sm-8">{{ $supplier->nome }}</dd>

                        <dt class="col-sm-4">Nome Fantasia:</dt>
                        <dd class="col-sm-8">{{ $supplier->nome_fantasia ?? 'N/A' }}</dd>

                        <dt class="col-sm-4">CPF/CNPJ:</dt>
                        <dd class="col-sm-8">{{ $supplier->cpf_cnpj }}</dd>

                        <dt class="col-sm-4">Data de Nascimento:</dt>
                        <dd class="col-sm-8">{{ optional($supplier->data_nascimento)->format('d/m/Y') ?? 'N/A' }}</dd>

                        <dt class="col-sm-4">E-mail:</dt>
                        <dd class="col-sm-8">{{ $supplier->email }}</dd>

                        <dt class="col-sm-4">Telefone:</dt>
                        <dd class="col-sm-8">{{ $supplier->telefone }}</dd>

                        <dt class="col-sm-4">Celular:</dt>
                        <dd class="col-sm-8">{{ $supplier->celular }}</dd>

                        <dt class="col-sm-4">Endereço:</dt>
                        <dd class="col-sm-8">
                            {{ $supplier->endereco }}, {{ $supplier->numero }}
                            {{ $supplier->complemento ? ', '.$supplier->complemento : '' }}
                        </dd>

                        <dt class="col-sm-4">Bairro:</dt>
                        <dd class="col-sm-8">{{ $supplier->bairro }}</dd>

                        <dt class="col-sm-4">CEP:</dt>
                        <dd class="col-sm-8">{{ $supplier->cep }}</dd>

                        <dt class="col-sm-4">Cidade:</dt>
                        <dd class="col-sm-8">{{ $supplier->cidade }}</dd>

                        <dt class="col-sm-4">Estado:</dt>
                        <dd class="col-sm-8">{{ $supplier->estado }}</dd>

                        <dt class="col-sm-4">País:</dt>
                        <dd class="col-sm-8">{{ $supplier->pais }}</dd>

                        <dt class="col-sm-4">Status:</dt>
                        <dd class="col-sm-8">{{ ucfirst($supplier->status) }}</dd>

                        <dt class="col-sm-4">Descrição:</dt>
                        <dd class="col-sm-8">{{ $supplier->descricao ?? 'N/A' }}</dd>
                    </dl>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-primary">Editar</a>
                    <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
