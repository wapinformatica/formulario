<?php

namespace App\Http\Livewire;

use App\Models\Candidato;
use App\Models\CandidatoPerguntaQuestionario;
use App\Models\CandidatoRespostaQuestionario;
use App\Models\Cidade;
use App\Models\DepartRespSocial;
use App\Models\DepartRespSocialCandidato;
use App\Models\EstadoCivil;
use Livewire\Component;
use App\Models\ProcedenciaReligiosa;
use App\Models\Profissao;
use App\Models\SociedadeInterna;
use App\Models\SociedadeInternaCandidato;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;

class CandidateForm extends Component
{
    use WithFileUploads;
    public $form;
    public $formId;
    public $cities = [];
    public $Cidade_Origem_ID;
    public $Cidade_ID;
    public $Naturalidade_Conj_ID;
    public $Naturalidade_F1_ID;
    public $Naturalidade_F2_ID;
    public $Naturalidade_F3_ID;
    public $Naturalidade_F4_ID;
    public $Naturalidade_F5_ID;
    public $Naturalidade_ID;
    public $dataR43 = [];
    public $dataR44 = [];

    public $answers = [];
    public $success = false;
    protected $listeners = ['selectedUpdateValue'];
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
        'URL_Certidao_Casamento' => '',
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
        'Proced_Relig_ID' => NULL,
        'IPB_Membro' => '',
        'IPB_Ig_Bat' => '',
        'IPB_Data_Bat' => NULL,
        'IPB_Pr_Bat' => '',
        'IPB_Ig_Prf_Fe' => '',
        'IPB_Data_Prof_Fe' => NULL,
        'IPB_Pr_Prof_Fe' => '',
        'OIE_Data_Bat' => NULL,
        'OIE_Pr_Bat' => '',
        'Exerc_F_Ig' => '',
        'Se_Sim_Quais' => '',
        'OIE_Membro' => '',
    ];

    public $cidades = [];

    public $profissoes = [];

    public $estadoCivils = [];

    public $procedencias = [];

    public $sociedades = [];

    public $departamentos = [];

    public $perguntas = [];

    public $respostas = [];

    public function render()
    {

        $this->profissoes = Profissao::whereNotNull('Profissao_ID')->get();
        $this->estadoCivils = EstadoCivil::whereNotNull('Estado_Civil_ID')->get();
        $this->procedencias = ProcedenciaReligiosa::whereNotNull('Proced_Relig_ID')->get();
        $this->sociedades = SociedadeInterna::whereNotNull('Sociedade_Interna_ID')->get();
        $this->departamentos = DepartRespSocial::whereNotNull('Depart_Resp_Social_ID')->get();
        $this->perguntas = CandidatoPerguntaQuestionario::where('Ativo', 1)->orderBy('Ordem', 'asc')->get();
        $this->cities = Cidade::orderBy('Cidade_Nome')
            ->pluck('Cidade_Nome','Cidade_ID');
        return view('livewire.candidate-form');
    }

    public function mount()
    {
                $this->cidades = Cidade::whereNotNull('Cidade_ID')->get();
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
            'data.Cpf' => 'required|string|max:14',
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
            'data.URL_Certidao_Casamento' => 'nullable|string',
            'data.Certidao_Casamento' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'data.Foto' => 'required|file|image|max:2048',
            'data.Proced_Relig_ID' => 'required|exists:procedencia_religiosa,Proced_Relig_ID',
            'data.IPB_Membro' => 'nullable|in:Sim,Não',
            'data.IPB_Ig_Bat' => 'nullable|string|max:50',
            'data.IPB_Data_Bat' => 'nullable|date',
            'data.IPB_Pr_Bat' => 'nullable|string|max:80',
            'data.IPB_Ig_Prf_Fe' => 'nullable|string|max:50',
            'data.IPB_Data_Prof_Fe' => 'nullable|date',
            'data.OIE_Membro' => 'nullable|in:Sim,Não',
            'data.OIE_Data_Bat' => 'nullable|date',
            'data.OIE_Pr_Bat' => 'nullable|string|max:50',
            'data.Se_Sim_Quais' => 'nullable|string|max:100',
            'dataR43' => 'required',
            'dataR44' => 'required',
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
            'dataR43.required' => 'O campo Sociedades Internas & Ministérios é obrigatório.',
            'dataR44.required' => 'O campo Departamento de Responsabilidade Social é obrigatório.',
        ];
    }

    public function submit()
    {
        $this->data['Cidade_Origem_ID'] = $this->Cidade_Origem_ID;
        $this->data['Cidade_ID'] = $this->Cidade_ID;
        $this->data['Naturalidade_Conj_ID'] = $this->Naturalidade_Conj_ID;
        $this->data['Naturalidade_F1_ID'] = $this->Naturalidade_F1_ID;
        $this->data['Naturalidade_F2_ID'] = $this->Naturalidade_F2_ID;
        $this->data['Naturalidade_F3_ID'] = $this->Naturalidade_F3_ID;
        $this->data['Naturalidade_F4_ID'] = $this->Naturalidade_F4_ID;
        $this->data['Naturalidade_F5_ID'] = $this->Naturalidade_F5_ID;
        $this->data['Naturalidade_ID'] = $this->Naturalidade_ID;

        $this->cleanEmptyIntegerFields();

        $this->validate();

        $this->setEmptyStringsToNull($this->data);

        if(($this->data['Estado_Civil_ID'] == 1) OR ($this->data['Estado_Civil_ID'] == '1')){
            if(($this->data['URL_Certidao_Casamento'] == '') AND ($this->data['Certidao_Casamento'] == '') ){
                return session()->flash('danger', 'Informe a certidão de casamento!');
            }
        }

        if ($this->data['Foto']) {
            $caminhoTemporario = $this->data['Foto']->getRealPath();
            $caminhoRedimensionado = storage_path('app/livewire-tmp/redimensionada_' . $this->data['Foto']->getFilename());

            // Redimensiona usando GD
            $this->redimensionarImagemGD($caminhoTemporario, $caminhoRedimensionado);

            // Substitui o arquivo temporário pelo redimensionado
            $this->data['Foto'] = new \Illuminate\Http\UploadedFile(
                $caminhoRedimensionado,
                $this->data['Foto']->getClientOriginalName(),
                mime_content_type($caminhoRedimensionado),
                null,
                true
            );
            $this->data['Foto'] = $this->data['Foto']->store('fotos', 'public');
        }

        if (!empty($this->data['Certidao_Casamento'])) {
            $this->data['Certidao_Casamento'] = $this->data['Certidao_Casamento']->store('documentos', 'public');
        }

        try{
            DB::beginTransaction();
            $candidato = Candidato::create($this->data);

            foreach ($this->respostas as $respostaId => $resposta) {
                CandidatoRespostaQuestionario::create([
                    'Candidato_ID' => $candidato->Candidato_ID,
                    'Pergunta_ID' => $respostaId,
                    'Resposta' => $resposta,
                ]);
            }

            foreach($this->dataR43 as $value){
                SociedadeInternaCandidato::create([
                    'Sociedade_Interna_ID' => $value,
                    'Candidato_ID' => $candidato->Candidato_ID,
                ]);
            }
            foreach($this->dataR44 as $value){
                DepartRespSocialCandidato::create([
                    'Depart_Resp_Social_ID' => $value,
                    'Candidato_ID' => $candidato->Candidato_ID,
                ]);
            }
            DB::commit();
            $this->success = true;
        } catch (\Exception $ex) {
            DB::rollback();
            return session()->flash('danger', 'Houve uma falha tente novamente! ' . $ex->getMessage());
        }



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

    public function selectedUpdateValue($campo, $valor)
    {
        $this->$campo = $valor;
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

    /**
     * Redimensiona uma imagem para 448x336px usando GD (sem dependências externas).
     *
     * @param string $caminhoImagemOriginal Caminho da imagem original.
     * @param string $caminhoImagemRedimensionada Onde a nova imagem será salva.
     * @return bool True se sucesso, False se falhar.
     */
    function redimensionarImagemGD($caminhoImagemOriginal, $caminhoImagemRedimensionada) {
        // Verifica se a extensão GD está habilitada
        if (!extension_loaded('gd')) {
            throw new \Exception("A extensão GD não está ativada no PHP.");
        }

        // Obtém informações da imagem original
        list($larguraOriginal, $alturaOriginal, $tipo) = getimagesize($caminhoImagemOriginal);

        // Cria uma imagem GD a partir do arquivo original
        switch ($tipo) {
            case IMAGETYPE_JPEG:
                $imagemOriginal = imagecreatefromjpeg($caminhoImagemOriginal);
                break;
            case IMAGETYPE_PNG:
                $imagemOriginal = imagecreatefrompng($caminhoImagemOriginal);
                break;
            case IMAGETYPE_GIF:
                $imagemOriginal = imagecreatefromgif($caminhoImagemOriginal);
                break;
            default:
                throw new \Exception("Formato de imagem não suportado (use JPEG, PNG ou GIF).");
        }

        // Define o novo tamanho (448x336px)
        $larguraNova = 448;
        $alturaNova = 336;

        // Cria uma nova imagem em branco com o tamanho desejado
        $imagemRedimensionada = imagecreatetruecolor($larguraNova, $alturaNova);

        // Preserva transparência para PNG/GIF
        if ($tipo == IMAGETYPE_PNG || $tipo == IMAGETYPE_GIF) {
            imagecolortransparent($imagemRedimensionada, imagecolorallocatealpha($imagemRedimensionada, 0, 0, 0, 127));
            imagealphablending($imagemRedimensionada, false);
            imagesavealpha($imagemRedimensionada, true);
        }

        // Redimensiona a imagem original para o novo tamanho (com crop centralizado)
        $proporcaoOriginal = $larguraOriginal / $alturaOriginal;
        $proporcaoDesejada = $larguraNova / $alturaNova;

        if ($proporcaoOriginal > $proporcaoDesejada) {
            // Corta lateralmente (mantém a altura)
            $alturaTemp = $alturaOriginal;
            $larguraTemp = $alturaOriginal * $proporcaoDesejada;
            $x = ($larguraOriginal - $larguraTemp) / 2;
            $y = 0;
        } else {
            // Corta verticalmente (mantém a largura)
            $larguraTemp = $larguraOriginal;
            $alturaTemp = $larguraOriginal / $proporcaoDesejada;
            $x = 0;
            $y = ($alturaOriginal - $alturaTemp) / 2;
        }

        // Copia e redimensiona a imagem
        imagecopyresampled(
            $imagemRedimensionada,    // Imagem de destino
            $imagemOriginal,          // Imagem original
            0, 0,                     // Destino X/Y
            $x, $y,                   // Origem X/Y (crop)
            $larguraNova, $alturaNova, // Largura/Altura destino
            $larguraTemp, $alturaTemp  // Largura/Altura origem (recortada)
        );

        // Salva a imagem redimensionada
        switch ($tipo) {
            case IMAGETYPE_JPEG:
                imagejpeg($imagemRedimensionada, $caminhoImagemRedimensionada, 85); // 85% de qualidade
                break;
            case IMAGETYPE_PNG:
                imagepng($imagemRedimensionada, $caminhoImagemRedimensionada, 8); // Nível de compressão (0-9)
                break;
            case IMAGETYPE_GIF:
                imagegif($imagemRedimensionada, $caminhoImagemRedimensionada);
                break;
        }

        // Libera memória
        imagedestroy($imagemOriginal);
        imagedestroy($imagemRedimensionada);

        return true;
    }
}
