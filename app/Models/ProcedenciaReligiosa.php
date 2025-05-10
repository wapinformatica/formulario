<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcedenciaReligiosa extends Model
{
    use HasFactory;
    protected $primaryKey = 'Proced_Relig_ID';
    protected $fillable =
    [
        'Proced_Relig_ID',
        'Proced_Relig_Nome',
        'Usu_ID'
    ];

    protected $table = 'procedencia_religiosa';
}
