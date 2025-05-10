<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'name_table',
        'name_column',
        'status'
    ];

    protected $table = 'columns';

    public static function queryFilter($search, $perPage)
    {
        try{
            $query = static::query()
                        ->select([
                            'columns.*'
                        ])
                        ->where( function ($query) use ($search) {
                            $query->where('columns.name_table', 'like', "%{$search}%")
                                  ->orWhere('columns.name_column', 'like', "%{$search}%");
                        })
                        ->paginate($perPage);
        } catch (\Exception $ex) {
            return [];
        }
        return $query;
    }
}
