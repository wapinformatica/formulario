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
        'Sexo',
        'Certidao_Casamento',
        'Foto',
        'R1',
        'R2',
        'R3',
        'R4',
        'Proced_Relig_ID',
        'R6',
        'R7',
        'R8',
        'R9',
        'R10',
        'R11',
        'R12',
        'R13',
        'R14',
        'R15',
        'R16',
        'R17',
        'R18',
        'R19',
        'R20',
        'R21',
        'R22',
        'R23',
        'R24',
        'R25',
        'R26',
        'R27',
        'R28',
        'R29',
        'R30',
        'R31',
        'R32',
        'R33',
        'R34',
        'R35',
        'R36',
        'R37',
        'R38',
        'R39',
        'R40',
        'R41',
        'R42',
        'R43',
        'R44',
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
        'R8' => 'date:Y-m-d',
        'R11' => 'date:Y-m-d',
        'R18' => 'date:Y-m-d',
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

        if (in_array($key, $integerFields) && $value === '') {
            $value = null;
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
}
