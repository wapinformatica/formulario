<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormResponseAnswer extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Corrigir o nome do relacionamento
    public function response()
    {
        return $this->belongsTo(FormResponse::class, 'response_id');
    }

    public function question()
    {
        return $this->belongsTo(FormQuestion::class, 'question_id');
    }
}
