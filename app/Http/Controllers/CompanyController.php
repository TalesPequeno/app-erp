<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Company;

class CompanyController extends Controller
{
    public function access(Request $request)
    {
        $user = auth()->user();
        $company = Company::findOrFail($request->company_id);

        if (!$user->companies->contains($company)) {
            abort(403, 'Acesso negado');
        }

        // Gerar token e armazenar na sessão sem hashear
        $token = Str::random(60);
        session([
            'token' => $token,
            'user_id' => $user->id,
            'company_id' => $company->id,
        ]);

        return redirect()->route('dashboard');
    }

    public function create()
    {
        return view('companies.create'); // Supondo que a view está em resources/views/companies/create.blade.php
    }

    public function store(Request $request)
    {
        // Validação dos dados
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        // Criação da companhia
        $company = new Company();
        $company->name = $validatedData['name'];
        $company->save();
    
        // Relaciona a companhia ao usuário atual na tabela company_user com timestamps
        $user = auth()->user(); // Obtém o usuário autenticado
        $company->users()->attach($user->id, [
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        // Redirecionamento após a criação com uma mensagem de sucesso
        return redirect()->route('home')->with('success', 'Company created and associated with the user successfully.');
    }
    


}
