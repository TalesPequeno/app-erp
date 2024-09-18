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
            <form action="{{ route('fornecedores.update', $fornecedor->id) }}" method="POST">
                @csrf
                @method('PUT')

                @foreach ([
                    ['name', 'Nome', 'text', true],
                    ['fantasy_name', 'Nome Fantasia', 'text'],
                    ['cpf_cnpj', 'CPF/CNPJ', 'text', false, 'maxlength=18 oninput=formatCpfCnpj(this)'],
                    ['birth_date', 'Data de Nascimento', 'date'],
                    ['email', 'E-mail', 'email'],
                    ['phone', 'Telefone', 'tel'],
                    ['cell', 'Celular', 'tel'],
                    ['address', 'Endereço', 'text'],
                    ['number', 'Número', 'text', false, 'class=form-control id=numero'],
                    ['complement', 'Complemento', 'text'],
                    ['neighborhood', 'Bairro', 'text'],
                    ['postal_code', 'CEP', 'text', false, 'maxlength=9 oninput=formatCep(this)'],
                    ['city', 'Cidade', 'text'],
                    ['state', 'Estado', 'text'],
                    ['pais', 'País', 'text'],
                ] as [$name, $label, $type, $required = false, $extra = ''])
                    <div class="form-floating mb-3">
                        <input type="{{ $type }}" class="form-control" id="{{ $name }}" name="{{ $name }}" placeholder="{{ $label }}" value="{{ old($name, $fornecedor->$name) }}" {{ $required ? 'required' : '' }} {!! $extra !!}>
                        <label for="{{ $name }}">{{ $label }}</label>
                        @error($name) <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                @endforeach

                <div class="form-floating mb-3">
                    <select class="form-select" id="status" name="status" required>
                        <option value="ativo" {{ old('status', $fornecedor->status) == 'ativo' ? 'selected' : '' }}>Ativo</option>
                        <option value="inativo" {{ old('status', $fornecedor->status) == 'inativo' ? 'selected' : '' }}>Inativo</option>
                    </select>
                    <label for="status">Status</label>
                    @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-floating mb-3">
                    <textarea class="form-control" id="descricao" name="descricao" placeholder="Descrição">{{ old('descricao', $fornecedor->descricao) }}</textarea>
                    <label for="descricao">Descrição</label>
                    @error('descricao') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success btn-lg mr-2">Atualizar</button>
                    <a href="{{ route('fornecedores.index') }}" class="btn btn-outline-danger btn-lg ml-2">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/form-format.js') }}"></script>

@endsection
