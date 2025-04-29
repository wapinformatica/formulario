@props([
    'visibleModal' => false,
])

<div class="modal fade" id={{ $attributes['wire:key'] }} tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
            {{ $header }}
            {{ $body }}
            <div class="modal-footer">
                {{ $footer }}
            </div>
		</div>
	</div>
</div>
@php
    if($visibleModal){
        $this->emit( $this->dispatchBrowserEvent('open'.$attributes['wire:key']) );
    } else {
        $this->emit( $this->dispatchBrowserEvent('close'.$attributes['wire:key']) );
    }
@endphp
@push('scripts')
    <script type="text/javascript">
        window.addEventListener('open'+@js($attributes['wire:key']), event => {
            $("#"+@js($attributes['wire:key'])).modal('show');
        });
        window.addEventListener('close'+@js($attributes['wire:key']), event => {
            $("#"+@js($attributes['wire:key'])).modal('hide');
        });
    </script>
@endpush
