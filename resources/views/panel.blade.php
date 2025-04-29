@extends('layouts.app')

@section('content')

    @php
        date_default_timezone_set('America/Cuiaba');
        $hora = date('H');
        $nome =  Auth::user()->name;
        if( $hora >= 6 && $hora <= 12 )
            $message = 'Bom dia' . (empty($nome) ? '' : ', ' . $nome);
        else if ( $hora > 12 && $hora <=18  )
            $message = 'Boa tarde' . (empty($nome) ? '' : ', ' . $nome);
        else
            $message ='Boa noite' . (empty($nome) ? '' : ', ' . $nome);
    @endphp

    <section class="content">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="callout callout-info">
                            <h5><i class="fas fa-info"></i> Olá: {{$message}}</h5>
                            Sistema de formulários é a melhorar forma de eficiência do seu negócio.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
