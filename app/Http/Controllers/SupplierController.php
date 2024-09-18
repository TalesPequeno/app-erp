<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Pais;
use App\Models\Estado;
use App\Models\Cidade;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Exibe o formulário de criação de fornecedor.
     */
    public function create()
    {
        $paises = Pais::all(); // Carrega todos os países
        $estados = Estado::all(); // Carrega todos os estados
        $cidades = Cidade::all(); // Carrega todas as cidades
        return view('suppliers.create', compact('paises', 'estados', 'cidades')); // Passa os dados para a view
    }

    /**
     * Armazena um novo fornecedor no banco de dados.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'fantasy_name' => 'nullable|string|max:255',
            'cpf_cnpj' => 'nullable|string|max:18|unique:suppliers',
            'birth_date' => 'nullable|date',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'cell' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'number' => 'nullable|string|max:10',
            'complement' => 'nullable|string|max:255',
            'neighborhood' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:9',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:active,inactive',
            'description' => 'nullable|string',
        ]);

        Supplier::create($validatedData);

        return redirect()->route('suppliers.index')->with('success', 'Fornecedor cadastrado com sucesso!');
    }

    /**
     * Exibe uma lista de fornecedores com paginação e busca.
     */
    public function index(Request $request)
    {
        // Captura o termo de busca, se existir
        $search = $request->input('search');

        // Se houver um termo de busca, filtra os fornecedores pelo nome ou email
        $suppliers = Supplier::query() // Correção: Use Supplier em vez de Cliente
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%");
            })
            ->paginate(10); // Exibe 10 fornecedores por página

        // Retorna a view com os fornecedores e o termo de busca
        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Exibe um fornecedor específico.
     */
    public function show(Supplier $supplier)
    {
        return view('suppliers.show', compact('supplier'));
    }

    /**
     * Exibe o formulário de edição de um fornecedor.
     */
    public function edit(Supplier $supplier)
    {
        $paises = Pais::all(); // Carrega todos os países
        $estados = Estado::all(); // Carrega todos os estados
        $cidades = Cidade::all(); // Carrega todas as cidades

        return view('suppliers.edit', compact('supplier', 'paises', 'estados', 'cidades'));
    }

    /**
     * Atualiza um fornecedor no banco de dados.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'fantasy_name' => 'nullable|string|max:255',
            'cpf_cnpj' => 'nullable|string|max:18|unique:suppliers,cpf_cnpj,' . $supplier->id,
            'birth_date' => 'nullable|date',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'cell' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'number' => 'nullable|string|max:10',
            'complement' => 'nullable|string|max:255',
            'neighborhood' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:9',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:active,inactive',
            'description' => 'nullable|string',
        ]);

        $supplier->update($validatedData);

        return redirect()->route('suppliers.index')->with('success', 'Fornecedor atualizado com sucesso!');
    }

    /**
     * Remove um fornecedor do banco de dados.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Fornecedor excluído com sucesso!');
    }

    /**
     * Obtém os estados de um país específico para uso em AJAX.
     */
    public function states($countryId)
    {
        $states = Estado::where('pais_id', $countryId)->get(); // Ajustado para pais_id
        return response()->json($states);
    }

    /**
     * Obtém as cidades de um estado específico para uso em AJAX.
     */
    public function cities($stateId)
    {
        $cities = Cidade::where('estado_id', $stateId)->get(); // Ajustado para estado_id
        return response()->json($cities);
    }
}
