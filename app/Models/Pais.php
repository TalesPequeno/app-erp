<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;

    protected $table = 'pais';

    protected $fillable = [
        'nome',
        'nome_pt',
        'sigla',
        'bacen',
    ];

    protected $primaryKey = 'id';

    public function lojas()
    {
        return $this->hasMany(Loja::class, 'pais', 'id');
    }

}
