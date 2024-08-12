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
}
