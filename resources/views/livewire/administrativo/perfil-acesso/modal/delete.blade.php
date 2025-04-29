<x-modal.modal-message :visibleModal=$showModalDelete wire:key="showModalDelete" >
    <x-slot name="header">
        <div class="modal-header bg-primary">
			<h5 class="modal-title text-white mb-9" id="exampleModalLabel" >Confirmação</h5>
		</div>
    </x-slot>
    <x-slot name="body">
    	<div class="modal-body">
			<h6 class="modal-title text-black mb-9">Deseja realmente excluir o perfil de acesso {{ $namePerfil }}</h6>
		</div>
    </x-slot>
    <x-slot name="footer">
        <button type="button" wire:click="destroy" class="btn btn-primary">Excluir</button>
        <button type="button" wire:click="$set('showModalDelete', false)" class="btn btn-danger">Fechar</button>
    </x-slot>
</x-modal.modal-message>

