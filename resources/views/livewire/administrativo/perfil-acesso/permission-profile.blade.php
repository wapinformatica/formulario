<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{$title}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pages.perfilacesso') }}">Perfil Acesso</a></li>
                        <li class="breadcrumb-item active">{{$pages}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    @include('includes._alerts')
                    <div class="col-xl-6 col-lg-4">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Perfil de Acesso</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div wire:ignore id="senar" class="demo"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-8">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">@if ($menu_name !== null)  {{ $menu_name }}  @else Selecione o Perfil @endif </h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width:10px" class="text-center">
                                                <input class="icheck-primary" type="checkbox"
                                                    wire:click="selectPageRows" wire:model="multiSelected">
                                            </th>
                                            <th>Nome Permissão</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissions as $permission)
                                        <tr>
                                            <td style="width:90px" class="text-center"> <input class="form-check-input" type="checkbox" value='{{$permission->id}}'
                                                wire:model.lazy="selected"  checked  >
                                            </td>
                                            <td>{{ $permission->title }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <hr>
                                <div class="mailbox-controls">
                                    @if($permissions)
                                    <div class="float-left">
                                        <button type="button" wire:click="salve" class="btn btn-primary ml4">Salvar</button>
                                    </div>
                                    @endif
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



@push('scripts')
<script>
    var dataMenu = @js(  $dataMenu ) ;
    $('#senar').jstree({
        'core' : {
            'data' : dataMenu
        }
    }).on('changed.jstree', function (e, data) {
        for(i = 0, j = data.selected.length; i < j; i++) {
            Livewire.emit('postAdded',data.instance.get_node(data.selected[i]).id)
        }
    });
</script>
@endpush
