@extends('layouts.app2')

@section('content')
<div class="container-fluid p-0">
    <div class="row mb-4">
        <div class="col-12 pl-3">
            <h1 class="page-title">Fornecedores</h1>
            <hr class="separator-fullwidth">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4 col-lg-3 pl-3">
            <div class="search-box">
                <form action="{{ route('fornecedores.index') }}" method="GET">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Procurar fornecedor" name="search" value="{{ request()->get('search') }}">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8 col-lg-9 text-right pr-3">
            <button class="btn btn-light mr-2">
                <i class="fas fa-file-export"></i> Exportar
            </button>
            <a href="{{ route('fornecedores.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Novo Fornecedor
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 pl-3 pr-3">
            <table class="table mt-4">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CNPJ</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fornecedores as $fornecedor)
                    <tr>
                        <td>{{ $fornecedor->id }}</td>
                        <td>{{ $fornecedor->nome }}</td>
                        <td>{{ $fornecedor->cnpj }}</td>
                        <td>{{ $fornecedor->telefone }}</td>
                        <td>{{ $fornecedor->email }}</td>
                        <td>
                            <a href="{{ route('fornecedores.show', $fornecedor->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('fornecedores.edit', $fornecedor->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-bs-id="{{ $fornecedor->id }}">
                                Excluir
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
        Tem certeza que deseja deletar este fornecedor?
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
        button.addEventListener('click', function () {
            const form = document.querySelector('#deleteForm');
            form.action = "{{ route('fornecedores.destroy', '') }}/" + this.getAttribute('data-bs-id');
        });
    });
});
</script>
@endsection
