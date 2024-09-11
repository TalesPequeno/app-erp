<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pais;
use App\Models\Estado; // Importar o modelo Estado
use App\Models\Cidade; // Importar o modelo Cidade
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // Exibe o formulário de criação de um novo cliente
    public function create()
    {
        $paises = Pais::all(); // Carrega todos os países
        $estados = Estado::all(); // Carrega todos os estados
        $cidades = Cidade::all(); // Carrega todas as cidades
        return view('clientes.create', compact('paises', 'estados', 'cidades')); // Passa os dados para a view
    }

    // Armazena um novo cliente no banco de dados
    public function store(Request $request)
    {
        // Validação dos dados
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'nome_fantasia' => 'nullable|string|max:255',
            'cpf_cnpj' => 'nullable|string|unique:clientes,cpf_cnpj|max:18',
            'data_nascimento' => 'nullable|date',
            'email' => 'nullable|email|unique:clientes,email|max:255',
            'telefone' => 'nullable|string|max:20',
            'celular' => 'nullable|string|max:20',
            'endereco' => 'nullable|string|max:255',
            'numero' => 'nullable|string|max:10',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cep' => 'nullable|string|max:9',
            'cidade' => 'nullable|string|max:255',  // Ajuste para cidade como string
            'estado' => 'nullable|string|max:255',  // Ajuste para estado como string
            'pais' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:ativo,inativo',
            'descricao' => 'nullable|string',
        ]);
    
        // Criação do cliente com os dados validados
        Cliente::create($validatedData);
    
        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }
    

    // Lista clientes com busca
    public function index(Request $request)
    {
        // Captura o termo de busca, se existir
        $search = $request->input('search');

        // Se houver um termo de busca, filtra os clientes pelo nome ou email
        $clientes = Cliente::query()
            ->when($search, function ($query, $search) {
                return $query->where('nome', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%");
            })
            ->paginate(10); // Exibe 10 clientes por página

        // Retorna a view com os clientes e o termo de busca
        return view('clientes.index', compact('clientes'));
    }

    // Exibe os detalhes de um cliente específico
    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    // Exibe o formulário de edição de um cliente existente
    public function edit(Cliente $cliente)
    {
        $paises = Pais::all(); // Carrega os países
        $estados = Estado::all(); // Carrega os estados
        $cidades = Cidade::all(); // Carrega as cidades
        return view('clientes.edit', compact('cliente', 'paises', 'estados', 'cidades'));
    }

    // Atualiza os dados de um cliente existente
    public function update(Request $request, Cliente $cliente)
    {
        // Validação dos dados atualizados
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email,' . $cliente->id,
            'telefone' => 'nullable|string|max:20',
            'celular' => 'required|string|max:20',
            'endereco' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:255',
            'cep' => 'required|string|max:9',
            'cidade_id' => 'required|exists:cidades,id', // Valida a cidade
            'estado_id' => 'required|exists:estados,id', // Valida o estado
            'pais' => 'required|string|max:255',
            'status' => 'required|string|in:ativo,inativo',
            'descricao' => 'nullable|string',
        ]);

        // Atualiza os dados do cliente
        $cliente->update($validated);

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    // Exclui um cliente do banco de dados
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente excluído com sucesso!');
    }
}
