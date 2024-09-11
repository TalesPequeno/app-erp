@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Company</h1>

    <!-- Exibe mensagens de sucesso ou erro -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulário para criação de uma nova companhia -->
    <form action="{{ route('companies.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Company Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Create</button>
        <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Cancel</a>
    </form>
</div>
@endsection
