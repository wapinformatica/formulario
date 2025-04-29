<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormResponse extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = ['form_id', 'status', 'approval_notes', 'processed_at', 'processed_by'];

    public function answers()
    {
        return $this->hasMany(FormResponseAnswer::class, 'response_id');
    }

    public function processor()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
