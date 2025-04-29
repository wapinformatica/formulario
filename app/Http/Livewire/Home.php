<?php

namespace App\Http\Livewire;

use App\Models\Form;
use Livewire\Component;
 
class Home extends Component
{

    public function render()
    {
        return view('livewire.home',[
            'forms' => Form::where('is_active', 1)->get()
        ]);
    }

    public function mount()
    {
 
    }
}
