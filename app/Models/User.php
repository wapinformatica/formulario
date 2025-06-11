<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use Exception;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function queryFilter($search, $perPage)
    {
        try{
            $query = static::query()
                        ->select([
                            'users.*'
                        ])
                        ->where('id', '!=', 1) // Exclude the default admin user
                        ->where( function ($query) use ($search) {
                            $query->where('users.name', 'like', "%{$search}%")
                                  ->orWhere('users.email', 'like', "%{$search}%");
                        })
                        ->paginate($perPage);
        } catch (Exception $ex) {
            return [];
        }
        return $query;
    }
}
