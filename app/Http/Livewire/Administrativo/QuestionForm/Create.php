<?php

namespace App\Http\Livewire\Administrativo\QuestionForm;

use App\Models\Column;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Form;
use App\Models\FormQuestion;


class Create extends Component
{
    public $title = 'Cadastro de Perguntas';
    public $pages = 'Formulário';

    public $formId = null;
    public $name;
    public $description;
    public $initials;
    public $is_active = true;

    public $columns = [];

    public $questions = [];
    public $newQuestion = [
        'question' => '',
        'type' => 'text',
        'column_id' => null,
        'is_required' => false,
        'options' => [],
        'new_option' => ''
    ];

    protected $rules = [
        'name' => 'required|min:3',
        'initials' => 'required|min:3',
        'description' => 'nullable|string',
        'questions.*.question' => 'required|min:3',
        'questions.*.column_id' => 'nullable|integer',
        'questions.*.type' => 'required|in:text,textarea,date,radio,checkbox,select,email,tel,number,cpf,phone,cellphone',
        'questions.*.is_required' => 'boolean',
    ];

    public function render()
    {
        return view('livewire.administrativo.question-form.create');
    }

    public function mount($formId = null)
    {
        $this->columns = Column::where('status', 1)->get();
        if ($formId) {
            // Modo edição - carrega formulário existente
            $form = Form::findOrFail($formId);
            $this->formId = $form->id;
            $this->name = $form->name;
            $this->description = $form->description;
            $this->initials = $form->initials;
            $this->is_active = $form->is_active;

            // Carrega perguntas existentes
            foreach ($form->questions()->orderBy('order')->get() as $question) {
                $this->questions[] = $this->formatQuestion($question);
            }
        } else {
            // Modo criação - inicializa com campo padrão
            $this->initializeDefaultQuestion();
        }
    }

    public function addQuestion()
    {
        $this->validate([
            'newQuestion.question' => 'required|min:3',
            'newQuestion.column_id' => 'nullable',
            'newQuestion.type' => 'required|in:text,textarea,date,radio,checkbox,select,email,tel,number,cpf,phone,cellphone',
        ]);

        $this->questions[] = [
            'question' => $this->newQuestion['question'],
            'column_id' => $this->newQuestion['column_id'],
            'type' => $this->newQuestion['type'],
            'is_required' => $this->newQuestion['is_required'],
            'options' => $this->newQuestion['type'] === 'radio' || $this->newQuestion['type'] === 'checkbox' || $this->newQuestion['type'] === 'select'
                ? $this->newQuestion['options']
                : [],
        ];

        $this->reset('newQuestion');
    }

    protected function initializeDefaultQuestion()
    {
        // Adiciona o campo "Nome Completo" por padrão
        $this->questions = [
            [
                'question' => 'Nome Completo',
                'type' => 'text',
                'is_required' => true,
                'options' => [],
                'column_id' => Column::where('name_table', 'pessoas')->where('name_column', 'Nome')->first()->id ?? null,
                'is_locked' => true
            ],
        ];
    }

    protected function formatQuestion($question)
    {
        return [
            'id' => $question->id,
            'question' => $question->question,
            'column_id' => $question->column_id ?? null,
            'type' => $question->type,
            'is_required' => $question->is_required,
            'options' => $question->options ?? [],
            'is_locked' => $question->is_locked ?? false
        ];
    }

    public function addOption($questionIndex)
    {
        if (!empty($this->questions[$questionIndex]['new_option'])) {
            $this->questions[$questionIndex]['options'][] = $this->questions[$questionIndex]['new_option'];
            $this->questions[$questionIndex]['new_option'] = '';
        }
    }

    public function removeOption($questionIndex, $optionIndex)
    {
        unset($this->questions[$questionIndex]['options'][$optionIndex]);
        $this->questions[$questionIndex]['options'] = array_values($this->questions[$questionIndex]['options']);
    }

    public function removeQuestion($index)
    {
        // Impede remoção do campo padrão
        if ($this->questions[$index]['is_locked'] ?? false) {
            return;
        }

        unset($this->questions[$index]);
        $this->questions = array_values($this->questions);
    }

    protected function ensureDefaultQuestionExists($form)
    {
        $defaultQuestion = $form->questions()
            ->where('is_locked', true)
            ->where('question', 'Nome Completo')
            ->first();

        if (!$defaultQuestion) {
            $form->questions()->create([
                'question' => 'Nome Completo',
                'type' => 'text',
                'is_required' => true,
                'is_locked' => true,
                'column_id' => Column::where('name_table', 'candidatos')->where('name_column', 'Nome')->first()->id ?? null,
                'order' => 0
            ]);
        }
    }

    public function save()
    {
        $this->validate();

        // Cria ou atualiza o formulário apenas ao salvar
        $formData = [
            'name' => $this->name,
            'description' => $this->description,
            'initials' => $this->initials,
            'is_active' => $this->is_active
        ];

        if ($this->formId) {
            // Atualiza formulário existente
            $form = Form::find($this->formId);
            $form->update($formData);
        } else {
            // Cria novo formulário apenas ao salvar
            $form = Form::create($formData);
            $this->formId = $form->id;
        }

        // Sincroniza perguntas
        $this->syncQuestions($form);

        session()->flash('message', [
            'type' => 'success',
            'title' => 'Sucesso',
            'text' => 'Formulário salvo com sucesso!'
       ]);
       return redirect()->route('pages.question');

    }

    protected function syncQuestions($form)
    {
        $existingQuestionIds = collect($this->questions)
            ->pluck('id')
            ->filter()
            ->toArray();

        // Remove perguntas não presentes
        FormQuestion::where('form_id', $form->id)
            ->whereNotIn('id', $existingQuestionIds)
            ->delete();

        // Atualiza/Cria perguntas
        foreach ($this->questions as $index => $questionData) {
            $questionData['form_id'] = $form->id;
            $questionData['order'] = $index;

            if (isset($questionData['id'])) {
                FormQuestion::find($questionData['id'])->update($questionData);
            } else {
                FormQuestion::create($questionData);
            }
        }
    }



}
