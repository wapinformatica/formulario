<div>

    <style>
        .select2-container {
            width: 100% !important;
            min-height: 38px !important;
        }
        .select2-selection {
            min-height: 38px !important;
            height: 38px !important;
        }
    </style>

    <div class="container" x-data>
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="text-center pb-3">
                    {{-- <img class="img-thumbnail rounded-circle" style="width: 120px; height: 120px;" src="{{asset('logo.jpeg')}}" alt=""/> --}}
                    <img class="img-thumbnail" style="max-width: 300px; max-height: 300px; height: auto;" src="{{asset('logo.jpeg')}}" alt=""/>
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
                    <h3>Cadastro de Candidatos</h3>
                    <p class="mb-0">Cadastro de candidatos para futuros membros da igreja</p>
                </div>

                <div class="card-body">
                    <form wire:submit.prevent="submit">
                        <div class="row">
                            @include('includes._alerts')

                            @if ($errors->any())
                                <div class="col-lg-12">
                                    <div class="alert alert-danger">
                                        <strong>Erros encontrados:</strong>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Escolha a Igreja da qual deseja ser membro: </label>
                                    <select wire:model.defer="data.Igreja_ID" class="form-control" required>
                                        <option value="">Selecione...</option>
                                        @foreach ( $igrejas as $igreja )
                                            <option value="{{ $igreja->Igreja_ID }}"> {{ $igreja->Igreja_Nome }}</option>
                                        @endforeach
                                    </select>
                                    @error("data.P_41")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="Nome_Candidato" class="form-label">Nome do Candidato <span class="text-danger">*</span></label>
                                    <input wire:model.defer="data.Nome_Candidato" class="form-control" type="text" placeholder="" maxlength="50" required autofocus autocomplete="off">
                                    @error("data.Nome_Candidato")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="Nome_Mae" class="form-label">Nome da Mãe <span class="text-danger">*</span></label>
                                    <input wire:model.defer="data.Nome_Mae" class="form-control" type="text" placeholder="" maxlength="50" required autofocus autocomplete="off">
                                    @error("data.Nome_Mae")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="Nome_Pai" class="form-label">Nome do Pai </label>
                                    <input wire:model.defer="data.Nome_Pai" class="form-control" type="text" placeholder="" maxlength="50" autofocus autocomplete="off">
                                    @error("data.Nome_Pai")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Naturalidade <span class="text-danger">*</span></label>
                                    <div wire:ignore>
                                        <select data-pharaonic="select2" data-placeholder="Informe o nome" data-component-id="#1" wire:model="Naturalidade_ID">
                                            <option value=""></option>
                                            @foreach ($cidades as $cidade)
                                                <option value="{{$cidade->Cidade_ID}}">{{$cidade->Cidade_Nome}} / {{$cidade->UF}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error("data.Naturalidade_ID")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Cidade de Origem <span class="text-danger">*</span></label>
                                    <div wire:ignore>
                                        <select data-pharaonic="select2" data-placeholder="Informe o nome" data-component-id="#8" wire:model="Cidade_Origem_ID">
                                            <option value=""></option>
                                            @foreach ($cidades as $cidade)
                                                <option value="{{$cidade->Cidade_ID}}">{{$cidade->Cidade_Nome}} / {{$cidade->UF}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error("data.Cidade_Origem_ID")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Cpf" class="form-label">CPF <span class="text-danger">*</span></label>
                                    <input wire:model.defer="data.Cpf" x-mask='999.999.999-99' class="form-control" type="text" placeholder="" required autofocus autocomplete="off">
                                    @error("data.Cpf")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Rg" class="form-label">RG <span class="text-danger">*</span></label>
                                    <input wire:model.defer="data.Rg" class="form-control" type="text" placeholder="" maxlength="20" required autofocus autocomplete="off">
                                    @error("data.Rg")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Orgao_Exp" class="form-label">Órg Expedidor <span class="text-danger">*</span></label>
                                    <input wire:model.defer="data.Orgao_Exp" class="form-control" type="text" placeholder="" maxlength="10" required autofocus autocomplete="off">
                                    @error("data.Orgao_Exp")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="e_mail" class="form-label">E-mail <span class="text-danger">*</span></label>
                                    <input wire:model.defer="data.e_mail" class="form-control" type="email" placeholder="" maxlength="50" required autofocus autocomplete="off">
                                    @error("data.e_mail")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-10">
                                <div class="form-group">
                                    <label for="Logradouro" class="form-label">Logradouro (Av., Rua, etc) <span class="text-danger">*</span></label>
                                    <input wire:model.defer="data.Logradouro" class="form-control" type="text" placeholder="" maxlength="255" required autofocus autocomplete="off">
                                    @error("data.Logradouro")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="Numero" class="form-label">Número <span class="text-danger">*</span></label>
                                    <input wire:model.defer="data.Numero" class="form-control" type="text" placeholder="" maxlength="15" required autofocus autocomplete="off">
                                    @error("data.Numero")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="Complemento" class="form-label">Complemento </label>
                                    <input wire:model.defer="data.Complemento" class="form-control" type="text" placeholder="" maxlength="255" autofocus autocomplete="off">
                                    @error("data.Complemento")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Bairro" class="form-label">Bairro <span class="text-danger">*</span></label>
                                    <input wire:model.defer="data.Bairro" class="form-control" type="text" placeholder="" maxlength="255" required autofocus autocomplete="off">
                                    @error("data.Bairro")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="CEP" class="form-label">Cep <span class="text-danger">*</span></label>
                                    <input wire:model.defer="data.CEP" x-mask='99999-999' class="form-control" type="text" placeholder="" maxlength="9" required autofocus autocomplete="off">
                                    @error("data.CEP")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Cidade <span class="text-danger">*</span></label>
                                    <div wire:ignore>
                                        <select data-pharaonic="select2" data-placeholder="Informe o nome" data-component-id="#2" wire:model="Cidade_ID">
                                            <option value=""></option>
                                            @foreach ($cidades as $cidade)
                                                <option value="{{$cidade->Cidade_ID}}">{{$cidade->Cidade_Nome}} / {{$cidade->UF}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @error("data.Cidade_ID")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Data_Nascimento" class="form-label">Data de Nascimento <span class="text-danger">*</span></label>
                                    <input wire:model.defer="data.Data_Nascimento" class="form-control" type="date" placeholder="" required autofocus autocomplete="off">
                                    @error("data.Data_Nascimento")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Fone_Comercial" class="form-label">Telefone Comercial <span class="text-danger">*</span></label>
                                    <input wire:model.defer="data.Fone_Comercial" x-mask='99 99999-9999' class="form-control" type="text" placeholder="" maxlength="50" required autofocus autocomplete="off">
                                    @error("data.Fone_Comercial")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Fone_Celular" class="form-label">Telefone Celular <span class="text-danger">*</span></label>
                                    <input wire:model.defer="data.Fone_Celular" x-mask='99 99999-9999' class="form-control" type="text" placeholder="" maxlength="50" required autofocus autocomplete="off">
                                    @error("data.Fone_Celular")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Profissão <span class="text-danger">*</span></label>
                                    <select wire:model.defer="data.Profissao_ID" required class="form-control">
                                        <option value="">Selecione...</option>
                                        @foreach($profissoes as $profissao)
                                            <option value="{{ $profissao->Profissao_ID }}">{{ $profissao->Profissao_Nome }}</option>
                                        @endforeach
                                    </select>
                                    @error("data.Profissao_ID")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Sexo <span class="text-danger">*</span></label>
                                    <select wire:model.defer="data.Sexo" required class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Feminino</option>
                                    </select>
                                    @error("data.Sexo")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Estado Civil <span class="text-danger">*</span></label>
                                    <select wire:model="data.Estado_Civil_ID" required class="form-control">
                                        <option value="">Selecione...</option>
                                        @foreach($estadoCivils as $estadoCivil)
                                            <option value="{{ $estadoCivil->Estado_Civil_ID }}">{{ $estadoCivil->Estado_Civil_Nome }}</option>
                                        @endforeach
                                    </select>
                                    @error("data.Estado_Civil_ID")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="Nome_Conj" class="form-label">Nome do Cônjuge </label>
                                    <input wire:model.defer="data.Nome_Conj" class="form-control" type="text" placeholder="" maxlength="50" autofocus autocomplete="off">
                                    @error("data.Nome_Conj")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Data_Nasc_Conj" class="form-label">Data de Nascimento do Cônjuge </label>
                                    <input wire:model.defer="data.Data_Nasc_Conj" class="form-control" type="date" placeholder="" autofocus autocomplete="off">
                                    @error("data.Data_Nasc_Conj")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Naturalidade Cônjuge </label>
                                    <div wire:ignore>
                                        <select data-pharaonic="select2" data-placeholder="Informe o nome" data-component-id="#3" wire:model="Naturalidade_Conj_ID">
                                            <option value=""></option>
                                            @foreach ($cidades as $cidade)
                                                <option value="{{$cidade->Cidade_ID}}">{{$cidade->Cidade_Nome}} / {{$cidade->UF}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error("data.Naturalidade_Conj_ID")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Profissão Cônjuge </label>
                                    <select wire:model.defer="data.Profissao_Conj_ID" class="form-control">
                                        <option value="">Selecione...</option>
                                        @foreach($profissoes as $profissao)
                                            <option value="{{ $profissao->Profissao_ID }}">{{ $profissao->Profissao_Nome }}</option>
                                        @endforeach
                                    </select>
                                    @error("data.Profissao_Conj_ID")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="Data_Casamento" class="form-label">Data de Casamento </label>
                                    <input wire:model.defer="data.Data_Casamento" class="form-control" type="date" placeholder="" autofocus autocomplete="off">
                                    @error("data.Data_Casamento")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Se casado(a), seu cônjuge frequenta a Igreja (IPC) com você? </label>
                                    <select wire:model.defer="data.P_1" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.P_1")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Se tem filhos, quantos são Menores de idade e Moram com você? </label>
                                    <input wire:model.defer="data.P_3" class="form-control" type="text" placeholder="" maxlength="1" autofocus autocomplete="off">
                                    @error("data.P_3")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="Nome_F1" class="form-label">Nome do 1º Filho </label>
                                    <input wire:model.defer="data.Nome_F1" class="form-control" type="text" placeholder="" maxlength="50" autofocus autocomplete="off">
                                    @error("data.Nome_F1")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Este seu 1º Filho já foi batizado? </label>
                                    <select wire:model.defer="data.P_11" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.P_11")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Se ainda Não, ele será batizado junto com você? </label>
                                    <select wire:model.defer="data.P_12" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.P_12")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Data_Nasc_F1" class="form-label">Data de Nascimento do 1º Filho </label>
                                    <input wire:model.defer="data.Data_Nasc_F1" class="form-control" type="date" placeholder="" autofocus autocomplete="off">
                                    @error("data.Data_Nasc_F1")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Naturalidade do 1º Filho </label>
                                    <div wire:ignore>
                                        <select data-pharaonic="select2" data-placeholder="Informe o nome" data-component-id="#4" wire:model="Naturalidade_F1_ID">
                                            <option value=""></option>
                                            @foreach ($cidades as $cidade)
                                                <option value="{{$cidade->Cidade_ID}}">{{$cidade->Cidade_Nome}} / {{$cidade->UF}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error("data.Naturalidade_F1_ID")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="Nome_F2" class="form-label">Nome do 2º Filho </label>
                                    <input wire:model.defer="data.Nome_F2" class="form-control" type="text" placeholder="" maxlength="50" autofocus autocomplete="off">
                                    @error("data.Nome_F2")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Este seu 2º Filho já foi batizado?</label>
                                    <select wire:model.defer="data.P_21" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.P_21")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Se ainda Não, ele será batizado junto com você? </label>
                                    <select wire:model.defer="data.P_22" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.P_22")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Data_Nasc_F2" class="form-label">Data de Nascimento do 2º Filho </label>
                                    <input wire:model.defer="data.Data_Nasc_F2" class="form-control" type="date" placeholder="" autofocus autocomplete="off">
                                    @error("data.Data_Nasc_F2")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Naturalidade do 2º Filho </label>
                                    <div wire:ignore>
                                        <select data-pharaonic="select2" data-placeholder="Informe o nome" data-component-id="#5" wire:model="Naturalidade_F2_ID">
                                            <option value=""></option>
                                            @foreach ($cidades as $cidade)
                                                <option value="{{$cidade->Cidade_ID}}">{{$cidade->Cidade_Nome}} / {{$cidade->UF}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error("data.Naturalidade_F2_ID")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="Nome_F3" class="form-label">Nome do 3º Filho</label>
                                    <input wire:model.defer="data.Nome_F3" class="form-control" type="text" placeholder="" maxlength="50" autofocus autocomplete="off">
                                    @error("data.Nome_F3")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Este seu 3º Filho já foi batizado? </label>
                                    <select wire:model.defer="data.P_31" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.P_31")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Se ainda Não, ele será batizado junto com você? </label>
                                    <select wire:model.defer="data.P_32" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.P_32")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Data_Nasc_F3" class="form-label">Data de Nascimento do 3º Filho </label>
                                    <input wire:model.defer="data.Data_Nasc_F3" class="form-control" type="date" placeholder="" autofocus autocomplete="off">
                                    @error("data.Data_Nasc_F3")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Naturalidade do 3º Filho </label>
                                    <div wire:ignore>
                                        <select data-pharaonic="select2" data-placeholder="Informe o nome" data-component-id="#6" wire:model="Naturalidade_F3_ID">
                                            <option value=""></option>
                                            @foreach ($cidades as $cidade)
                                                <option value="{{$cidade->Cidade_ID}}">{{$cidade->Cidade_Nome}} / {{$cidade->UF}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error("data.Naturalidade_F3_ID")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="Nome_F4" class="form-label">Nome do 4º Filho </label>
                                    <input wire:model.defer="data.Nome_F4" class="form-control" type="text" placeholder="" maxlength="50" autofocus autocomplete="off">
                                    @error("data.Nome_F4")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Este seu 4º Filho já foi batizado? </label>
                                    <select wire:model.defer="data.P_41" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.P_41")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Se ainda Não, ele será batizado junto com você? </label>
                                    <select wire:model.defer="data.P_42" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.P_42")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Data_Nasc_F4" class="form-label">Data de Nascimento do 4º Filho </label>
                                    <input wire:model.defer="data.Data_Nasc_F4" class="form-control" type="date" placeholder="" autofocus autocomplete="off">
                                    @error("data.Data_Nasc_F4")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Naturalidade do 4º Filho </label>
                                    <div wire:ignore>
                                        <select data-pharaonic="select2" data-placeholder="Informe o nome" data-component-id="#7" wire:model="Naturalidade_F4_ID">
                                            <option value=""></option>
                                            @foreach ($cidades as $cidade)
                                                <option value="{{$cidade->Cidade_ID}}">{{$cidade->Cidade_Nome}} / {{$cidade->UF}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error("data.Naturalidade_F4_ID")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="Nome_F5" class="form-label">Nome do 5º Filho </label>
                                    <input wire:model.defer="data.Nome_F5" class="form-control" type="text" placeholder="" maxlength="50" autofocus autocomplete="off">
                                    @error("data.Nome_F5")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Este seu 5º Filho já foi batizado? </label>
                                    <select wire:model.defer="data.P_51" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.P_51")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Se ainda Não, ele será batizado junto com você? </label>
                                    <select wire:model.defer="data.P_52" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.P_52")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Data_Nasc_F5" class="form-label">Data de Nascimento do 5º Filho </label>
                                    <input wire:model.defer="data.Data_Nasc_F5" class="form-control" type="date" placeholder="" autofocus autocomplete="off">
                                    @error("data.Data_Nasc_F5")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Naturalidade do 5º Filho </label>
                                    <div wire:ignore>
                                        <select data-pharaonic="select2" data-placeholder="Informe o nome" data-component-id="#7" wire:model="Naturalidade_F5_ID">
                                            <option value=""></option>
                                            @foreach ($cidades as $cidade)
                                                <option value="{{$cidade->Cidade_ID}}">{{$cidade->Cidade_Nome}} / {{$cidade->UF}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error("data.Naturalidade_F5_ID")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Link Certidao Casamento </label>
                                    <input wire:model.defer="data.URL_Certidao_Casamento" class="form-control" type="text" placeholder="" autofocus autocomplete="off">
                                    @error("data.URL_Certidao_Casamento")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="Certidao_Casamento" class="form-label">Cópia da Certidão de Casamento</label>
                                    <input wire:model.defer="data.Certidao_Casamento" class="form-control" type="file">
                                    @error("data.Certidao_Casamento")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="Foto" class="form-label">Foto (Tirar uma Selfie) <span class="text-danger">*</span></label>
                                    <input wire:model.defer="data.Foto" class="form-control" type="file" accept="image/*" capture="user" required>
                                    @error("data.Foto")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Há quanto tempo frequenta a IPC? <span class="text-danger">*</span></label>
                                    <input wire:model.defer="data.P_2" class="form-control" type="text" placeholder="" required autofocus autocomplete="off">
                                    @error("data.P_2")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Última Procedência Religiosa (Denominação): <span class="text-danger">*</span></label>
                                    <select wire:model.defer="data.Proced_Relig_ID" required class="form-control">
                                        <option value="">Selecione...</option>
                                        @foreach($procedencias as $procedencia)
                                            <option value="{{ $procedencia->Proced_Relig_ID }}">{{ $procedencia->Proced_Relig_Nome }}</option>
                                        @endforeach
                                    </select>
                                    @error("data.Proced_Relig_ID")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Em caso da IPB, chegou a ser membro? </label>
                                    <select wire:model.defer="data.IPB_Membro" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.IPB_Membro")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Em caso da IPB, qual o Nome da Igreja do Batismo? </label>
                                    <input wire:model.defer="data.IPB_Ig_Bat" class="form-control" type="text" placeholder="" maxlength="50" autofocus autocomplete="off">
                                    @error("data.IPB_Ig_Bat")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="IPB_Data_Bat" class="form-label">Em caso da IPB, qual a data do Batismo? </label>
                                    <input wire:model.defer="data.IPB_Data_Bat" class="form-control" type="date" placeholder="" autofocus autocomplete="off">
                                    @error("data.IPB_Data_Bat")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Em caso da IPB, qual o Nome do Pastor Oficiante do Batismo? </label>
                                    <input wire:model.defer="data.IPB_Pr_Bat" class="form-control" type="text" placeholder="" maxlength="80" autofocus autocomplete="off">
                                    @error("data.IPB_Pr_Bat")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Em caso da IPB, qual o Nome da Igreja da Profissão da Fé? </label>
                                    <input wire:model.defer="data.IPB_Ig_Prf_Fe" class="form-control" type="text" placeholder="" maxlength="50" autofocus autocomplete="off">
                                    @error("data.IPB_Ig_Prf_Fe")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="IPB_Data_Prof_Fe" class="form-label">Em caso da IPB, qual a data da Profissão de Fé? </label>
                                    <input wire:model.defer="data.IPB_Data_Prof_Fe" class="form-control" type="date" placeholder="" autofocus autocomplete="off">
                                    @error("data.IPB_Data_Prof_Fe")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Em caso da IPB, qual o Nome do Pastor Oficiante da Profissão de Fé? </label>
                                    <input wire:model.defer="data.IPB_Pr_Prof_Fe" class="form-control" type="text" placeholder="" maxlength="80" autofocus autocomplete="off">
                                    @error("data.IPB_Pr_Prof_Fe")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Em caso de outra Igreja Evangélica, chegou a ser membro? </label>
                                    <select wire:model.defer="data.OIE_Membro" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.OIE_Membro")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="OIE_Data_Bat" class="form-label">Em caso de Outra Igreja Evangélica, qual a data do Batismo? </label>
                                    <input wire:model.defer="data.OIE_Data_Bat" class="form-control" type="date" placeholder="" autofocus autocomplete="off">
                                    @error("data.OIE_Data_Bat")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Em caso de Outra Igreja Evangélica, qual o Nome do Pastor Oficiante do Batismo? </label>
                                    <input wire:model.defer="data.OIE_Pr_Bat" class="form-control" type="text" placeholder="" maxlength="50" autofocus autocomplete="off">
                                    @error("data.OIE_Pr_Bat")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Exerceu alguma Função ou Cargo na antiga igreja? <span class="text-danger">*</span></label>
                                    <select wire:model.defer="data.Exerc_F_Ig" required class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.Exerc_F_Ig")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Se exerceu alguma Função ou Cargo na Igreja, relacione quais: </label>
                                    <input wire:model.defer="data.Se_Sim_Quais" class="form-control" type="text" placeholder="" maxlength="100" autofocus autocomplete="off">
                                    @error("data.Se_Sim_Quais")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            @foreach($perguntas as $pergunta)
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="pergunta_{{ $pergunta->Pergunta_ID }}">
                                            {{ $pergunta->Pergunta }}
                                            @if($pergunta->Obrigatorio)
                                                <span class="text-danger">*</span>
                                            @endif
                                        </label>
                                        @if($pergunta->Alternativa === 1)
                                            <select class="form-control"
                                                    id="pergunta_{{ $pergunta->Pergunta_ID }}"
                                                    wire:model="respostas.{{ $pergunta->Pergunta_ID }}"
                                                    @if($pergunta->Obrigatorio) required @endif>
                                                <option value="">Selecione...</option>
                                                <option value="Sim">Sim</option>
                                                <option value="Não">Não</option>
                                            </select>
                                        @elseif($pergunta->Texto_Longo === 1)
                                            <textarea class="form-control"
                                                id="pergunta_{{ $pergunta->Pergunta_ID }}"
                                                wire:model="respostas.{{ $pergunta->Pergunta_ID }}"
                                                rows="3" @if($pergunta->Obrigatorio) required @endif>
                                            </textarea>
                                        @else
                                            <input type="text" class="form-control"
                                                    id="pergunta_{{ $pergunta->Pergunta_ID }}"
                                                    wire:model="respostas.{{ $pergunta->Pergunta_ID }}"
                                                    @if($pergunta->Obrigatorio) required @endif
                                            >
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>I - Sociedades Internas & Ministérios - Indique os de seu interesse </label>
                                    <div wire:ignore>
                                        <select data-pharaonic="select2" data-placeholder="Informe a Sociedade" data-component-id="#3" wire:model="Sociedade_Interna_ID">
                                            <option value=""></option>
                                            @foreach ($sociedades as $sociedade)
                                                <option value="{{$sociedade->Sociedade_Interna_ID}}">{{$sociedade->Sociedade_Interna_Nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error("Sociedade_Interna_ID")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>II - Departamento de Responsabilidade Social - Indique os de seu interesse </label>
                                    <div wire:ignore>
                                        <select data-pharaonic="select2" data-placeholder="Informe a Sociedade" data-component-id="#3" wire:model="Depart_Resp_Social_ID">
                                            <option value=""></option>
                                            @foreach ($departamentos as $departamento)
                                                <option value="{{$departamento->Depart_Resp_Social_ID}}">{{$departamento->Depart_Resp_Social_Nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error("Depart_Resp_Social_ID")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{route('home')}}" class="btn btn-warning">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Enviar Formulário
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
    <!-- Modal de Erros -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Erros no Formulário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            </div>
        </div>
    </div>
    <!-- Fim do Modal -->

    @push('scripts')
<script>
    $(document).ready(function () {
        $('select[wire\\:model="Naturalidade_ID"]').on('change', function (e) {
            @this.set('Naturalidade_ID', e.target.value);
        });
    });

    $(document).ready(function () {
        $('select[wire\\:model="Cidade_Origem_ID"]').on('change', function (e) {
            @this.set('Cidade_Origem_ID', e.target.value);
        });
    });

    $(document).ready(function () {
        $('select[wire\\:model="Cidade_ID"]').on('change', function (e) {
            @this.set('Cidade_ID', e.target.value);
        });
    });
    $(document).ready(function () {
        $('select[wire\\:model="Naturalidade_Conj_ID"]').on('change', function (e) {
            @this.set('Naturalidade_Conj_ID', e.target.value);
        });
    });
    $(document).ready(function () {
        $('select[wire\\:model="Naturalidade_F1_ID"]').on('change', function (e) {
            @this.set('Naturalidade_F1_ID', e.target.value);
        });
    });
    $(document).ready(function () {
        $('select[wire\\:model="Naturalidade_F2_ID"]').on('change', function (e) {
            @this.set('Naturalidade_F2_ID', e.target.value);
        });
    });
    $(document).ready(function () {
        $('select[wire\\:model="Naturalidade_F3_ID"]').on('change', function (e) {
            @this.set('Naturalidade_F3_ID', e.target.value);
        });
    });
    $(document).ready(function () {
        $('select[wire\\:model="Naturalidade_F4_ID"]').on('change', function (e) {
            @this.set('Naturalidade_F4_ID', e.target.value);
        });
    });
    $(document).ready(function () {
        $('select[wire\\:model="Naturalidade_F5_ID"]').on('change', function (e) {
            @this.set('Naturalidade_F5_ID', e.target.value);
        });
    });
    $(document).ready(function () {
        $('select[wire\\:model="Sociedade_Interna_ID"]').on('change', function (e) {
            @this.set('Sociedade_Interna_ID', e.target.value);
        });
    });
    $(document).ready(function () {
        $('select[wire\\:model="Depart_Resp_Social_ID"]').on('change', function (e) {
            @this.set('Depart_Resp_Social_ID', e.target.value);
        });
    });
</script>
@endpush

    @push('scripts')
        @if ($errors->any())
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    $('#errorModal').modal('show');
                });
            </script>
        @endif

    @endpush
</div>
