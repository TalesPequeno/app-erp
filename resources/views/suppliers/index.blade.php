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
                <form action="{{ route('suppliers.index') }}" method="GET">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Procurar fornecedor" name="search" value="{{ request()->get('search') }}">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8 col-lg-9 text-end pr-3">
            <button class="btn btn-light me-2">
                <i class="fas fa-file-export"></i> Exportar
            </button>
            <a href="{{ route('suppliers.create') }}" class="btn btn-success">
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
                        <th>CPF/CNPJ</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->id }}</td>
                        <td>{{ $supplier->nome }}</td>
                        <td>{{ $supplier->cpf_cnpj }}</td>
                        <td>{{ $supplier->telefone }}</td>
                        <td>{{ $supplier->email }}</td>
                        <td class="text-end">
                            <div class="font-sans-serif btn-reveal-trigger position-static">
                                <button class="btn btn-sm dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-ellipsis-h fs--2"></span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end py-2">
                                    <a class="dropdown-item" href="{{ route('suppliers.show', $supplier->id) }}">
                                        <span class="fas fa-eye"></span> Visualizar
                                    </a>
                                    <a class="dropdown-item" href="{{ route('suppliers.edit', $supplier->id) }}">
                                        <span class="fas fa-edit"></span> Editar
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-bs-id="{{ $supplier->id }}">
                                        <span class="fas fa-trash"></span> Excluir
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Nenhum fornecedor cadastrado.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            @if($suppliers->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $suppliers->links('vendor.pagination.bootstrap-4') }}
                </div>
            @endif
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
                <form id="deleteForm" method="POST" action="">
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
    var deleteModal = document.getElementById('confirmDeleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var supplierId = button.getAttribute('data-bs-id'); // Extract info from data-bs-id attribute
        var form = deleteModal.querySelector('#deleteForm');
        form.action = '/suppliers/' + supplierId; // Set the form action to the correct delete URL
    });
});
</script>
@endsection
