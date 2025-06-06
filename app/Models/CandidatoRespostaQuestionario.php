<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidatoRespostaQuestionario extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'Resposta_ID';
    protected $fillable =
    [
        'Resposta_ID',
        'Resposta',
        'Pergunta_ID',
        'Candidato_ID',
    ];

    protected $table = 'candidatos_respostas_questionario';

    public function pergunta()
    {
        return $this->belongsTo(CandidatoPerguntaQuestionario::class, 'Pergunta_ID');
    }

    public function candidato()
    {
        return $this->belongsTo(Candidato::class, 'Candidato_ID');
    }
}
