@extends('layouts.app2')

@section('content')
<div class="container-fluid p-0">
    <div class="row no-gutters">
        <div class="col-12 pl-3">
            <h1 class="page-title">Lojas</h1>
            <hr class="separator-fullwidth">
        </div>
    </div>
    <div class="row no-gutters align-items-center">
        <div class="col-3 pl-3">
            <div class="search-box">
                <form action="#" method="GET">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Procurar Loja" name="search">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-9 text-right pr-3">
            <button class="btn btn-light mr-2">
                <i class="fas fa-file-export"></i> Export
            </button>
            <a href="{{ route('cadastros.lojas') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Nova Loja
            </a>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-12 pl-3 pr-3">
            <table class="table mt-4">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">CNPJ</th>
                        <th scope="col">Endereço</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lojas as $loja)
                    <tr>
                        <th scope="row">{{ $loja->id }}</th>
                        <td>{{ $loja->nome_fantasia }}</td>
                        <td>{{ $loja->cnpj }}</td>
                        <td>
                            {{ $loja->rua }}, {{ $loja->numero }}{{ $loja->complemento ? ', ' . $loja->complemento : '' }}, 
                            {{ $loja->bairro }}, {{ $loja->cep }}, 
                            {{ mb_strtoupper($loja->cidade, 'UTF-8') }}/{{ $loja->estado }} - 
                            {{ mb_strtoupper($loja->pais, 'UTF-8') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Nenhuma loja cadastrada.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $lojas->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection