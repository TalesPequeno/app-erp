<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $companyId = session('company_id');
        $company = Company::findOrFail($companyId);

        // Comparar o token da sessão com o esperado
        $token = session('token');
        if ($token !== session('token')) {
            abort(403, 'Token inválido');
        }

        if (!$user->companies->contains($company)) {
            abort(403, 'Acesso negado');
        }

        return view('dashboard', compact('company'));
    }
}
