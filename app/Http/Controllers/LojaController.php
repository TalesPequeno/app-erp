<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loja;
use App\Models\Pais;
use App\Models\Estado;
use App\Models\Cidade;

class LojaController extends Controller
{
    public function index()
    {
        $lojas = Loja::with('estado', 'pais')->paginate(10);
        return view('lojas.index', compact('lojas'));
    }

    public function create()
    {
        $paises = Pais::all();
        return view('lojas.create', compact('paises'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'razao_social' => 'required|string|max:255',
            'nome_fantasia' => 'required|string|max:255',
            'cnpj' => 'required|string|size:18',
            'cep' => 'required|string|size:9',
            'rua' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:255',
            'pais' => 'required|integer',
            'estado' => 'nullable|string|max:2',
            'estado_input' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'cidade_input' => 'nullable|string|max:255',
        ]);

        $cidade = $request->input('cidade');
        if ($request->input('pais') != 1) {
            $cidade = $request->input('cidade_input');
        }
    
        $estado = $request->input('estado');
        if ($request->input('pais') == 1) {
            $estado = Estado::find($estado)->uf;
        } else {
            $estado = $request->input('estado_input');
        }
    
        $pais = Pais::find($request->input('pais'))->nome_pt;
    
        $companyId = session('company_id');
    
        Loja::create([
            'razao_social' => $validated['razao_social'],
            'nome_fantasia' => $validated['nome_fantasia'],
            'cnpj' => $validated['cnpj'],
            'cep' => $validated['cep'],
            'rua' => $validated['rua'],
            'numero' => $validated['numero'],
            'complemento' => $validated['complemento'],
            'bairro' => $validated['bairro'],
            'pais' => $pais,
            'estado' => $estado,
            'cidade' => $cidade,
            'company_id' => $companyId,
        ]);
    
        return redirect()->route('lojas.index')->with('success', 'Loja criada com sucesso.');
    }

    public function show($id)
    {
        $loja = Loja::findOrFail($id);

        return view('lojas.show', compact('loja'));
    }

    public function edit($id)
    {
        // Encontra a loja pelo ID
        $loja = Loja::findOrFail($id);

        // Retorna a view com o formulário de edição
        return view('lojas.edit', compact('loja'));
    }

    public function update(Request $request, $id)
    {
        // Valida os dados do formulário
        $validated = $request->validate([
            'razao_social' => 'required|string|max:255',
            'nome_fantasia' => 'required|string|max:255',
            'cnpj' => 'required|string|size:18',
            'cep' => 'required|string|size:9',
            'rua' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:255',
            'pais' => 'required|integer',
            'estado' => 'nullable|string|max:2',
            'estado_input' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'cidade_input' => 'nullable|string|max:255',
        ]);

        // Atualiza a loja com os dados validados
        $loja = Loja::findOrFail($id);
        $loja->update($validated);

        // Redireciona de volta para a lista de lojas com uma mensagem de sucesso
        return redirect()->route('lojas.index')->with('success', 'Loja atualizada com sucesso.');
    }

    public function destroy($id)
    {
        // Encontra a loja pelo ID e a deleta
        $loja = Loja::findOrFail($id);
        $loja->delete();

        // Redireciona de volta para a lista de lojas com uma mensagem de sucesso
        return redirect()->route('lojas.index')->with('success', 'Loja deletada com sucesso.');
    }
}
