<form wire:submit.prevent="storeUpdate" method="post">
    <x-modal.modal-dialog :visibleModal=$showModalCreateUpdate maxWidth="md" wire:key="showModalCreateUpdate" wire:model.defer="showModalCreateUpdate">
        <x-slot name="title">
            @if($idPerfil) Editar @else Incluir @endif um Perfil de Acesso
        </x-slot>
        <x-slot name="content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nome</label>
                    <input type="text" wire:model="namePerfil" class="form-control mb-0" required  placeholder="Informe o nome" autocomplete="off">
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <button type="button" wire:click="$set('showModalCreateUpdate', false)" class="btn btn-danger">Fechar</button>
        </x-slot>
    </x-modal.modal-dialog>
</form>
