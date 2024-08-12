@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <p>Bem-vindo à companhia: {{ $company->name }}</p>
</div>
@endsection
