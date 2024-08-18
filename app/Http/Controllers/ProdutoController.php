<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    // Exibe a lista de produtos
    public function index()
    {
        $produtos = Produto::all();
        return view('produtos.index', compact('produtos'));
    }

    // Exibe o formulário de criação de um novo produto
    public function create()
    {
        return view('produtos.create');
    }

    // Armazena um novo produto no banco de dados
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
        ]);

        Produto::create($validated);

        return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso!');
    }

    // Exibe os detalhes de um produto específico
    public function show(Produto $produto)
    {
        return view('produtos.show', compact('produto'));
    }

    // Exibe o formulário de edição de um produto existente
    public function edit(Produto $produto)
    {
        return view('produtos.edit', compact('produto'));
    }

    // Atualiza os dados de um produto existente
    public function update(Request $request, Produto $produto)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
        ]);

        $produto->update($validated);

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    // Exclui um produto do banco de dados
    public function destroy(Produto $produto)
    {
        $produto->delete();

        return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso!');
    }
}
