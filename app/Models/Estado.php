<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $table = 'estado';

    protected $fillable = [
        'nome',
        'uf',
        'ibge',
        'pais',
        'ddd',
    ];

    protected $primaryKey = 'id';

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais', 'id');
    }

    public function lojas()
    {
        return $this->hasMany(Loja::class, 'estado', 'id');
    }

}
