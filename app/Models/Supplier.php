<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    /**
     * Definindo a tabela associada ao model (caso o nome não siga o padrão).
     */
    protected $table = 'suppliers'; // Atualizado para suppliers

    /**
     * Os atributos que podem ser preenchidos em massa.
     */
    protected $fillable = [
        'nome', // Atualizado para name
        'nome_fantasia', // Atualizado para fantasy_name
        'cpf_cnpj', // Mantido como cpf_cnpj
        'data_nascimento', // Atualizado para birth_date
        'email',
        'telefone', // Atualizado para phone
        'celular', // Atualizado para cell
        'endereco', // Atualizado para address
        'numero', // Atualizado para number
        'complemento', // Atualizado para complement
        'bairro', // Atualizado para neighborhood
        'cep', // Atualizado para postal_code
        'cidade', // Atualizado para city
        'estado', // Atualizado para state
        'pais', // Atualizado para country
        'status', // Atualizado para status
        'descricao', // Atualizado para description
    ];

    /**
     * Atributos que devem ser convertidos para tipos nativos.
     */
    protected $casts = [
        'birth_date' => 'date', // Atualizado para birth_date
    ];
}
