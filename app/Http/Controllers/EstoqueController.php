<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    public function index()
    {
        $estoques = Estoque::all();
        return view('estoques.index', compact('estoques'));
    }

    public function create()
    {
        return view('estoques.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'produto_id' => 'required|integer',
            'quantidade' => 'required|integer',
            'localizacao' => 'required|string|max:255',
        ]);

        Estoque::create($validatedData);

        return redirect()->route('estoques.index')->with('success', 'Estoque criado com sucesso.');
    }

    public function show($id)
    {
        $estoque = Estoque::findOrFail($id);
        return view('estoques.show', compact('estoque'));
    }

    public function edit($id)
    {
        $estoque = Estoque::findOrFail($id);
        return view('estoques.edit', compact('estoque'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'produto_id' => 'required|integer',
            'quantidade' => 'required|integer',
            'localizacao' => 'required|string|max:255',
        ]);

        $estoque = Estoque::findOrFail($id);
        $estoque->update($validatedData);

        return redirect()->route('estoques.index')->with('success', 'Estoque atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $estoque = Estoque::findOrFail($id);
        $estoque->delete();

        return redirect()->route('estoques.index')->with('success', 'Estoque excluído com sucesso.');
    }
}
