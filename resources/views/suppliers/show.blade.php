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
                        <dd class="col-sm-8">{{ $supplier->name }}</dd>

                        <dt class="col-sm-4">Nome Fantasia:</dt>
                        <dd class="col-sm-8">{{ $supplier->fantasy_name ?? 'N/A' }}</dd>

                        <dt class="col-sm-4">CPF/CNPJ:</dt>
                        <dd class="col-sm-8">{{ $supplier->cpf_cnpj }}</dd>

                        <dt class="col-sm-4">Data de Nascimento:</dt>
                        <dd class="col-sm-8">{{ optional($supplier->birth_date)->format('d/m/Y') ?? 'N/A' }}</dd>

                        <dt class="col-sm-4">E-mail:</dt>
                        <dd class="col-sm-8">{{ $supplier->email }}</dd>

                        <dt class="col-sm-4">Telefone:</dt>
                        <dd class="col-sm-8">{{ $supplier->phone }}</dd>

                        <dt class="col-sm-4">Celular:</dt>
                        <dd class="col-sm-8">{{ $supplier->cell }}</dd>

                        <dt class="col-sm-4">Endereço:</dt>
                        <dd class="col-sm-8">
                            {{ $supplier->address }}, {{ $supplier->number }}
                            {{ $supplier->complement ? ', '.$supplier->complement : '' }}
                        </dd>

                        <dt class="col-sm-4">Bairro:</dt>
                        <dd class="col-sm-8">{{ $supplier->neighborhood }}</dd>

                        <dt class="col-sm-4">CEP:</dt>
                        <dd class="col-sm-8">{{ $supplier->postal_code }}</dd>

                        <dt class="col-sm-4">Cidade:</dt>
                        <dd class="col-sm-8">{{ $supplier->city }}</dd> <!-- Changed cidade to city -->

                        <dt class="col-sm-4">Estado:</dt>
                        <dd class="col-sm-8">{{ $supplier->state }}</dd> <!-- Changed estado to state -->

                        <dt class="col-sm-4">País:</dt>
                        <dd class="col-sm-8">{{ $supplier->pais }}</dd>

                        <dt class="col-sm-4">Status:</dt>
                        <dd class="col-sm-8">{{ ucfirst($supplier->status) }}</dd>

                        <dt class="col-sm-4">Descrição:</dt>
                        <dd class="col-sm-8">{{ $supplier->description ?? 'N/A' }}</dd>
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
