<?php

namespace App\Http\Livewire;

use App\Models\Candidato;
use App\Models\Cidade;
use App\Models\EstadoCivil;
use Livewire\Component;
use App\Models\ProcedenciaReligiosa;
use App\Models\Profissao;
use Livewire\WithFileUploads;

class CandidateForm extends Component
{
    use WithFileUploads;
    public $form;
    public $formId;
    public $answers = [];
    public $success = false;

    public $data = [
        'Nome_Candidato' => '',
        'Nome_Mae' => '',
        'Nome_Pai' => '',
        'Naturalidade_ID' => NULL,
        'Cidade_Origem_ID' => NULL,
        'Cpf' => '',
        'Rg' => '',
        'Orgao_Exp' => '',
        'e_mail' => '',
        'Data_Cadastro' => '',
        'Logradouro' => '',
        'Numero' => '',
        'Complemento' => '',
        'Bairro' => '',
        'CEP' => '',
        'Cidade_ID' => NULL,
        'Data_Nascimento' => '',
        'Fone_Comercial' => '',
        'Fone_Celular' => '',
        'Profissao_ID' => NULL,
        'Estado_Civil_ID' => NULL,
        'Nome_Conj' => '',
        'Data_Nasc_Conj' => NULL,
        'Naturalidade_Conj_ID' => NULL,
        'Profissao_Conj_ID' => NULL,
        'Data_Casamento' => NULL,
        'Nome_F1' => '',
        'P_11' => '',
        'P_12' => '',
        'Data_Nasc_F1' => NULL,
        'Nome_F2' => '',
        'P_21' => '',
        'P_22' => '',
        'Data_Nasc_F2' => NULL,
        'Nome_F3' => '',
        'P_31' => '',
        'P_32' => '',
        'Data_Nasc_F3' => NULL,
        'Nome_F4' => '',
        'P_41' => '',
        'P_42' => '',
        'Data_Nasc_F4' => NULL,
        'Nome_F5' => '',
        'P_51' => '',
        'P_52' => '',
        'Data_Nasc_F5' => NULL,
        'Sexo' => '',
        'Certidao_Casamento' => '',
        'Foto' => '',
        'R1' => '',
        'R2' => '',
        'R3' => '',
        'R4' => '',
        'R5' => '',
        'R6' => '',
        'R7' => '',
        'R8' => NULL,
        'Proced_Relig_ID' => NULL,
        'R9' => '',
        'R10' => '',
        'R11' => NULL,
        'R12' => '',
        'R13' => '',
        'R14' => '',
        'R15' => '',
        'R18' => NULL,
        'R19' => '',
        'R20' => '',
        'R21' => '',
        'R22' => '',
        'R23' => '',
        'R24' => '',
        'R16' => '',
        'R17' => '',
        'R25' => '',
        'R26' => '',
        'R27' => '',
        'R28' => '',
        'R29' => '',
        'R30' => '',
        'R31' => '',
        'R32' => '',
        'R33' => '',
        'R34' => '',
        'R35' => '',
        'R36' => '',
        'R37' => '',
        'R38' => '',
        'R39' => '',
        'R40' => '',
        'R41' => '',
        'R42' => '',
        'R43' => '',
        'R44' => '',
        'R45' => '',
        'R46' => '',
        'R47' => '',
    ];

    public $cidades = [];

    public $profissoes = [];

    public $estadoCivils = [];

    public $procedencias = [];

    public function render()
    {
        return view('livewire.candidate-form');
    }

    public function mount()
    {
        $this->cidades = Cidade::whereNotNull('Cidade_ID')->get();
        $this->profissoes = Profissao::whereNotNull('Profissao_ID')->get();
        $this->estadoCivils = EstadoCivil::whereNotNull('Estado_Civil_ID')->get();
        $this->procedencias = ProcedenciaReligiosa::whereNotNull('Proced_Relig_ID')->get();

        $this->data['Data_Cadastro'] = date('Y-m-d');
    }

