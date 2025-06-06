<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartRespSocialCandidato extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $id = false;
    protected $primaryKey = 'Depart_Resp_Social_Candidato_ID';
    protected $fillable =
    [
        'Depart_Resp_Social_Candidato_ID',
        'Depart_Resp_Social_ID',
        'Candidato_ID',
    ];

    protected $table = 'depart_resp_social_candidato';

    public function departamento()
    {
        return $this->belongsTo(DepartRespSocial::class, 'Depart_Resp_Social_ID');
    }

    public function candidato()
    {
        return $this->belongsTo(Candidato::class, 'Candidato_ID');
    }
}
