<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SociedadeInterna extends Model
{
    use HasFactory;
    protected $primaryKey = 'Sociedade_Interna_ID';
    protected $fillable =
    [
        'Sociedade_Interna_ID',
        'Sociedade_Interna_Nome',
        'Ativo',
        'Idd_Minima',
        'Idd_Maxima',
        'Visao',
        'Data_Inicio',
        'Igreja_ID',
        'Usu_ID',
    ];

    protected $table = 'sociedades_internas';
}
