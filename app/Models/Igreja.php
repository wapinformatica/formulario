<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Igreja extends Model
{
    use HasFactory;
    protected $primaryKey = 'Igreja_ID';
    protected $fillable =
    [
        'Igreja_ID',
        'Igreja_Nome',
        'Ativo',
    ];
    protected $table = 'igreja';
}
