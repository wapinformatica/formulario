<form wire:submit.prevent="storeUpdate" method="post">
    <x-modal.modal-dialog :visibleModal=$showModalCreatePessoa maxWidth="lg" wire:key="showModalCreatePessoa" wire:model.defer="showModalCreatePessoa">
        <x-slot name="title">
            @if($user_id) Editar @else Incluir @endif um Usuário
        </x-slot>
        <x-slot name="content">
            <div class="modal-body">
                <div class="row">
                    @include('includes._alerts')
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Pessoa <span class="text-danger">*</span></label>
                            <div wire:ignore>
                                <select data-pharaonic="select2" data-placeholder="Informe o nome" data-component-id="#1" wire:model="data.Pes_ID">
                                    <option value=""></option>
                                    @foreach ($pessoas as $pessoa)
                                        <option value="{{$pessoa->Pes_ID}}">{{$pessoa->Nome}} / {{$pessoa->e_mail}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error("data.Pes_ID")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="full-name" class="form-label">Nome {{$data['Pes_ID']}}<span class="text-danger">*</span></label>
                            <input wire:model.defer="data.name" class="form-control" type="text" placeholder=" "  disabled autofocus autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="email11" class="form-label">Email <span class="text-danger">*</span></label>
                            <input wire:model.defer="data.email" class="form-control" type="email" placeholder=" " disabled autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="password11" class="form-label">Senha <span class="text-danger">*</span></label>
                            <input wire:model.defer="data.password" class="form-control" type="password" placeholder=" " @if(!$this->user_id) required @endif autocomplete="new-password" >
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="confirm-password" class="form-label">Confirma Password <span class="text-danger">*</span></label>
                            <input wire:model.defer="data.password_confirmation" class="form-control" type="password" placeholder=" " @if(!$this->user_id) required @endif >
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- select -->
                        <div class="form-group">
                            <label>Perfil de Acesso</label>
                            <select wire:model.defer="data.role_id" required class="form-control">
                                <option selected disabled value="">Selecione...</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->description }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <button type="button" wire:click="$set('showModalCreatePessoa', false)" class="btn btn-danger">Fechar</button>
        </x-slot>
    </x-modal.modal-dialog>
</form>

@push('scripts')
<script>
    $(document).ready(function () {
        $('select[wire\\:model="data.Pes_ID"]').on('change', function (e) {
            @this.set('data.Pes_ID', e.target.value);
        });
    });
</script>
@endpush
