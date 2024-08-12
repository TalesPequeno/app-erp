@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Companhias</h1>
    @if($companies->isEmpty())
        <div class="alert alert-warning">
            Você não tem nenhuma companhia associada.
        </div>
    @else
        @foreach($companies as $company)
            <a href="{{ route('company.access', ['company_id' => $company->id]) }}" class="btn btn-primary">
                {{ $company->name }}
            </a>
        @endforeach
    @endif
</div>
@endsection
