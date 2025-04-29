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
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-body p-0">
                                @include('includes._alerts')
                                <div class="mailbox-controls">
                                    <div class="float-left">
                                        <div class="input-group ">
                                            <div class="input-group-append">
                                                <div class="btn btn-primary">
                                                    <i class="fas fa-search"></i>
                                                </div>
                                            </div>
                                            <input type="text" wire:model="search" class="form-control" placeholder="Pesquisar">
                                        </div>
                                    </div>
                                    <div class="float-right">
                                        @can('questionforms_incluir')
                                            <button wire:click="create" class="btn btn-primary btn-block mb-2" ><i class="fa fa-plus"></i> Novo</button>
                                        @endcan
                                    </div>
                                </div>
                                <div class="table-responsive mailbox-messages">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                            <th>Nome</th>
                                            <th>Descrição</th>
                                            <th style="width: 10%">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($forms as $form)
                                                <tr>
                                                    <td class="mailbox-name">{{$form->name}}</td>
                                                    <td class="mailbox-name">{{$form->description}}</td>
                                                    <td class="project-actions text-right" >
                                                        @can('questionforms_incluir')
                                                            <button class="btn btn-info btn-sm" wire:click="edit({{$form->id}})" title="editar">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </button>
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer p-0">
                                <div class="mailbox-controls">
                                    <div class="btn-group">
                                        {{   $forms->links() }}
                                    </div>
                                    @if(!$forms->isNotEmpty())
                                        <div class="text-center">
                                            <h5 class="text-danger mb-9">Nenhum Registro encontrado!</h5>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</section>
    @include('livewire.administrativo.perfil-acesso.modal.create')
    @include('livewire.administrativo.perfil-acesso.modal.delete')
    @include('includes._messages')
</div>
