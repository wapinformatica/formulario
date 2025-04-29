<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelHasRole extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $id = false;
    protected $primaryKey = 'role_id';
    protected $fillable =
    [
        'model_type',
        'role_id',
        'model_id'
    ];

    protected $table = 'model_has_roles';
}
