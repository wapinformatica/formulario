@if (session()->has('message'))
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                @if(session('message.type') == 'error')
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-white mb-9" >{{ session('message.title') ?? 'Erro' }}</h5>
                    </div>
                @elseif(session('message.type') == 'success')
                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-white mb-9" >{{ session('message.title') ?? 'Sucesso' }}</h5>
                    </div>
                @elseif(session('message.type') == 'warning')
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-white mb-9" >{{ session('message.title') ?? 'Aviso' }}</h5>
                    </div>
                @else
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-white mb-9" >Erro</h5>
                    </div>
                @endif

                <div class="modal-body">
                    <h5 class="modal-title text-dark mb-9" >{{ session('message.text') }}</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
@endif
@push('scripts')
<script type="text/javascript">
         $(window).on('load',function(){
             $('#myModal').modal('show'); });

</script>
@endpush
