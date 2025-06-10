<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercicio extends Model
{
    use HasFactory;
    protected $primaryKey = 'Exercicio_ID';
    protected $fillable =
    [
        'Exercicio_ID',
        'Ano',
        'Data_Inicial',
        'Data_Final',
        'Descricao',
        'Fase',
        'Usu_ID'
    ];
    protected $table = 'exercicio';
}