    protected function rules()
    {
        return [
            'data.Nome_Candidato' => 'required|string|max:50',
            'data.Nome_Mae' => 'required|string|max:50',
            'data.Nome_Pai' => 'nullable|string|max:50',
            'data.Naturalidade_ID' => 'required|exists:cidades,Cidade_ID',
            'data.Cidade_Origem_ID' => 'required|exists:cidades,Cidade_ID',
            'data.Cpf' => 'required|string|max:14|cpf',
            'data.Rg' => 'required|string|max:20',
            'data.Orgao_Exp' => 'required|string|max:10',
            'data.e_mail' => 'required|email|max:50',
            'data.Logradouro' => 'required|string|max:255',
            'data.Numero' => 'required|numeric',
            'data.Complemento' => 'nullable|string|max:255',
            'data.Bairro' => 'required|string|max:255',
            'data.CEP' => 'required|string|max:9',
            'data.Cidade_ID' => 'required|exists:cidades,Cidade_ID',
            'data.Data_Nascimento' => 'required|date',
            'data.Fone_Comercial' => 'required|string|max:50',
            'data.Fone_Celular' => 'required|string|max:50',
            'data.Profissao_ID' => 'required|exists:profissoes,Profissao_ID',
            'data.Estado_Civil_ID' => 'required|exists:estado_civil,Estado_Civil_ID',
            'data.Nome_Conj' => 'nullable|string|max:50',
            'data.Data_Nasc_Conj' => 'nullable|date',
            'data.Naturalidade_Conj_ID' => 'nullable|exists:cidades,Cidade_ID',
            'data.Profissao_Conj_ID' => 'nullable|exists:profissoes,Profissao_ID',
            'data.Data_Casamento' => 'nullable|date',
            'data.Nome_F1' => 'nullable|string|max:50',
            'data.P_11' => 'nullable|in:Sim,Não',
            'data.P_12' => 'nullable|in:Sim,Não',
            'data.Data_Nasc_F1' => 'nullable|date',
            'data.Naturalidade_F1_ID' => 'nullable|exists:cidades,Cidade_ID',
            'data.Nome_F2' => 'nullable|string|max:50',
            'data.P_21' => 'nullable|in:Sim,Não',
            'data.P_22' => 'nullable|in:Sim,Não',
            'data.Data_Nasc_F2' => 'nullable|date',
            'data.Naturalidade_F2_ID' => 'nullable|exists:cidades,Cidade_ID',
            'data.Nome_F3' => 'nullable|string|max:50',
            'data.P_31' => 'nullable|in:Sim,Não',
            'data.P_32' => 'nullable|in:Sim,Não',
            'data.Data_Nasc_F3' => 'nullable|date',
            'data.Naturalidade_F3_ID' => 'nullable|exists:cidades,Cidade_ID',
            'data.Nome_F4' => 'nullable|string|max:50',
            'data.P_41' => 'nullable|in:Sim,Não',
            'data.P_42' => 'nullable|in:Sim,Não',
            'data.Data_Nasc_F4' => 'nullable|date',
            'data.Naturalidade_F4_ID' => 'nullable|exists:cidades,Cidade_ID',
            'data.Nome_F5' => 'nullable|string|max:50',
            'data.P_51' => 'nullable|in:Sim,Não',
            'data.P_52' => 'nullable|in:Sim,Não',
            'data.Data_Nasc_F5' => 'nullable|date',
            'data.Naturalidade_F5_ID' => 'nullable|exists:cidades,Cidade_ID',
            'data.Sexo' => 'required|in:M,F',
            'data.Certidao_Casamento' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'data.Foto' => 'required|file|image|max:2048',
            'data.R1' => 'nullable|in:Sim,Não',
            'data.R2' => 'required|string|max:8',
            'data.R3' => 'nullable|string|max:1',
            'data.R4' => 'nullable|in:Sim,Não',
            'data.Proced_Relig_ID' => 'required|exists:procedencia_religiosa,Proced_Relig_ID',
            'data.R6' => 'nullable|in:Sim,Não',
            'data.R7' => 'nullable|string|max:50',
            'data.R8' => 'nullable|date',
            'data.R9' => 'nullable|string|max:80',
            'data.R10' => 'nullable|string|max:50',
            'data.R11' => 'nullable|date',
            'data.R12' => 'nullable|string|max:80',
            'data.R13' => 'required|in:Sim,Não',
            'data.R14' => 'nullable|string|max:50',
            'data.R15' => 'required|in:Sim,Não',
            'data.R16' => 'nullable|string|max:50',
            'data.R17' => 'nullable|in:Sim,Não',
            'data.R18' => 'nullable|date',
            'data.R19' => 'nullable|string|max:50',
            'data.R20' => 'required|in:Sim,Não',
            'data.R21' => 'nullable|string|max:50',
            'data.R22' => 'nullable|string',
            'data.R23' => 'nullable|string',
            'data.R24' => 'required|in:Sim,Não',
            'data.R25' => 'required|in:Sim,Não',
            'data.R26' => 'nullable|string',
            'data.R27' => 'required|in:Sim,Não',
            'data.R28' => 'nullable|in:Sim,Não',
            'data.R29' => 'required|in:Sim,Não',
            'data.R30' => 'required|string',
            'data.R31' => 'required|in:Sim,Não',
            'data.R32' => 'nullable|string',
            'data.R33' => 'required|in:Sim,Não',
            'data.R34' => 'nullable|string|max:100',
            'data.R35' => 'nullable|in:Sim,Não',
            'data.R36' => 'required|string',
            'data.R37' => 'required|string',
            'data.R38' => 'required|in:Sim,Não',
            'data.R39' => 'nullable|string',
            'data.R40' => 'required|in:Sim,Não',
            'data.R41' => 'required|in:Sim,Não',
            'data.R42' => 'required|string',
            'data.R43' => 'required|string',
            'data.R44' => 'required|string',
        ];
    }

