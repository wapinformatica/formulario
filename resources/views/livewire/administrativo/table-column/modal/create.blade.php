<form wire:submit.prevent="storeUpdate" method="post">
    <x-modal.modal-dialog :visibleModal=$showModalCreateUpdate maxWidth="lg" wire:key="showModalCreateUpdate" wire:model.defer="showModalCreateUpdate">
        <x-slot name="title">
            @if($data['id']) Editar @else Incluir @endif um Tabela Coluna
        </x-slot>
        <x-slot name="content">
            <div class="modal-body">
                <div class="row">
                    @include('includes._alerts')
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label">Nome Tabela<span class="text-danger">*</span></label>
                            <input wire:model="data.name_table" class="form-control" type="text" placeholder=" "  required autofocus autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label">Nome Coluna<span class="text-danger">*</span></label>
                            <input wire:model="data.name_column" class="form-control" type="text" placeholder=" "  required autofocus autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Status</label>
                            <select wire:model="data.status" required class="form-control">
                                <option value="1">Ativo</option>
                                <option value="0">Inativo</option>
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
