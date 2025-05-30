<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartRespSocial extends Model
{
    use HasFactory;
    protected $primaryKey = 'Depart_Resp_Social_ID';
    protected $fillable =
    [
        'Depart_Resp_Social_ID',
        'Depart_Resp_Social_Nome',
        'Ativo',
        'Idd_Minima',
        'Idd_Maxima',
        'Visao',
        'Data_Inicio',
        'Igreja_ID',
        'Usu_ID',
    ];

    protected $table = 'depart_resp_social';
}
