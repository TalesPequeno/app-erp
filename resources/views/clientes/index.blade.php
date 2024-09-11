@extends('layouts.app2')

@section('content')
<div class="container-fluid p-0">
    <div class="row no-gutters">
        <div class="col-12 pl-3">
            <h1 class="page-title">Lista de Clientes</h1>
            <hr class="separator-fullwidth">
        </div>
    </div>
    <div class="row no-gutters align-items-center">
        <div class="col-3 pl-3">
            <div class="search-box">
                <form action="{{ route('clientes.index') }}" method="GET">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Procurar Cliente" name="search" value="{{ request()->get('search') }}">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-9 text-right pr-3">
            <button class="btn btn-light mr-2">
                <i class="fas fa-file-export"></i> Exportar
            </button>
            <a href="{{ route('clientes.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Adicionar Cliente
            </a>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-12 pl-3 pr-3">
            <table class="table mt-4">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefone</th>
                        <th scope="col" class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->nome }}</td>
                        <td>{{ $cliente->email }}</td>
                        <td>{{ $cliente->telefone }}</td>
                        <td class="text-end">
                            <div class="font-sans-serif btn-reveal-trigger position-static">
                                <button class="btn btn-sm dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-ellipsis-h fs--2"></span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end py-2">
                                    <a class="dropdown-item" href="{{ route('clientes.show', $cliente->id) }}">
                                        <span class="fas fa-eye"></span> Visualizar
                                    </a>
                                    <a class="dropdown-item" href="{{ route('clientes.edit', $cliente->id) }}">
                                        <span class="fas fa-edit"></span> Editar
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-bs-id="{{ $cliente->id }}">
                                        <span class="fas fa-trash"></span> Deletar
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Nenhum cliente cadastrado.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            @if($clientes instanceof \Illuminate\Pagination\Paginator)
            <div class="d-flex justify-content-center">
                {{ $clientes->links('vendor.pagination.bootstrap-4') }}
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
                Tem certeza que deseja deletar este cliente?
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
        var clienteId = button.getAttribute('data-bs-id'); // Extract info from data-bs-id attribute
        var form = deleteModal.querySelector('#deleteForm');
        form.action = '/clientes/' + clienteId; // Set the form action to the correct delete URL
    });
});
</script>
@endsection
