<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleHasPermission extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $id = false;
    protected $primaryKey = 'permission_id';
    protected $fillable =
    [
        'permission_id',
        'role_id',
    ];

    protected $table = 'role_has_permissions';
}
