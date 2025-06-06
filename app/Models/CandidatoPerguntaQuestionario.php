<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidatoPerguntaQuestionario extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'Pergunta_ID';
    protected $fillable =
    [
        'Pergunta_ID',
        'Pergunta',
        'Alternativa',
        'Texto_Longo',
        'Ativo',
        'Obrigatorio',
        'Ordem'
    ];

    protected $table = 'candidatos_perguntas_questionario';
}
