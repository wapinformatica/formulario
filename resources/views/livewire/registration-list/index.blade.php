<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1 class="m-0">{{$title}}</h1> --}}
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">{{$pages}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
 
    <!-- resources/views/livewire/form-submissions-list.blade.php -->
    <div>
        <div class="container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Lista de Cadastro</h4>
                    <div>
                        <input type="text" class="form-control" placeholder="Buscar..." wire:model.debounce.500ms="search">
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <select class="form-control" wire:model="statusFilter">
                                @foreach($statusOptions as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome Completo</th>
                                    <th>Formulário</th>
                                    <th>Data</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($responses as $response)
                                    <tr>
                                        <td>{{ $response->id }}</td>
                                        <td>
                                            {{ $response->answers->firstWhere('question.question', 'Nome Completo')->answer ?? 'N/A' }}
                                        </td>
                                        <td>{{ $response->form->name }}</td>
                                        <td>{{ $response->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($response->status == 'approved') badge-success
                                                @elseif($response->status == 'rejected') badge-danger
                                                @else badge-secondary @endif">
                                                {{ $response->status == 'approved' ? 'Aprovado' : 
                                                ($response->status == 'rejected' ? 'Rejeitado' : 'Pendente') }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button wire:click="viewResponse({{ $response->id }})" 
                                                        class="btn btn-sm btn-primary mr-2">
                                                    <i class="fas fa-eye"></i> Visualizar
                                                </button>
                                                @can('registrationlist_print')
                                                    <button wire:click="generatePdf({{ $response->id }})" 
                                                            class="btn btn-sm btn-secondary">
                                                        <i class="fas fa-print"></i> Imprimir
                                                    </button>                                                   
                                                @endcan
                                            </div>
                                        </td>
                                        {{-- <td>
                                            <div class="btn-group" role="group">
                                                <button wire:click="viewResponse({{ $response->id }})" 
                                                        class="btn btn-sm btn-primary">
                                                    <i class="fas fa-eye"></i> Visualizar
                                                </button>
                                                <button wire:click.prevent="generatePdf({{ $response->id }})" 
                                                        onclick="window.open('', '_blank')"
                                                        class="btn btn-sm btn-secondary"
                                                        id="pdf-btn-{{ $response->id }}">
                                                    <i class="fas fa-print"></i> Imprimir
                                                </button>
                                            </div>
                                        </td> --}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Nenhum cadastro encontrado</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-3">
                        {{ $responses->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Visualização -->
        @if($selectedResponse)
            <div class="modal fade show" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Detalhes do Cadastro #{{ $selectedResponse->id }}</h5>
                            <button type="button" class="close" wire:click="closeModal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <p><strong>Formulário:</strong> {{ $selectedResponse->form->name }}</p>
                                    <p><strong>Data de Envio:</strong> {{ $selectedResponse->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Status:</strong> 
                                        <span class="badge 
                                            @if($selectedResponse->status == 'approved') badge-success
                                            @elseif($selectedResponse->status == 'rejected') badge-danger
                                            @else badge-secondary @endif">
                                            {{ $selectedResponse->status == 'approved' ? 'Aprovado' : 
                                            ($selectedResponse->status == 'rejected' ? 'Rejeitado' : 'Pendente') }}
                                        </span>
                                    </p>
                                    @if($selectedResponse->processed_at)
                                        <p><strong>Processado em:</strong> {{  date('d/m/Y H:i', strtotime($selectedResponse->processed_at)) }}</p>
                                        <p><strong>Por:</strong> {{ $selectedResponse->processor->name ?? 'N/A' }}</p>
                                    @endif
                                </div>
                            </div>
                            
                            <hr>
                            
                            <h5>Respostas</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Pergunta</th>
                                            <th>Resposta</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($selectedResponse->answers as $answer)
                                            <tr>
                                                <td width="40%">{{ $answer->question->question }}</td>
                                                <td>
                                                    @if(is_array(json_decode($answer->answer)))
                                                        <ul>
                                                            @foreach(json_decode($answer->answer) as $item)
                                                                <li>{{ $item }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        {{ $answer->answer }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <hr>
                            
                            <h5>Aprovação/Rejeição</h5>
                            <form wire:submit.prevent="updateApproval">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" wire:model="approvalStatus">
                                        <option value="pending">Pendente</option>
                                        <option value="approved">Aprovar</option>
                                        <option value="rejected">Rejeitar</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Observações</label>
                                    <textarea class="form-control" wire:model="approvalNotes" rows="3"></textarea>
                                </div>
                                
                                <div class="form-group text-right">
                                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Fechar</button>
                                    @if($selectedResponse->processed_at)
                                        @can('registrationlist_change')
                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                        @endcan
                                    @else
                                        @can('registrationlist_approval')
                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                        @endcan
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('openPdf', (data) => {
                // Abre o PDF em uma nova aba
                window.open(data.pdf_url, '_blank');
                
                // Opcional: limpar o arquivo temporário após algum tempo
                setTimeout(() => {
                    fetch(data.pdf_url)
                        .then(() => {
                            // O arquivo foi aberto com sucesso
                            // Podemos adicionar lógica para deletar depois se necessário
                        });
                }, 10000);
            });
        });
    </script>
    @endpush

</div>
