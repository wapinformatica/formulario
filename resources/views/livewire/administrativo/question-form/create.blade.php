<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{$title}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pages.question') }}">Voltar</a></li>
                        <li class="breadcrumb-item active">{{$pages}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>{{ $formId ? 'Editar' : 'Criar' }} Formulário</h3>
            </div>
            <div class="card-body">
                @if(session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                
                <form wire:submit.prevent="save">
                    <div class="form-group">
                        <label for="name">Nome do Formulário</label>
                        <input type="text" class="form-control" id="name" wire:model="name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <textarea class="form-control" id="description" wire:model="description" rows="2"></textarea>
                    </div>
                    
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" wire:model="is_active">
                        <label class="form-check-label" for="is_active">Formulário ativo</label>
                    </div>
                    
                    <hr>
                    
                    <h4>Perguntas</h4>
                    
                    <div class="mb-3">
                        @foreach($questions as $index => $question)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5>Pergunta #{{ $index + 1 }}</h5>
                                        @if($question['is_locked'] ?? false)
                                            <span class="badge badge-info">Campo Obrigatório</span>
                                        @else
                                            <button type="button" class="btn btn-sm btn-danger" 
                                                    wire:click="removeQuestion({{ $index }})">
                                                <i class="fas fa-trash"></i> Remover
                                            </button>
                                        @endif
                                    </div>
                                    
                                    @if($question['is_locked'] ?? false)
                                        <input type="hidden" wire:model="questions.{{ $index }}.question">
                                        <input type="hidden" wire:model="questions.{{ $index }}.type" value="text">
                                        <input type="hidden" wire:model="questions.{{ $index }}.is_required" value="1">
                                        <input type="hidden" wire:model="questions.{{ $index }}.is_locked" value="1">
                                    @endif
                                    
                                    <div class="form-group">
                                        <label>Pergunta</label>
                                        <input type="text" class="form-control" 
                                               wire:model="questions.{{ $index }}.question"
                                               @if($question['is_locked'] ?? false) readonly @endif>
                                        @error('questions.'.$index.'.question') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    @if(!($question['is_locked'] ?? false))
                                        <div class="form-group">
                                            <label>Tipo de Resposta</label>
                                            <select class="form-control" wire:model="questions.{{ $index }}.type">
                                                <option value="text">Texto</option>
                                                <option value="textarea">Texto Longo</option>
                                                <option value="date">Data</option>
                                                <option value="email">E-mail</option>
                                                <option value="number">Número</option>
                                                <option value="tel">Telefone</option>
                                                <option value="phone">Telefone Fixo</option>
                                                <option value="cellphone">Celular</option>
                                                <option value="cpf">CPF</option>
                                                <option value="radio">Opção Única (Radio)</option>
                                                <option value="checkbox">Múltipla Escolha (Checkbox)</option>
                                                <option value="select">Seleção (Dropdown)</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" 
                                                   id="required_{{ $index }}" 
                                                   wire:model="questions.{{ $index }}.is_required">
                                            <label class="form-check-label" for="required_{{ $index }}">Obrigatório</label>
                                        </div>
                                    @endif
                                    
                                    @if(in_array($questions[$index]['type'], ['radio', 'checkbox', 'select']))
                                        <div class="form-group">
                                            <label>Opções</label>
                                            @foreach($question['options'] as $optIndex => $option)
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" 
                                                           value="{{ $option }}" readonly>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-danger" type="button" 
                                                                wire:click="removeOption({{ $index }}, {{ $optIndex }})">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            
                                            <div class="input-group">
                                                <input type="text" class="form-control" 
                                                       wire:model="questions.{{ $index }}.new_option" 
                                                       placeholder="Nova opção">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-primary" type="button" 
                                                            wire:click="addOption({{ $index }})">
                                                        <i class="fas fa-plus"></i> Adicionar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5>Adicionar Nova Pergunta</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Pergunta</label>
                                <input type="text" class="form-control" wire:model="newQuestion.question">
                                @error('newQuestion.question') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="form-group">
                                <label>Tipo de Resposta</label>
                                <select class="form-control" wire:model="newQuestion.type">
                                    <option value="text">Texto</option>
                                    <option value="textarea">Texto Longo</option>
                                    <option value="date">Data</option>
                                    <option value="email">E-mail</option>
                                    <option value="number">Número</option>
                                    <option value="tel">Telefone</option>
                                    <option value="phone">Telefone Fixo</option>
                                    <option value="cellphone">Celular</option>
                                    <option value="cpf">CPF</option>
                                    <option value="radio">Opção Única (Radio)</option>
                                    <option value="checkbox">Múltipla Escolha (Checkbox)</option>
                                    <option value="select">Seleção (Dropdown)</option>
                                </select>
                            </div>
                            
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" 
                                       id="new_required" wire:model="newQuestion.is_required">
                                <label class="form-check-label" for="new_required">Obrigatório</label>
                            </div>
                            
                            @if(in_array($newQuestion['type'], ['radio', 'checkbox', 'select']))
                                <div class="form-group">
                                    <label>Opções</label>
                                    @foreach($newQuestion['options'] as $optIndex => $option)
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" 
                                                   value="{{ $option }}" readonly>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-danger" type="button" 
                                                        wire:click="removeOption('newQuestion', {{ $optIndex }})">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                    <div class="input-group">
                                        <input type="text" class="form-control" 
                                               wire:model="newQuestion.new_option" 
                                               placeholder="Nova opção">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary" type="button" 
                                                    wire:click="addOption('newQuestion')">
                                                <i class="fas fa-plus"></i> Adicionar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            <button type="button" class="btn btn-primary mt-2" wire:click="addQuestion">
                                <i class="fas fa-plus-circle"></i> Adicionar Pergunta
                            </button>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        @can('questionforms_incluir')
                            <button type="submit" class="btn btn-success">
                                Salvar Formulário
                            </button>                            
                        @endcan
                        <a href="{{ route('pages.question') }}" class="btn btn-secondary">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    @push('styles')
    <style>
        .badge-info {
            background-color: #17a2b8;
            color: white;
        }
        .card-header h5 {
            margin-bottom: 0;
        }
        .input-group-append .btn {
            padding: 0.375rem 0.75rem;
        }
    </style>
    @endpush

</div>
