<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    use HasFactory;
    protected $primaryKey = 'Cidade_ID';
    protected $fillable =
    [
        'Cidade_ID',
        'Cidade_Nome',
        'UF',
        'Cidade_Nome_UF',
        'Usu_ID'
    ];

    protected $table = 'cidades';
}
