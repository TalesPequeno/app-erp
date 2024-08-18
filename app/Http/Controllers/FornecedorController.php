<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        $fornecedores = Fornecedor::all();
        return view('fornecedores.index', compact('fornecedores'));
    }

    public function create()
    {
        return view('fornecedores.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|max:14|unique:fornecedores',
            'telefone' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'endereco' => 'nullable|string',
        ]);

        Fornecedor::create($validatedData);

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor criado com sucesso.');
    }

    public function show($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        return view('fornecedores.show', compact('fornecedor'));
    }

    public function edit($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        return view('fornecedores.edit', compact('fornecedor'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|max:14|unique:fornecedores,cnpj,' . $id,
            'telefone' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'endereco' => 'nullable|string',
        ]);

        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->update($validatedData);

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->delete();

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor excluído com sucesso.');
    }
}
