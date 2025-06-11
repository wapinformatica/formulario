<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;
    protected $primaryKey = 'Pes_ID';
    protected $fillable =
    [
        'Pes_ID',
        'Nome',
        'e_mail',
    ];
    protected $table = 'pessoas';
}
