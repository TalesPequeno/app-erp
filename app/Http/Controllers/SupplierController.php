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
        $paises = Pais::all();
        $estados = Estado::all();
        $cidades = Cidade::all();
        return view('suppliers.create', compact('paises', 'estados', 'cidades'));
    }

    /**
     * Armazena um novo fornecedor no banco de dados.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'nome_fantasia' => 'nullable|string|max:255',
            'cpf_cnpj' => 'nullable|string|max:18|unique:suppliers',
            'data_nascimento' => 'nullable|date',
            'email' => 'nullable|email|max:255',
            'telefone' => 'nullable|string|max:20',
            'celular' => 'nullable|string|max:20',
            'endereco' => 'nullable|string|max:255',
            'numero' => 'nullable|string|max:10',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cep' => 'nullable|string|max:9',
            'cidade' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:255',
            'pais' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:ativo,inativo',
            'descricao' => 'nullable|string',
        ]);

        Supplier::create($validatedData);

        return redirect()->route('suppliers.index')->with('success', 'Fornecedor cadastrado com sucesso!');
    }

    /**
     * Exibe uma lista de fornecedores com paginação e busca.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $suppliers = Supplier::query()
            ->when($search, function ($query, $search) {
                return $query->where('nome', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%");
            })
            ->paginate(10);

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
        $paises = Pais::all();
        $estados = Estado::all();
        $cidades = Cidade::all();

        return view('suppliers.edit', compact('supplier', 'paises', 'estados', 'cidades'));
    }

    /**
     * Atualiza um fornecedor no banco de dados.
     */
    public function update(Request $request, Supplier $supplier)
    {

        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'nome_fantasia' => 'nullable|string|max:255',
            'cpf_cnpj' => 'nullable|string|max:18|unique:suppliers,cpf_cnpj,' . $supplier->id,
            'data_nascimento' => 'nullable|date',
            'email' => 'nullable|email|max:255',
            'telefone' => 'nullable|string|max:20',
            'celular' => 'nullable|string|max:20',
            'endereco' => 'nullable|string|max:255',
            'numero' => 'nullable|string|max:10',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cep' => 'nullable|string|max:9',
            'cidade' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:255',
            'pais' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:ativo,inativo',
            'descricao' => 'nullable|string',
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
        $states = Estado::where('pais_id', $countryId)->get();
        return response()->json($states);
    }

    /**
     * Obtém as cidades de um estado específico para uso em AJAX.
     */
    public function cities($stateId)
    {
        $cities = Cidade::where('estado_id', $stateId)->get();
        return response()->json($cities);
    }
}
