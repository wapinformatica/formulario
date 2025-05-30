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

                    <div class="table-responsive" style="min-height: 200px !important;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome Completo</th>
                                    <th>CPF</th>
                                    <th>Data Cadastro</th>
                                    {{-- <th>Status</th> --}}
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($responses as $response)
                                    <tr>
                                        <td>{{ $response->Candidato_ID }}</td>
                                        <td>
                                            {{ $response->Nome_Candidato }}
                                        </td>
                                        <td>{{ $response->Cpf }}</td>
                                        <td>{{date('d/m/Y', strtotime($response->Data_Cadastro))}}</td>
                                        {{-- <td>
                                            <span class="badge
                                                @if($response->status == 'approved') badge-success
                                                @elseif($response->status == 'rejected') badge-danger
                                                @else badge-secondary @endif">
                                                {{ $response->status == 'approved' ? 'Aprovado' :
                                                ($response->status == 'rejected' ? 'Rejeitado' : 'Pendente') }}
                                            </span>
                                        </td> --}}
                                        {{-- <td>
                                            <div class="btn-group" role="group">
                                                <button wire:click="viewResponse({{ $response->Candidato_ID }})"
                                                        class="btn btn-sm btn-primary mr-2">
                                                    <i class="fas fa-eye"></i> Visualizar
                                                </button>
                                                @can('registrationlist_print')
                                                    <button wire:click="generatePdf({{ $response->Candidato_ID }})"
                                                            class="btn btn-sm btn-secondary">
                                                        <i class="fas fa-print"></i> Imprimir
                                                    </button>
                                                @endcan
                                            </div>
                                        </td> --}}
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-bars"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a wire:click="viewResponse({{ $response->Candidato_ID }})" class="dropdown-item" href="#">
                                                        <i class="fas fa-eye mr-2"></i> Visualizar
                                                    </a>
                                                    @can('registrationlist_print')
                                                        <a wire:click="generatePdf({{ $response->Candidato_ID }}, true)" class="dropdown-item" href="#">
                                                            <i class="fas fa-file-alt mr-2"></i> Relátorio Completo
                                                        </a>
                                                        <a wire:click="generatePdf({{ $response->Candidato_ID }}, false)" class="dropdown-item" href="#">
                                                            <i class="fas fa-file mr-2"></i> Relátorio Parcial
                                                        </a>
                                                        <a wire:click="downloadPhoto({{ $response->Candidato_ID }})" class="dropdown-item" href="#">
                                                            <i class="far fa-image mr-2"></i> Foto Candidato
                                                        </a>
                                                        @if( ($response->Certidao_Casamento != '') OR ($response->URL_Certidao_Casamento != ''))
                                                        <a wire:click="downloadDocument({{ $response->Candidato_ID }})" class="dropdown-item" href="#">
                                                            <i class="far fa-file-alt mr-2"></i> Certidão de Casamento
                                                        </a>
                                                        @endif

                                                    @endcan
                                                </div>
                                            </div>
                                        </td>
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
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Detalhes do Cadastro #{{ $selectedResponse->Candidato_ID }}</h5>
                            <button type="button" class="close" wire:click="closeModal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                            <div class="row">
                                <!-- Dados Pessoais -->
                                <div class="col-md-12">
                                    <h4 class="mb-3">Dados Pessoais</h4>
                                </div>

                                <div class="col-md-12">
                                    <p><strong>Nome do Candidato:</strong> {{ $selectedResponse->Nome_Candidato }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Nome da Mãe:</strong> {{ $selectedResponse->Nome_Mae }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Nome do Pai:</strong> {{ $selectedResponse->Nome_Pai }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Naturalidade:</strong> {{ $selectedResponse->naturalidade->Cidade_Nome ?? '' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Cidade de Origem:</strong> {{ $selectedResponse->cidadeOrigem->Cidade_Nome ?? '' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>CPF:</strong> {{ $selectedResponse->Cpf }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>RG:</strong> {{ $selectedResponse->Rg }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Órgão Expedidor:</strong> {{ $selectedResponse->Orgao_Exp }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>E-mail:</strong> {{ $selectedResponse->e_mail }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Data de Nascimento:</strong> {{ \Carbon\Carbon::parse($selectedResponse->Data_Nascimento)->format('d/m/Y') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Sexo:</strong> {{ $selectedResponse->Sexo == 'M' ? 'Masculino' : 'Feminino' }}</p>
                                </div>

                                <div class="col-md-6">
                                    <p><strong>Profissão:</strong> {{ $selectedResponse->profissao->Profissao_Nome ?? '' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Estado Civil:</strong> {{ $selectedResponse->estadoCivil->Estado_Civil_Nome ?? '' }}</p>
                                </div>

                                <!-- Endereço -->
                                <div class="col-md-12 mt-4">
                                    <h4>Endereço</h4>
                                </div>

                                <div class="col-md-12">
                                    <p><strong>Logradouro:</strong> {{ $selectedResponse->Logradouro }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Número:</strong> {{ $selectedResponse->Numero }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Bairro:</strong> {{ $selectedResponse->Bairro }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>CEP:</strong> {{ $selectedResponse->CEP }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Cidade:</strong> {{ $selectedResponse->cidade->Cidade_Nome ?? '' }}</p>
                                </div>
                                <div class="col-md-12">
                                    <p><strong>Complemento:</strong> {{ $selectedResponse->Complemento ?? 'Não informado' }}</p>
                                </div>

                                <!-- Contato -->
                                <div class="col-md-12 mt-4">
                                    <h4>Contato</h4>
                                </div>

                                <div class="col-md-6">
                                    <p><strong>Telefone Comercial:</strong> {{ $selectedResponse->Fone_Comercial }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Telefone Celular:</strong> {{ $selectedResponse->Fone_Celular }}</p>
                                </div>

                                <!-- Dados do Cônjuge -->
                                @if($selectedResponse->Nome_Conj)
                                <div class="col-md-12 mt-4">
                                    <h4>Dados do Cônjuge</h4>
                                </div>

                                <div class="col-md-6">
                                    <p><strong>Nome do Cônjuge:</strong> {{ $selectedResponse->Nome_Conj }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Data de Nascimento:</strong> {{ $selectedResponse->Data_Nasc_Conj ? \Carbon\Carbon::parse($selectedResponse->Data_Nasc_Conj)->format('d/m/Y') : 'Não informado' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Naturalidade:</strong> {{ $selectedResponse->naturalidadeConjuge->Cidade_Nome ?? 'Não informado' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Profissão:</strong> {{ $selectedResponse->profissaoConjuge->Profissao_Nome ?? 'Não informado' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Data de Casamento:</strong> {{ $selectedResponse->Data_Casamento ? \Carbon\Carbon::parse($selectedResponse->Data_Casamento)->format('d/m/Y') : 'Não informado' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Frequenta a IPC:</strong> {{ $selectedResponse->R4 ?? 'Não informado' }}</p>
                                </div>
                                @endif

                                <!-- Filhos -->
                                @for($i = 1; $i <= 5; $i++)
                                    @php $field = 'Nome_F'.$i; @endphp
                                    @if($selectedResponse->$field)
                                    <div class="col-md-12 mt-4">
                                        <h4>Dados do {{ $i }}º Filho</h4>
                                    </div>

                                    <div class="col-md-6">
                                        <p><strong>Nome:</strong> {{ $selectedResponse->$field }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        @php $dataField = 'Data_Nasc_F'.$i; @endphp
                                        <p><strong>Data de Nascimento:</strong> {{ $selectedResponse->$dataField ? \Carbon\Carbon::parse($selectedResponse->$dataField)->format('d/m/Y') : 'Não informado' }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        @php $naturalidadeField = 'Naturalidade_F'.$i.'_ID'; @endphp
                                        <p><strong>Naturalidade:</strong> {{ $selectedResponse->{'naturalidadeF'.$i}->Cidade_Nome ?? 'Não informado' }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        @php $batizadoField = 'P_'.$i.'1'; @endphp
                                        <p><strong>Já foi batizado:</strong> {{ $selectedResponse->$batizadoField ?? 'Não informado' }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        @php $batizadoJuntoField = 'P_'.$i.'2'; @endphp
                                        <p><strong>Será batizado junto:</strong> {{ $selectedResponse->$batizadoJuntoField ?? 'Não informado' }}</p>
                                    </div>
                                    @endif
                                @endfor

                                <!-- Documentos -->
                                <div class="col-md-12 mt-4">
                                    <h4>Documentos</h4>
                                </div>

                                <div class="col-md-6">
                                    <p><strong>Certidão de Casamento:</strong> {{ $selectedResponse->Certidao_Casamento ? 'Enviado' : 'Não enviado' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Foto:</strong> {{ $selectedResponse->Foto ? 'Enviada' : 'Não enviada' }}</p>
                                </div>
                            </div>

                            <hr>

                            <div class="col-md-12 mt-4">
                                <h4>Respostas</h4>
                            </div>

                            <div class="col-md-12 mt-4">

                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Pergunta</th>
                                                <th>Resposta</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td width="40%">Se casado(a), seu cônjuge frequenta a Igreja (IPC) com você?</td>
                                                <td>{{ $selectedResponse->R1 ?? 'Não informado' }}</td>
                                            <tr>
                                                <td width="40%">Há quanto tempo frequenta a IPC?</td>
                                                <td>{{ $selectedResponse->R2 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Se tem filhos, quantos são menores de idade e moram com você?</td>
                                                <td>{{ $selectedResponse->R3 ?? 'Nenhum' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Estes filhos Menores de idade serão recebidos na IPC com você?</td>
                                                <td>{{ $selectedResponse->R4 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Última Procedência Religiosa (Denominação):</td>
                                                <td>{{ $selectedResponse->procedencia->Proced_Relig_Nome ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Em caso da IPB, chegou a ser membro?</td>
                                                <td>{{ $selectedResponse->R6 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Em caso da IPB, qual o Nome da Igreja do Batismo?</td>
                                                <td>{{ $selectedResponse->R7 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Em caso da IPB, qual a data do Batismo?</td>
                                                <td>{{ $selectedResponse->R8 ? date('d/m/Y', strtotime($selectedResponse->R8)) : 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Em caso da IPB, qual o Nome do Pastor Oficiante do Batismo?</td>
                                                <td>{{ $selectedResponse->R9 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Em caso da IPB, qual o Nome da Igreja da Profissão da Fé?</td>
                                                <td>{{ $selectedResponse->R10 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Em caso da IPB, qual a data da Profissão de Fé?</td>
                                                <td>{{ $selectedResponse->R11 ? date('d/m/Y', strtotime($selectedResponse->R11)) : 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Em caso da IPB, qual o Nome do Pastor Oficiante da Profissão de Fé?</td>
                                                <td>{{ $selectedResponse->R12 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Você já está frequentando a Escola Bíblica aos Domingos?</td>
                                                <td>{{ $selectedResponse->R13 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Caso afirmativo, está matriculado em qual classe?</td>
                                                <td>{{ $selectedResponse->R14 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Você já está frequentando algum Grupo Familiar, Ministério ou Sociedade Interna?</td>
                                                <td>{{ $selectedResponse->R15 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Se Sim, especifique:</td>
                                                <td>{{ $selectedResponse->R16 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Em caso de outra Igreja Evangélica, chegou a ser membro?</td>
                                                <td>{{ $selectedResponse->R17 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Em caso de Outra Igreja Evangélica, qual a data do Batismo?</td>
                                                <td>{{ $selectedResponse->R18 ? date('d/m/Y', strtotime($selectedResponse->R18)) : 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Em caso de Outra Igreja Evangélica, qual o Nome do Pastor Oficiante do Batismo?</td>
                                                <td>{{ $selectedResponse->R19 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Exerceu alguma função na igreja?</td>
                                                <td>{{ $selectedResponse->R20 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Se exerceu alguma Função ou Cargo na Igreja, cite as que mais te agradou:</td>
                                                <td>{{ $selectedResponse->R21 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Por qual(ais) razão(ões) deixou ou deseja transferir-se da sua ex-Igreja?</td>
                                                <td>{{ $selectedResponse->R22 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Como você conheceu a Igreja Presbiteriana de Cuiabá (IPC)?</td>
                                                <td>{{ $selectedResponse->R23 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Você sofre alguma perseguição, rejeição ou resistência, especialmente em sua família, pelo fato de ser crente?</td>
                                                <td>{{ $selectedResponse->R24 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Você sofre alguma perseguição, rejeição ou resistência, especialmente em sua família, por ser membro da Igreja Presbiteriana?</td>
                                                <td>{{ $selectedResponse->R25 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Em caso afirmativo, como tem sido a sua postura?</td>
                                                <td>{{ $selectedResponse->R26 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Você tem (ou já teve) algum vício (hábito)? Por exemplo: fumo, álcool, jogos de azar, baralho, loterias, sinuca, etc.</td>
                                                <td>{{ $selectedResponse->R27 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Em caso de resposta afirmativa, chegou a ser dependente?</td>
                                                <td>{{ $selectedResponse->R28 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Você tem problemas com dívidas financeiras?</td>
                                                <td>{{ $selectedResponse->R29 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Como você tem administrado essa área da sua vida?</td>
                                                <td>{{ $selectedResponse->R30 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Você já frequentou: espiritismo kardecista, centro de mesa branca, terreiro de umbanda, candomblé, quimbanda (magia negra), alguma fraternidade gnóstica (Rosacruz, Logosofia, Seitas metafísicas), seita esotérica ou práticas esotéricas (místicas) tais como: tarô, baralho cigano, búzios (cartomancia em geral), horóscopo, Xamanismo e Santo daime, etc?</td>
                                                <td>{{ $selectedResponse->R31 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Em caso de resposta afirmativa qual (ais)? Por quanto tempo? Qual foi o seu "grau" de envolvimento? Fez algum pacto?</td>
                                                <td>{{ $selectedResponse->R32 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Você já frequentou ou frequenta a Maçonaria?</td>
                                                <td>{{ $selectedResponse->R33 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Caso esteja frequentando ou já tenha frequentado a maçonaria, qual o seu "grau" de envolvimento?</td>
                                                <td>{{ $selectedResponse->R34 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Caso ainda esteja frequentando a maçonaria, você pretende deixá-la (renunciá-la) para se tornar membro da IPC?</td>
                                                <td>{{ $selectedResponse->R35 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Por que você pretende se tornar membro da IPC?</td>
                                                <td>{{ $selectedResponse->R36 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">O quanto você conhece da história, do sistema de doutrina e governo da Igreja Presbiteriana do Brasil?</td>
                                                <td>{{ $selectedResponse->R37 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Você tem dúvidas ou resistência sobre o sistema de governo ou alguma doutrina específica da Igreja Presbiteriana do Brasil?</td>
                                                <td>{{ $selectedResponse->R38 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Em caso afirmativo, qual (ais) são as suas dúvidas e/ou resistências?</td>
                                                <td>{{ $selectedResponse->R39 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Você está disposto(a), receptivo(a), para receber ensinamentos visando sanar as suas dúvidas e desfazer as suas resistências?</td>
                                                <td>{{ $selectedResponse->R40 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">A IPC entende que a prática do dízimo e da oferta, faz parte da devoção cristã, é atual e é a maneira do cristão demonstrar a sua fidelidade a Deus e generosidade, ao mesmo tempo que sustenta a Igreja e a sua obra. Você concorda com a prática de dizimar e ofertar?</td>
                                                <td>{{ $selectedResponse->R41 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">Qual a sua situação hoje?</td>
                                                <td>{{ $selectedResponse->R42 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">I - Sociedades Internas & Ministérios</td>
                                                <td>{{ $selectedResponse->R43 ?? 'Não informado' }}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%">II - Departamento de Responsabilidade Social</td>
                                                <td>{{ $selectedResponse->R44 ?? 'Não informado' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <hr>

                            {{-- <h5>Aprovação/Rejeição</h5> --}}
                            <form wire:submit.prevent="updateApproval">
                                {{-- <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" wire:model="approvalStatus">
                                        <option value="pending">Pendente</option>
                                        <option value="approved">Aprovar</option>
                                        <option value="rejected">Rejeitar</option>
                                    </select>
                                </div> --}}

                                <div class="form-group text-right">
                                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Fechar</button>
                                    {{-- @if($selectedResponse->processed_at)
                                        @can('registrationlist_change')
                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                        @endcan
                                    @else
                                        @can('registrationlist_approval')
                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                        @endcan
                                    @endif --}}
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
