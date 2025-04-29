@props([
    'static' => false,
    'maxWidth' => 'md',
    'visibleModal' => false,
])
@php
      switch ($maxWidth ?? '') {
        case 'sm':
            $maxWidth = 'modal-sm';
            break;
        case 'md':
            $maxWidth = 'modal-md';
            break;
        case 'lg':
            $maxWidth = 'modal-lg';
            break;
        case 'xl':
            $maxWidth = 'modal-xl';
            break;
        case '4xl':
            $maxWidth = 'sm:max-w-4xl';
            break;
        case '6xl':
            $maxWidth = 'sm:max-w-6xl';
            break;
        case 'center':
            $maxWidth = 'modal-dialog-centered modal-notify modal-info modal-fluid 1';
            break;
        case '':
        default:
            $maxWidth = '';
            break;
    }
@endphp
<div class="modal fade" id={{ $attributes['wire:key'] }} wire:ignore.self data-backdrop="static" data-keyboard="false" role="dialog" tabindex="-1" aria-labelledby="new-event-label" aria-hidden="true">
    <div class="modal-dialog {{ $maxWidth }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }} </h5>
            </div>
                {{ $content }}
            <div class="modal-footer border-1">
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


    <script type="text/javascript">
        window.addEventListener('open'+@js($attributes['wire:key']), event => {
            $("#"+@js($attributes['wire:key'])).modal('show');
        });
        window.addEventListener('close'+@js($attributes['wire:key']), event => {
            $("#"+@js($attributes['wire:key'])).modal('hide');
        });
        if(@js($visibleModal)){
            $(window).on('load',function(){
             $('#'+@js($attributes['wire:key'])).modal('show'); });
        }
    </script>

