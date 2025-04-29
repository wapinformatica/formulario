<form wire:submit.prevent="storeUpdate" method="post">
    <x-modal.modal-dialog :visibleModal=$showModalCreateUpdate maxWidth="lg" wire:key="showModalCreateUpdate" wire:model.defer="showModalCreateUpdate">
        <x-slot name="title">
            @if($user_id) Editar @else Incluir @endif um Usuário
        </x-slot>
        <x-slot name="content">
            <div class="modal-body">
                <div class="row">
                    @include('includes._alerts')
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="full-name" class="form-label">Nome <span class="text-danger">*</span></label>
                            <input wire:model="data.name" class="form-control" type="text" placeholder=" "  required autofocus autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="email11" class="form-label">Email <span class="text-danger">*</span></label>
                            <input wire:model="data.email" class="form-control" type="email" placeholder=" " required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="password11" class="form-label">Senha <span class="text-danger">*</span></label>
                            <input wire:model="data.password" class="form-control" type="password" placeholder=" " @if(!$this->user_id) required @endif autocomplete="new-password" >
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="confirm-password" class="form-label">Confirma Password <span class="text-danger">*</span></label>
                            <input wire:model="data.password_confirmation" class="form-control" type="password" placeholder=" " @if(!$this->user_id) required @endif >
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- select -->
                        <div class="form-group">
                            <label>Perfil de Acesso</label>
                            <select wire:model="data.role_id" required class="form-control">
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
            <button type="button" wire:click="$set('showModalCreateUpdate', false)" class="btn btn-danger">Fechar</button>
        </x-slot>
    </x-modal.modal-dialog>
</form>
