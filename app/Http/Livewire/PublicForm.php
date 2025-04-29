<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Form;
use App\Models\FormResponse;
use App\Models\FormResponseAnswer;

class PublicForm extends Component
{
    public $form;
    public $formId;
    public $answers = [];
    public $success = false;

    public function render()
    {
        return view('livewire.public-form');
    }

    public function mount()
    {
        $formId = $this->formId;
        $this->form = Form::with('questions')->findOrFail($formId);
        
        foreach ($this->form->questions as $question) {
            if ($question->type === 'checkbox') {
                $this->answers[$question->id] = [];
            } else {
                $this->answers[$question->id] = '';
            }
        }
    }

    protected function rules()
    {
        $rules = [];
        
        foreach ($this->form->questions as $question) {
            $rule = [];
            
            if ($question->is_required) {
                $rule[] = 'required';
                
                if ($question->type === 'checkbox') {
                    $rule[] = 'array|min:1';
                }
            } else {
                $rule[] = 'nullable';
            }
            
            // Add specific validation based on field type
            switch ($question->type) {
                case 'email':
                    $rule[] = 'email';
                    break;
                case 'number':
                    $rule[] = 'numeric';
                    break;
                case 'date':
                    $rule[] = 'date';
                    break;
                case 'cpf':
                    $rule[] = 'cpf';
                    break;
                case 'phone':
                    $rule[] = 'phone';
                    break;
                case 'cellphone':
                    $rule[] = 'cellphone';
                    break;
            }
            
            $rules['answers.'.$question->id] = implode('|', $rule);
        }
        
        return $rules;
    }

    public function submit()
    {
        $this->validate();
        
        // Create response
        $response = FormResponse::create([
            'form_id' => $this->form->id,
        ]);
        
        // Save answers
        foreach ($this->answers as $questionId => $answer) {
            if (is_array($answer)) {
                foreach ($answer as $value) {
                    FormResponseAnswer::create([
                        'response_id' => $response->id,
                        'question_id' => $questionId,
                        'answer' => $value,
                    ]);
                }
            } else {
                FormResponseAnswer::create([
                    'response_id' => $response->id,
                    'question_id' => $questionId,
                    'answer' => $answer,
                ]);
            }
        }
        
        $this->success = true;
    }
   
}
