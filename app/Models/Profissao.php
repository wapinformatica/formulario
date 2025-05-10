<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profissao extends Model
{
    use HasFactory;
    protected $primaryKey = 'Profissao_ID';
    protected $fillable =
    [
        'Profissao_ID',
        'Profissao_Nome',
        'Usu_ID'
    ];

    protected $table = 'profissoes';
}
