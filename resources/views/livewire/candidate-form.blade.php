<div>
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
                                    <select wire:model.defer="data.Naturalidade_ID" required class="form-control">
                                        <option value="">Selecione...</option>
                                        @foreach($cidades as $cidade)
                                            <option value="{{ $cidade->Cidade_ID }}">{{ $cidade->Cidade_Nome }}</option>
                                        @endforeach
                                    </select>
                                    @error("data.Naturalidade_ID")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Cidade de Origem <span class="text-danger">*</span></label>
                                    <select wire:model.defer="data.Cidade_Origem_ID" required class="form-control">
                                        <option value="">Selecione...</option>
                                        @foreach($cidades as $cidade)
                                            <option value="{{ $cidade->Cidade_ID }}">{{ $cidade->Cidade_Nome }}</option>
                                        @endforeach
                                    </select>
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
                                    <select wire:model.defer="data.Cidade_ID" required class="form-control">
                                        <option value="">Selecione...</option>
                                        @foreach($cidades as $cidade)
                                            <option value="{{ $cidade->Cidade_ID }}">{{ $cidade->Cidade_Nome }}</option>
                                        @endforeach
                                    </select>
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
                                    <input wire:model.defer="data.Fone_Comercial" x-mask='99 9999-9999' class="form-control" type="text" placeholder="" maxlength="50" required autofocus autocomplete="off">
                                    @error("data.Fone_Comercial")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Fone_Celular" class="form-label">Telefone Celular <span class="text-danger">*</span></label>
                                    <input wire:model.defer="data.Fone_Celular" x-mask='99 9999-9999' class="form-control" type="text" placeholder="" maxlength="50" required autofocus autocomplete="off">
                                    @error("data.Fone_Celular")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
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

                            <div class="col-lg-6">
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

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Naturalidade Cônjuge </label>
                                    <select wire:model.defer="data.Naturalidade_Conj_ID" class="form-control">
                                        <option value="">Selecione...</option>
                                        @foreach($cidades as $cidade)
                                            <option value="{{ $cidade->Cidade_ID }}">{{ $cidade->Cidade_Nome }}</option>
                                        @endforeach
                                    </select>
                                    @error("data.Naturalidade_Conj_ID")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
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

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Data_Casamento" class="form-label">Data de Casamento </label>
                                    <input wire:model.defer="data.Data_Casamento" class="form-control" type="date" placeholder="" autofocus autocomplete="off">
                                    @error("data.Data_Casamento")
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
                                    <select wire:model.defer="data.Naturalidade_F1_ID" class="form-control">
                                        <option value="">Selecione...</option>
                                        @foreach($cidades as $cidade)
                                            <option value="{{ $cidade->Cidade_ID }}">{{ $cidade->Cidade_Nome }}</option>
                                        @endforeach
                                    </select>
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
                                    <select wire:model.defer="data.Naturalidade_F2_ID" class="form-control">
                                        <option value="">Selecione...</option>
                                        @foreach($cidades as $cidade)
                                            <option value="{{ $cidade->Cidade_ID }}">{{ $cidade->Cidade_Nome }}</option>
                                        @endforeach
                                    </select>
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
                                    <select wire:model.defer="data.Naturalidade_F3_ID" class="form-control">
                                        <option value="">Selecione...</option>
                                        @foreach($cidades as $cidade)
                                            <option value="{{ $cidade->Cidade_ID }}">{{ $cidade->Cidade_Nome }}</option>
                                        @endforeach
                                    </select>
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
                                    <select wire:model.defer="data.Naturalidade_F4_ID" class="form-control">
                                        <option value="">Selecione...</option>
                                        @foreach($cidades as $cidade)
                                            <option value="{{ $cidade->Cidade_ID }}">{{ $cidade->Cidade_Nome }}</option>
                                        @endforeach
                                    </select>
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
                                    <select wire:model.defer="data.Naturalidade_F5_ID" class="form-control">
                                        <option value="">Selecione...</option>
                                        @foreach($cidades as $cidade)
                                            <option value="{{ $cidade->Cidade_ID }}">{{ $cidade->Cidade_Nome }}</option>
                                        @endforeach
                                    </select>
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


                            <div class="col-lg-6 hidden">
                                <div class="form-group hidden">
                                    <label>Sexo <span class="text-danger hidden">*</span></label>
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

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="Foto" class="form-label">Foto (Tirar uma Selfie) <span class="text-danger">*</span></label>
                                    <input wire:model.defer="data.Foto" class="form-control" type="file" accept="image/*" required>
                                    @error("data.Foto")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Se casado(a), seu cônjuge frequenta a Igreja (IPC) com você? </label>
                                    <select wire:model.defer="data.R1" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.R1")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Há quanto tempo frequenta a IPC? <span class="text-danger">*</span></label>
                                    <input wire:model.defer="data.R2" class="form-control" type="text" placeholder="" maxlength="8" required autofocus autocomplete="off">
                                    @error("data.R2")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Se tem filhos, quantos são Menores de idade e Moram com você? </label>
                                    <input wire:model.defer="data.R3" class="form-control" type="text" placeholder="" maxlength="1" autofocus autocomplete="off">
                                    @error("data.R3")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Estes filhos Menores de idade serão recebidos na IPC com você? </label>
                                    <select wire:model.defer="data.R4" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.R4")
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
                                    <select wire:model.defer="data.R6" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.R6")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Em caso da IPB, qual o Nome da Igreja do Batismo? </label>
                                    <input wire:model.defer="data.R7" class="form-control" type="text" placeholder="" maxlength="50" autofocus autocomplete="off">
                                    @error("data.R7")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="R8" class="form-label">Em caso da IPB, qual a data do Batismo? </label>
                                    <input wire:model.defer="data.R8" class="form-control" type="date" placeholder="" autofocus autocomplete="off">
                                    @error("data.R8")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Em caso da IPB, qual o Nome do Pastor Oficiante do Batismo? </label>
                                    <input wire:model.defer="data.R9" class="form-control" type="text" placeholder="" maxlength="80" autofocus autocomplete="off">
                                    @error("data.R9")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Em caso da IPB, qual o Nome da Igreja da Profissão da Fé? </label>
                                    <input wire:model.defer="data.R10" class="form-control" type="text" placeholder="" maxlength="50" autofocus autocomplete="off">
                                    @error("data.R10")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="R11" class="form-label">Em caso da IPB, qual a data da Profissão de Fé? </label>
                                    <input wire:model.defer="data.R11" class="form-control" type="date" placeholder="" autofocus autocomplete="off">
                                    @error("data.R11")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Em caso da IPB, qual o Nome do Pastor Oficiante da Profissão de Fé? </label>
                                    <input wire:model.defer="data.R12" class="form-control" type="text" placeholder="" maxlength="80" autofocus autocomplete="off">
                                    @error("data.R12")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Você já está frequentando a Escola Bíblica aos Domingos? <span class="text-danger">*</span></label>
                                    <select wire:model.defer="data.R13" required class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.R13")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Caso afirmativo, está matriculado em qual classe? </label>
                                    <input wire:model.defer="data.R14" class="form-control" type="text" placeholder="" maxlength="50" autofocus autocomplete="off">
                                    @error("data.R14")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Você já está frequentando algum Grupo Familiar, Ministério ou Sociedade Interna? <span class="text-danger">*</span></label>
                                    <select wire:model.defer="data.R15" required class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.R15")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Se Sim, especifique: </label>
                                    <input wire:model.defer="data.R16" class="form-control" type="text" placeholder="" maxlength="50" autofocus autocomplete="off">
                                    @error("data.R16")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Em caso de outra Igreja Evangélica, chegou a ser membro? </label>
                                    <select wire:model.defer="data.R17" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.R17")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="R18" class="form-label">Em caso de Outra Igreja Evangélica, qual a data do Batismo? </label>
                                    <input wire:model.defer="data.R18" class="form-control" type="date" placeholder="" autofocus autocomplete="off">
                                    @error("data.R18")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Em caso de Outra Igreja Evangélica, qual o Nome do Pastor Oficiante do Batismo? </label>
                                    <input wire:model.defer="data.R19" class="form-control" type="text" placeholder="" maxlength="50" autofocus autocomplete="off">
                                    @error("data.R19")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Exerceu alguma função na igreja? <span class="text-danger">*</span></label>
                                    <select wire:model.defer="data.R20" required class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.R20")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Se exerceu alguma Função ou Cargo na Igreja, cite as que mais te agradou: </label>
                                    <input wire:model.defer="data.R21" class="form-control" type="text" placeholder="" maxlength="100" autofocus autocomplete="off">
                                    @error("data.R21")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="R22" class="form-label">Por qual(ais) razão(ões) deixou ou deseja transferir-se da sua ex-Igreja? </label>
                                    <textarea wire:model.defer="data.R22" class="form-control" rows="3" autofocus autocomplete="off"></textarea>
                                    @error("data.R22")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="R23" class="form-label">Como você conheceu a Igreja Presbiteriana de Cuiabá (IPC)? </label>
                                    <textarea wire:model.defer="data.R23" class="form-control" rows="3" autofocus autocomplete="off"></textarea>
                                    @error("data.R23")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Você sofre alguma perseguição, rejeição ou resistência, especialmente em sua família, pelo fato de ser crente? <span class="text-danger">*</span></label>
                                    <select wire:model.defer="data.R24" required class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.R24")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Você sofre alguma perseguição, rejeição ou resistência, especialmente em sua família, por ser membro da Igreja Presbiteriana? <span class="text-danger">*</span></label>
                                    <select wire:model.defer="data.R25" required class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.R25")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Em caso afirmativo, como tem sido a sua postura? </label>
                                    <input wire:model.defer="data.R26" class="form-control" type="text" placeholder="" autofocus autocomplete="off">
                                    @error("data.R26")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Você tem (ou já teve) algum vício (hábito)? Por exemplo: fumo, álcool, jogos de azar, baralho, loterias, sinuca, etc. <span class="text-danger">*</span></label>
                                    <select wire:model.defer="data.R27" required class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.R27")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Em caso de resposta afirmativa, chegou a ser dependente? </label>
                                    <select wire:model.defer="data.R28" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.R28")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Você tem problemas com dívidas financeiras? <span class="text-danger">*</span></label>
                                    <select wire:model.defer="data.R29" required class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.R29")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Como você tem administrado essa área da sua vida? <span class="text-danger">*</span></label>
                                    <input wire:model.defer="data.R30" class="form-control" type="text" placeholder="" required autofocus autocomplete="off">
                                    @error("data.R30")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Você já frequentou: espiritismo kardecista, centro de mesa branca, terreiro de umbanda, candomblé, quimbanda (magia negra), alguma fraternidade gnóstica (Rosacruz, Logosofia, Seitas metafísicas), seita esotérica ou práticas esotéricas (místicas) tais como: tarô, baralho cigano, búzios (cartomancia em geral), horóscopo, Xamanismo e Santo daime, etc?<span class="text-danger">*</span></label>
                                    <select wire:model.defer="data.R31" required class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.R31")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Em caso de resposta afirmativa qual (ais)? Por quanto tempo? Qual foi o seu "grau" de envolvimento? Fez algum pacto? </label>
                                    <input wire:model.defer="data.R32" class="form-control" type="text" placeholder="" autofocus autocomplete="off">
                                    @error("data.R32")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Você já frequentou ou frequenta a Maçonaria? <span class="text-danger">*</span></label>
                                    <select wire:model.defer="data.R33" required class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.R33")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Caso esteja frequentando ou já tenha frequentado a maçonaria, qual o seu "grau" de envolvimento? </label>
                                    <input wire:model.defer="data.R34" class="form-control" type="text" placeholder="" maxlength="100" autofocus autocomplete="off">
                                    @error("data.R34")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Caso ainda esteja frequentando a maçonaria, você pretende deixá-la (renunciá-la) para se tornar membro da IPC? </label>
                                    <select wire:model="data.R35" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.R35")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Por que você pretende se tornar membro da IPC? <span class="text-danger">*</span></label>
                                    <input wire:model.defer="data.R36" class="form-control" type="text" placeholder="" required autofocus autocomplete="off">
                                    @error("data.R36")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="R37" class="form-label">O quanto você conhece da história, do sistema de doutrina e governo da Igreja Presbiteriana do Brasil? <span class="text-danger">*</span></label>
                                    <textarea wire:model.defer="data.R37" class="form-control" rows="3" required autofocus autocomplete="off"></textarea>
                                    @error("data.R37")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Você tem dúvidas ou resistência sobre o sistema de governo ou alguma doutrina específica da Igreja Presbiteriana do Brasil? <span class="text-danger">*</span></label>
                                    <select wire:model.defer="data.R38" required class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.R38")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="R39" class="form-label">Em caso afirmativo, qual (ais) são as suas dúvidas e/ou resistências? </label>
                                    <textarea wire:model.defer="data.R39" class="form-control" rows="3" autofocus autocomplete="off"></textarea>
                                    @error("data.R39")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Você está disposto(a), receptivo(a), para receber ensinamentos visando sanar as suas dúvidas e desfazer as suas resistências? <span class="text-danger">*</span></label>
                                    <select wire:model.defer="data.R40" required class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.R40")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>A IPC entende que a prática do dízimo e da oferta, faz parte da devoção cristã, é atual e é a maneira do cristão demonstrar a sua fidelidade a Deus e generosidade, ao mesmo tempo que sustenta a Igreja e a sua obra. Você concorda com a prática de dizimar e ofertar?<span class="text-danger">*</span></label>
                                    <select wire:model.defer="data.R41" required class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="Sim">Sim</option>
                                        <option value="Não">Não</option>
                                    </select>
                                    @error("data.R41")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="R42" class="form-label">Qual a sua situação hoje? <span class="text-danger">*</span></label>
                                    <textarea wire:model.defer="data.R42" class="form-control" rows="3" required autofocus autocomplete="off"></textarea>
                                    @error("data.R42")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>I - Sociedades Internas & Ministérios <span class="text-danger">*</span></label>
                                    <select wire:model.defer="data.R43" required class="form-control">
                                        <option value="">Selecione...</option>
                                        @foreach($sociedades as $sociedade)
                                            <option value="{{ $sociedade->Sociedade_Interna_ID }}">{{ $sociedade->Sociedade_Interna_Nome }}</option>
                                        @endforeach
                                    </select>
                                    @error("data.R43")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>II - Departamento de Responsabilidade Social <span class="text-danger">*</span></label>
                                    <select wire:model.defer="data.R44" required class="form-control">
                                        <option value="">Selecione...</option>
                                        @foreach($departamentos as $departamento)
                                            <option value="{{ $departamento->Depart_Resp_Social_ID }}">{{ $departamento->Depart_Resp_Social_Nome }}</option>
                                        @endforeach
                                    </select>
                                    @error("data.R44")
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
</div>
