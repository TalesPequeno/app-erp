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
        'name', // Atualizado para name
        'fantasy_name', // Atualizado para fantasy_name
        'cpf_cnpj', // Mantido como cpf_cnpj
        'birth_date', // Atualizado para birth_date
        'email',
        'phone', // Atualizado para phone
        'cell', // Atualizado para cell
        'address', // Atualizado para address
        'number', // Atualizado para number
        'complement', // Atualizado para complement
        'neighborhood', // Atualizado para neighborhood
        'postal_code', // Atualizado para postal_code
        'cidade', // Atualizado para city
        'estado', // Atualizado para state
        'pais', // Atualizado para country
        'status', // Atualizado para status
        'description', // Atualizado para description
    ];

    /**
     * Atributos que devem ser convertidos para tipos nativos.
     */
    protected $casts = [
        'birth_date' => 'date', // Atualizado para birth_date
    ];
}
