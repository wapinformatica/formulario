<div>
    <!-- resources/views/livewire/public-form.blade.php -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="text-center pb-3">
                    <img class="img-thumbnail rounded-circle" style="width: 120px; height: 120px;" src="{{asset('logo.jpeg')}}" alt=""/>
                </div>
            </div>
        </div>

        @if($success)
            <div class="alert alert-success">
                <h4>Obrigado!</h4>
                <p>Seu formulário foi enviado com sucesso.</p>
            </div>
            <a href="{{route('home')}}" class="btn btn-warning">
                Voltar
            </a>
        @else
            <div class="card">
                <div class="card-header">
                    <h3>{{ $form->name }}</h3>
                    @if($form->description)
                        <p class="mb-0">{{ $form->description }}</p>
                    @endif
                </div>
                
                <div class="card-body">
                    <form wire:submit.prevent="submit">
                        @foreach($form->questions as $question)
                            <div class="form-group mb-4">
                                <label for="question_{{ $question->id }}">
                                    {{ $question->question }}
                                    @if($question->is_required)
                                        <span class="text-danger">*</span>
                                    @endif
                                </label>
                                
                                @if($question->type === 'text')
                                    <input type="text" class="form-control" 
                                        id="question_{{ $question->id }}" 
                                        wire:model="answers.{{ $question->id }}">
                                @elseif($question->type === 'textarea')
                                    <textarea class="form-control" 
                                            id="question_{{ $question->id }}" 
                                            wire:model="answers.{{ $question->id }}" 
                                            rows="3"></textarea>
                                @elseif($question->type === 'date')
                                    <input type="date" class="form-control" 
                                        id="question_{{ $question->id }}" 
                                        wire:model="answers.{{ $question->id }}">
                                @elseif($question->type === 'email')
                                    <input type="email" class="form-control" 
                                        id="question_{{ $question->id }}" 
                                        wire:model="answers.{{ $question->id }}">
                                @elseif($question->type === 'number')
                                    <input type="number" class="form-control" 
                                        id="question_{{ $question->id }}" 
                                        wire:model="answers.{{ $question->id }}">
                                @elseif(in_array($question->type, ['tel', 'phone', 'cellphone', 'cpf']))
                                    <input type="text" class="form-control" 
                                        id="question_{{ $question->id }}" 
                                        wire:model="answers.{{ $question->id }}"
                                        x-mask:dynamic="
                                            $question->type === 'cpf' ? '999.999.999-99' : 
                                            ($question->type === 'cellphone' ? '(99) 99999-9999' : '(99) 9999-9999')
                                        ">
                                @elseif($question->type === 'radio')
                                    <div>
                                        @foreach($question->options as $option)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" 
                                                    id="question_{{ $question->id }}_{{ $loop->index }}" 
                                                    wire:model="answers.{{ $question->id }}" 
                                                    value="{{ $option }}">
                                                <label class="form-check-label" for="question_{{ $question->id }}_{{ $loop->index }}">
                                                    {{ $option }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @elseif($question->type === 'checkbox')
                                    <div>
                                        @foreach($question->options as $option)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" 
                                                    id="question_{{ $question->id }}_{{ $loop->index }}" 
                                                    wire:model="answers.{{ $question->id }}" 
                                                    value="{{ $option }}">
                                                <label class="form-check-label" for="question_{{ $question->id }}_{{ $loop->index }}">
                                                    {{ $option }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @elseif($question->type === 'select')
                                    <select class="form-control" 
                                            id="question_{{ $question->id }}" 
                                            wire:model="answers.{{ $question->id }}">
                                        <option value="">Selecione...</option>
                                        @foreach($question->options as $option)
                                            <option value="{{ $option }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                @endif
                                
                                @error('answers.'.$question->id) 
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endforeach
                        
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">
                                Enviar Formulário
                            </button>
                            <a href="{{route('home')}}" class="btn btn-warning">
                                Cancelar
                            </a>
                        </div>


                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
