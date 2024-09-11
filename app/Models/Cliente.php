<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // Define a tabela associada ao modelo
    protected $table = 'clientes';

    // Define os atributos que podem ser preenchidos em massa
    protected $fillable = [
        'nome',
        'nome_fantasia',
        'cpf_cnpj',
        'data_nascimento',
        'email',
        'telefone',
        'celular',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cep',
        'cidade',
        'estado',
        'pais',
        'status',
        'descricao',
    ];

    // Define os tipos de atributos
    protected $casts = [
        'data_nascimento' => 'date',
    ];
}
