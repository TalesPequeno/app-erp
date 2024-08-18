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
            <a href="{{ route('lojas.create') }}" class="btn btn-success">
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
                        <th scope="col" class="text-end">Ações</th>
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
                        <td class="align-middle white-space-nowrap text-end pe-0">
                            <div class="font-sans-serif btn-reveal-trigger position-static">
                                <button class="btn btn-sm dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                    <span class="fas fa-ellipsis-h fs--2"></span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end py-2">
                                    <a class="dropdown-item" href="{{ route('lojas.show', $loja->id) }}"><span class="fas fa-eye"></span> Visualizar</a>
                                    <a class="dropdown-item" href="{{ route('lojas.edit', $loja->id) }}"><span class="fas fa-edit"></span> Editar</a>
                                    <div class="dropdown-divider"></div>
                                    <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-bs-id="{{ $loja->id }}">
                                        <span class="fas fa-trash"></span> Deletar
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Nenhuma loja cadastrada.</td>
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

<!-- Modal de Confirmação -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Exclusão</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja deletar esta loja?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Deletar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('assets/js/loja.js') }}"></script>
@endsection