    protected function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'max' => 'O campo :attribute não pode ter mais que :max caracteres.',
            'email' => 'O campo :attribute deve ser um e-mail válido.',
            'date' => 'O campo :attribute deve ser uma data válida.',
            'numeric' => 'O campo :attribute deve ser um número.',
            'in' => 'O campo :attribute deve ser uma das opções válidas.',
            'exists' => 'O valor selecionado para :attribute é inválido.',
            'file' => 'O campo :attribute deve ser um arquivo válido.',
            'image' => 'O campo :attribute deve ser uma imagem.',
            'mimes' => 'O campo :attribute deve ser um arquivo do tipo: :values.',
            'data.Foto.required' => 'A foto é obrigatória.',
            'data.Cpf.cpf' => 'O CPF deve estar no formato válido.',
        ];
    }

    public function submit()
    {
        $this->cleanEmptyIntegerFields();

        $this->validate();

        $this->setEmptyStringsToNull($this->data);

        if ($this->data['Foto']) {
            $this->data['Foto'] = $this->data['Foto']->store('fotos', 'public');
        }

        if (!empty($this->data['Certidao_Casamento'])) {
            $this->data['Certidao_Casamento'] = $this->data['Certidao_Casamento']->store('documentos', 'public');
        }

        Candidato::create($this->data);

        $this->success = true;
    }

    protected function cleanEmptyIntegerFields()
    {
        $integerFields = [
            'Naturalidade_Conj_ID',
            'Naturalidade_F1_ID',
            'Naturalidade_F2_ID',
            'Naturalidade_F3_ID',
            'Naturalidade_F4_ID',
            'Naturalidade_F5_ID',
            'Profissao_Conj_ID'
        ];

        foreach ($integerFields as $field) {
            if (isset($this->data[$field]) && $this->data[$field] === '') {
                $this->data[$field] = null;
            }
        }
    }

    protected function setEmptyStringsToNull(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            if ($value === '') {
                $attributes[$key] = null;
            }
        }
        return $attributes;
    }
}
