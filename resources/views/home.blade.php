@extends('layouts.app')

@section('content')
<a href="{{ route('companies.create') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Nova Companhia
    </a>
<div class="container d-flex justify-content-center align-items-center" style="height: 50vh; background-color: #f5f7fa;">
    <div class="account-selection text-center" style="background-color: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);">
        <h1 class="mb-4" style="font-weight: 700;">Escolha uma conta</h1>
        @if($companies->isEmpty())
            <div class="alert alert-warning">
                Você não tem nenhuma conta associada.
            </div>
        @else
            @foreach($companies as $company)
                <a href="{{ route('company.access', ['company_id' => $company->id]) }}" class="btn btn-primary">
                    {{ $company->name }}
                </a>
            @endforeach
        @endif
    </div>
</div>
@endsection