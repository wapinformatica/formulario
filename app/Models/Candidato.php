<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'Candidato_ID';
    protected $fillable =
    [
        'Nome_Candidato',
        'Nome_Mae',
        'Nome_Pai',
        'Naturalidade_ID',
        'Cidade_Origem_ID',
        'Cpf',
        'Rg',
        'Orgao_Exp',
        'e_mail',
        'Data_Cadastro',
        'Logradouro',
        'Numero',
        'Complemento',
        'Bairro',
        'CEP',
        'Cidade_ID',
        'Data_Nascimento',
        'Fone_Comercial',
        'Fone_Celular',
        'Profissao_ID',
        'Estado_Civil_ID',
        'Nome_Conj',
        'Data_Nasc_Conj',
        'Naturalidade_Conj_ID',
        'Profissao_Conj_ID',
        'Data_Casamento',
        'Nome_F1',
        'P_11',
        'P_12',
        'Data_Nasc_F1',
        'Naturalidade_F1_ID',
        'Nome_F2',
        'P_21',
        'P_22',
        'Data_Nasc_F2',
        'Naturalidade_F2_ID',
        'Nome_F3',
        'P_31',
        'P_32',
        'Data_Nasc_F3',
        'Naturalidade_F3_ID',
        'URL_Certidao_Casamento',
        'Nome_F4',
        'P_41',
        'P_42',
        'Data_Nasc_F4',
        'Naturalidade_F4_ID',
        'Nome_F5',
        'P_51',
        'P_52',
        'Data_Nasc_F5',
        'Naturalidade_F5_ID',
        'Exercicio_ID',
        'Sexo',
        'Certidao_Casamento',
        'Foto',
        'Proced_Relig_ID',
        'IPB_Membro',
        'IPB_Ig_Bat',
        'IPB_Data_Bat',
        'IPB_Pr_Bat',
        'IPB_Ig_Prf_Fe',
        'IPB_Data_Prof_Fe',
        'IPB_Pr_Prof_Fe',
        'OIE_Membro',
        'OIE_Data_Bat',
        'OIE_Pr_Bat',
        'Exerc_F_Ig',
        'Igreja_ID',
        'Se_Sim_Quais',
    ];

    protected $table = 'candidatos';

    protected $casts = [
        // Campos inteiros
        'Naturalidade_Conj_ID' => 'integer',
        'Naturalidade_F1_ID' => 'integer',
        'Naturalidade_F2_ID' => 'integer',
        'Naturalidade_F3_ID' => 'integer',
        'Naturalidade_F4_ID' => 'integer',
        'Naturalidade_F5_ID' => 'integer',
        'Profissao_Conj_ID' => 'integer',

        // Campos de data
        'Data_Nascimento' => 'date:Y-m-d',
        'Data_Nasc_Conj' => 'date:Y-m-d',
        'Data_Casamento' => 'date:Y-m-d',
        'Data_Nasc_F1' => 'date:Y-m-d',
        'Data_Nasc_F2' => 'date:Y-m-d',
        'Data_Nasc_F3' => 'date:Y-m-d',
        'Data_Nasc_F4' => 'date:Y-m-d',
        'Data_Nasc_F5' => 'date:Y-m-d',
        'IPB_Data_Bat' => 'date:Y-m-d',
        'IPB_Data_Prof_Fe' => 'date:Y-m-d',
        'OIE_Data_Bat' => 'date:Y-m-d',
    ];

    public function setAttribute($key, $value)
    {
        // Lista de campos que devem ser convertidos
        $integerFields = [
            'Naturalidade_Conj_ID',
            'Naturalidade_F1_ID',
            'Naturalidade_F2_ID',
            'Naturalidade_F3_ID',
            'Naturalidade_F4_ID',
            'Naturalidade_F5_ID',
            'Profissao_Conj_ID'
        ];

        $capitalizeFields = [
            'Nome_Candidato',
            'Nome_Mae',
            'Nome_Pai',
            'Logradouro',
            'Complemento',
            'Bairro',
            'Nome_Conj',
            'Nome_F1',
            'Nome_F2',
            'Nome_F3',
            'Nome_F4',
            'Nome_F5',
            'IPB_Ig_Bat',
            'IPB_Pr_Bat',
            'IPB_Ig_Prf_Fe',
            'IPB_Pr_Prof_Fe',
            'OIE_Pr_Bat',
            'Se_Sim_Quais',
        ];

        if (in_array($key, $integerFields) && $value === '') {
            $value = null;
        } elseif (in_array($key, $capitalizeFields) && is_string($value)) {
            $value = ucwords(strtolower($value));
        }

        return parent::setAttribute($key, $value);
    }

    public function estadoCivil()
    {
        return $this->belongsTo(EstadoCivil::class, 'Estado_Civil_ID');
    }
    public function profissao()
    {
        return $this->belongsTo(Profissao::class, 'Profissao_ID');
    }
    public function naturalidade()
    {
        return $this->belongsTo(Cidade::class, 'Naturalidade_ID');
    }
    public function cidadeOrigem()
    {
        return $this->belongsTo(Cidade::class, 'Cidade_Origem_ID');
    }
    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'Cidade_ID');
    }
    public function naturalidadeConj()
    {
        return $this->belongsTo(Cidade::class, 'Naturalidade_Conj_ID');
    }
    public function profissaoConj()
    {
        return $this->belongsTo(Profissao::class, 'Profissao_Conj_ID');
    }
    public function procedencia()
    {
        return $this->belongsTo(ProcedenciaReligiosa::class, 'Proced_Relig_ID');
    }

    public function respostas()
    {
        return $this->hasMany(CandidatoRespostaQuestionario::class, 'Candidato_ID');
    }

    public function sociedades()
    {
        return $this->hasMany(SociedadeInternaCandidato::class, 'Candidato_ID');
    }

    public function departamentos()
    {
        return $this->hasMany(DepartRespSocialCandidato::class, 'Candidato_ID');
    }
}
