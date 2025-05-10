<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoCivil extends Model
{
    use HasFactory;
    protected $primaryKey = 'Estado_Civil_ID';
    protected $fillable =
    [
        'Estado_Civil_ID',
        'Estado_Civil_Nome',
        'Usu_ID'
    ];

    protected $table = 'estado_civil';
}
