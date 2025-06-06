<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SociedadeInternaCandidato extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $id = false;
    protected $primaryKey = 'Sociedade_Interna_Candidato_ID';
    protected $fillable =
    [
        'Sociedade_Interna_Candidato_ID',
        'Sociedade_Interna_ID',
        'Candidato_ID',
    ];

    protected $table = 'sociedades_internas_candidato';

    public function sociedadeInterna()
    {
        return $this->belongsTo(SociedadeInterna::class, 'Sociedade_Interna_ID');
    }

    public function candidato()
    {
        return $this->belongsTo(Candidato::class, 'Candidato_ID');
    }
}
