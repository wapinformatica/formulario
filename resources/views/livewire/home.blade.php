<div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">
                    <div class="text-center pb-3">
                        <img class="img-thumbnail rounded-circle" style="width: 200px; height: 200px;" src="{{asset('logo.jpeg')}}" alt=""/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Formulário de cadastros</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                {{-- @foreach ($forms as $form )
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title m-0">{{ $form->name }}</h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">{{ $form->description }}</p>
                                                <a href="{{route('pages.registration', ['id' => $form->id])}}" class="btn btn-primary">Iniciar</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach --}}

                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title m-0">Cadastro de Candidatos</h5>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">Cadastro de candidatos para futuros membros da igreja</p>
                                            <a href="{{route('pages.candidate')}}" class="btn btn-primary">Iniciar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
