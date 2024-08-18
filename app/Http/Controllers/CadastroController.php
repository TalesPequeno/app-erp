<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pais;
use App\Models\Estado;
use App\Models\Cidade;

class CadastroController extends Controller
{
    public function createLoja()
    {
        return view('lojas.index');
    }

    public function getEstados($pais_id)
    {
        $estados = Estado::where('pais', $pais_id)->get();
        return response()->json($estados);
    }

    public function getCidades($estado_id)
    {
        $cidades = Cidade::where('uf', $estado_id)->get();
        return response()->json($cidades);
    }    
    
    public function clientes()
    {
        return view('cadastros.clientes');
    }

    public function produtos()
    {
        return view('cadastros.produtos');
    }

    public function fornecedores()
    {
        return view('cadastros.fornecedores');
    }
}
