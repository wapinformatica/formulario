<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'is_active'];

    public function questions()
    {
        return $this->hasMany(FormQuestion::class)->orderBy('order');
    }

    public function responses()
    {
        return $this->hasMany(FormResponse::class);
    }

    public static function boot()
    {
        parent::boot();
    
        static::created(function($form) {
            // Ao criar um formulário, automaticamente adiciona o campo Nome Completo
            $form->questions()->create([
                'question' => 'Nome Completo',
                'type' => 'text',
                'is_required' => true,
                'is_locked' => true,
                'order' => 0
            ]);
        });
    }  
}
