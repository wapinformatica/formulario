<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulário #{{ $response->R1 }}</title>
    <style>
        /* Estilos base */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #212529;
        }

        /* Reset de margens e padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Classes do Bootstrap simplificadas para PDF */
        .container {
            width: 90%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-md-12 {
            flex: 0 0 100%;
            max-width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding-right: 15px;
            padding-left: 15px;
        }

        .mt-4 { margin-top: 1.5rem !important; }
        .mb-3 { margin-bottom: 1rem !important; }
        .mb-4 { margin-bottom: 1.5rem !important; }

        /* Estilos para tabelas */
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
            background-color: #f8f9fa;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        /* Estilos para cabeçalho */
        .header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #dee2e6;
        }

        .title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .subtitle {
            font-size: 1rem;
            color: #6c757d;
        }

        /* Estilos para seções */
        h4 {
            font-size: 1.1rem;
            margin-bottom: 0.75rem;
            color: #343a40;
            font-weight: 600;
        }

        /* Estilos para status */
        .badge {
            display: inline-block;
            padding: 0.25em 0.4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
        }

        .badge-success {
            color: #fff;
            background-color: #28a745;
        }

        .badge-danger {
            color: #fff;
            background-color: #dc3545;
        }

        .badge-warning {
            color: #212529;
            background-color: #ffc107;
        }

        .badge-secondary {
            color: #fff;
            background-color: #6c757d;
        }

        /* Espaçamentos e divisores */
        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        /* Responsividade para PDF */
        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Melhorias para impressão/PDF */
        @page {
            margin: 1cm;
        }

        /* Evitar quebras de página dentro de seções importantes */
        .section {
            page-break-inside: avoid;
        }

        /* Estilo para campos de dados */
        .data-field {
            margin-bottom: 0.5rem;
        }

        .data-field strong {
            display: inline-block;
            min-width: 180px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img style="max-width: 120px; max-height: 120px; height: auto;" src="{{public_path('logo.jpeg')}}" alt=""/>
        </div>
        <div class="title" style="text-align: center;">
            @if($response->Foto)
            <img src="{{ public_path('storage/' . $response->Foto) }}" alt="Foto do candidato" style="max-width: 80px; max-height: 80px; height: auto; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 0;">
            @endif
        </div>

        <div class="row section">
            <!-- Dados Pessoais -->
            <div class="col-md-12">
                <h4 class="mb-3">Dados Pessoais</h4>
            </div>

            <div class="col-md-12 data-field">
                <strong>Nome do Candidato:</strong> {{ $response->Nome_Candidato }}
            </div>
            <div class="col-md-6 data-field">
                <strong>Nome da Mãe:</strong> {{ $response->Nome_Mae }}
            </div>
            <div class="col-md-6 data-field">
                <strong>Nome do Pai:</strong> {{ $response->Nome_Pai }}
            </div>
            <div class="col-md-6 data-field">
                <strong>Naturalidade:</strong> {{ $response->naturalidade->Cidade_Nome ?? '' }}
            </div>
            <div class="col-md-6 data-field">
                <strong>Cidade de Origem:</strong> {{ $response->cidadeOrigem->Cidade_Nome ?? '' }}
            </div>
            <div class="col-md-6 data-field">
                <strong>CPF:</strong> {{ $response->Cpf }}
            </div>
            <div class="col-md-6 data-field">
                <strong>RG:</strong> {{ $response->Rg }}
            </div>
            <div class="col-md-6 data-field">
                <strong>Órgão Expedidor:</strong> {{ $response->Orgao_Exp }}
            </div>
            <div class="col-md-6 data-field">
                <strong>E-mail:</strong> {{ $response->e_mail }}
            </div>
            <div class="col-md-6 data-field">
                <strong>Data de Nascimento:</strong> {{ \Carbon\Carbon::parse($response->Data_Nascimento)->format('d/m/Y') }}
            </div>
            <div class="col-md-6 data-field">
                <strong>Sexo:</strong> {{ $response->Sexo == 'M' ? 'Masculino' : 'Feminino' }}
            </div>
            <div class="col-md-6 data-field">
                <strong>Profissão:</strong> {{ $response->profissao->Profissao_Nome ?? '' }}
            </div>
            <div class="col-md-6 data-field">
                <strong>Estado Civil:</strong> {{ $response->estadoCivil->Estado_Civil_Nome ?? '' }}
            </div>
            <div class="col-md-6 data-field">
                <strong>Data de Cadastro:</strong> {{ date('d/m/Y', strtotime($response->Data_Cadastro)) }}
            </div>
        </div>

        <div class="row section mt-4">
            <!-- Endereço -->
            <div class="col-md-12">
                <h4>Endereço</h4>
            </div>

            <div class="col-md-12 data-field">
                <strong>Logradouro:</strong> {{ $response->Logradouro }}
            </div>
            <div class="col-md-6 data-field">
                <strong>Número:</strong> {{ $response->Numero }}
            </div>
            <div class="col-md-6 data-field">
                <strong>Bairro:</strong> {{ $response->Bairro }}
            </div>
            <div class="col-md-6 data-field">
                <strong>CEP:</strong> {{ $response->CEP }}
            </div>
            <div class="col-md-6 data-field">
                <strong>Cidade:</strong> {{ $response->cidade->Cidade_Nome ?? '' }}
            </div>
            <div class="col-md-12 data-field">
                <strong>Complemento:</strong> {{ $response->Complemento ?? 'Não informado' }}
            </div>
        </div>

        <div class="row section mt-4">
            <!-- Contato -->
            <div class="col-md-12">
                <h4>Contato</h4>
            </div>

            <div class="col-md-6 data-field">
                <strong>Telefone Comercial:</strong> {{ $response->Fone_Comercial }}
            </div>
            <div class="col-md-6 data-field">
                <strong>Telefone Celular:</strong> {{ $response->Fone_Celular }}
            </div>
        </div>

        <!-- Dados do Cônjuge -->
        @if($response->Nome_Conj)
        <div class="row section mt-4">
            <div class="col-md-12">
                <h4>Dados do Cônjuge</h4>
            </div>

            <div class="col-md-6 data-field">
                <strong>Nome do Cônjuge:</strong> {{ $response->Nome_Conj }}
            </div>
            <div class="col-md-6 data-field">
                <strong>Data de Nascimento:</strong> {{ $response->Data_Nasc_Conj ? \Carbon\Carbon::parse($response->Data_Nasc_Conj)->format('d/m/Y') : 'Não informado' }}
            </div>
            <div class="col-md-6 data-field">
                <strong>Naturalidade:</strong> {{ $response->naturalidadeConjuge->Cidade_Nome ?? 'Não informado' }}
            </div>
            <div class="col-md-6 data-field">
                <strong>Profissão:</strong> {{ $response->profissaoConjuge->Profissao_Nome ?? 'Não informado' }}
            </div>
            <div class="col-md-6 data-field">
                <strong>Data de Casamento:</strong> {{ $response->Data_Casamento ? \Carbon\Carbon::parse($response->Data_Casamento)->format('d/m/Y') : 'Não informado' }}
            </div>
            <div class="col-md-6 data-field">
                <strong>Frequenta a IPC:</strong> {{ $response->R4 ?? 'Não informado' }}
            </div>
        </div>
        @endif

        <!-- Filhos -->
        @for($i = 1; $i <= 5; $i++)
            @php $field = 'Nome_F'.$i; @endphp
            @if($response->$field)
            <div class="row section mt-4">
                <div class="col-md-12">
                    <h4>Dados do {{ $i }}º Filho</h4>
                </div>

                <div class="col-md-6 data-field">
                    <strong>Nome:</strong> {{ $response->$field }}
                </div>
                <div class="col-md-6 data-field">
                    @php $dataField = 'Data_Nasc_F'.$i; @endphp
                    <strong>Data de Nascimento:</strong> {{ $response->$dataField ? \Carbon\Carbon::parse($response->$dataField)->format('d/m/Y') : 'Não informado' }}
                </div>
                <div class="col-md-6 data-field">
                    @php $naturalidadeField = 'Naturalidade_F'.$i.'_ID'; @endphp
                    <strong>Naturalidade:</strong> {{ $response->{'naturalidadeF'.$i}->Cidade_Nome ?? 'Não informado' }}
                </div>
                <div class="col-md-6 data-field">
                    @php $batizadoField = 'P_'.$i.'1'; @endphp
                    <strong>Já foi batizado:</strong> {{ $response->$batizadoField ?? 'Não informado' }}
                </div>
                <div class="col-md-6 data-field">
                    @php $batizadoJuntoField = 'P_'.$i.'2'; @endphp
                    <strong>Será batizado junto:</strong> {{ $response->$batizadoJuntoField ?? 'Não informado' }}
                </div>
            </div>
            @endif
        @endfor

        {{-- <div class="row section mt-4">
            <!-- Documentos -->
            <div class="col-md-12">
                <h4>Documentos</h4>
            </div>

            <div class="col-md-6 data-field">
                <strong>Certidão de Casamento:</strong>
                @if($response->R1)
                    <span class="badge badge-success">Enviado</span>
                @else
                    <span class="badge badge-secondary">Não enviado</span>
                @endif
            </div>
            <div class="col-md-6 data-field">
                <strong>Foto:</strong>
                @if($response->R3)
                    <span class="badge badge-success">Enviada</span>
                @else
                    <span class="badge badge-secondary">Não enviada</span>
                @endif
            </div>
        </div> --}}

        <hr class="mt-4 mb-4">

        @if($answers)
        <div class="row section">
            <div class="col-md-12">
                <h4>Respostas</h4>
            </div>

            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="40%">Pergunta</th>
                                <th>Resposta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Se casado(a), seu cônjuge frequenta a Igreja (IPC) com você?</td>
                                <td>{{ $response->R1 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Há quanto tempo frequenta a IPC?</td>
                                <td>{{ $response->R2 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Se tem filhos, quantos são menores de idade e moram com você?</td>
                                <td>{{ $response->R3 ?? 'Nenhum' }}</td>
                            </tr>
                            <tr>
                                <td>Estes filhos Menores de idade serão recebidos na IPC com você?</td>
                                <td>{{ $response->R4 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Última Procedência Religiosa (Denominação):</td>
                                <td>{{ $response->procedencia->Proced_Relig_Nome ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Em caso da IPB, chegou a ser membro?</td>
                                <td>{{ $response->R6 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Em caso da IPB, qual o Nome da Igreja do Batismo?</td>
                                <td>{{ $response->R7 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Em caso da IPB, qual a data do Batismo?</td>
                                <td>{{ $response->R8 ? date('d/m/Y', strtotime($response->R8)) : 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Em caso da IPB, qual o Nome do Pastor Oficiante do Batismo?</td>
                                <td>{{ $response->R9 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Em caso da IPB, qual o Nome da Igreja da Profissão da Fé?</td>
                                <td>{{ $response->R10 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Em caso da IPB, qual a data da Profissão de Fé?</td>
                                <td>{{ $response->R11 ? date('d/m/Y', strtotime($response->R11)) : 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Em caso da IPB, qual o Nome do Pastor Oficiante da Profissão de Fé?</td>
                                <td>{{ $response->R12 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Você já está frequentando a Escola Bíblica aos Domingos?</td>
                                <td>{{ $response->R13 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Caso afirmativo, está matriculado em qual classe?</td>
                                <td>{{ $response->R14 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Você já está frequentando algum Grupo Familiar, Ministério ou Sociedade Interna?</td>
                                <td>{{ $response->R15 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Se Sim, especifique:</td>
                                <td>{{ $response->R16 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Em caso de outra Igreja Evangélica, chegou a ser membro?</td>
                                <td>{{ $response->R17 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Em caso de Outra Igreja Evangélica, qual a data do Batismo?</td>
                                <td>{{ $response->R18 ? date('d/m/Y', strtotime($response->R18)) : 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Em caso de Outra Igreja Evangélica, qual o Nome do Pastor Oficiante do Batismo?</td>
                                <td>{{ $response->R19 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Exerceu alguma função na igreja?</td>
                                <td>{{ $response->R20 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Se exerceu alguma Função ou Cargo na Igreja, cite as que mais te agradou:</td>
                                <td>{{ $response->R21 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Por qual(ais) razão(ões) deixou ou deseja transferir-se da sua ex-Igreja?</td>
                                <td>{{ $response->R22 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Como você conheceu a Igreja Presbiteriana de Cuiabá (IPC)?</td>
                                <td>{{ $response->R23 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Você sofre alguma perseguição, rejeição ou resistência, especialmente em sua família, pelo fato de ser crente?</td>
                                <td>{{ $response->R24 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Você sofre alguma perseguição, rejeição ou resistência, especialmente em sua família, por ser membro da Igreja Presbiteriana?</td>
                                <td>{{ $response->R25 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Em caso afirmativo, como tem sido a sua postura?</td>
                                <td>{{ $response->R26 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Você tem (ou já teve) algum vício (hábito)? Por exemplo: fumo, álcool, jogos de azar, baralho, loterias, sinuca, etc.</td>
                                <td>{{ $response->R27 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Em caso de resposta afirmativa, chegou a ser dependente?</td>
                                <td>{{ $response->R28 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Você tem problemas com dívidas financeiras?</td>
                                <td>{{ $response->R29 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Como você tem administrado essa área da sua vida?</td>
                                <td>{{ $response->R30 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Você já frequentou: espiritismo kardecista, centro de mesa branca, terreiro de umbanda, candomblé, quimbanda (magia negra), alguma fraternidade gnóstica (Rosacruz, Logosofia, Seitas metafísicas), seita esotérica ou práticas esotéricas (místicas) tais como: tarô, baralho cigano, búzios (cartomancia em geral), horóscopo, Xamanismo e Santo daime, etc?</td>
                                <td>{{ $response->R31 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Em caso de resposta afirmativa qual (ais)? Por quanto tempo? Qual foi o seu "grau" de envolvimento? Fez algum pacto?</td>
                                <td>{{ $response->R32 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Você já frequentou ou frequenta a Maçonaria?</td>
                                <td>{{ $response->R33 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Caso esteja frequentando ou já tenha frequentado a maçonaria, qual o seu "grau" de envolvimento?</td>
                                <td>{{ $response->R34 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Caso ainda esteja frequentando a maçonaria, você pretende deixá-la (renunciá-la) para se tornar membro da IPC?</td>
                                <td>{{ $response->R35 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Por que você pretende se tornar membro da IPC?</td>
                                <td>{{ $response->R36 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>O quanto você conhece da história, do sistema de doutrina e governo da Igreja Presbiteriana do Brasil?</td>
                                <td>{{ $response->R37 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Você tem dúvidas ou resistência sobre o sistema de governo ou alguma doutrina específica da Igreja Presbiteriana do Brasil?</td>
                                <td>{{ $response->R38 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Em caso afirmativo, qual (ais) são as suas dúvidas e/ou resistências?</td>
                                <td>{{ $response->R39 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Você está disposto(a), receptivo(a), para receber ensinamentos visando sanar as suas dúvidas e desfazer as suas resistências?</td>
                                <td>{{ $response->R40 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>A IPC entende que a prática do dízimo e da oferta, faz parte da devoção cristã, é atual e é a maneira do cristão demonstrar a sua fidelidade a Deus e generosidade, ao mesmo tempo que sustenta a Igreja e a sua obra. Você concorda com a prática de dizimar e ofertar?</td>
                                <td>{{ $response->R41 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>Qual a sua situação hoje?</td>
                                <td>{{ $response->R42 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>I - Sociedades Internas & Ministérios</td>
                                <td>{{ $response->R43 ?? 'Não informado' }}</td>
                            </tr>
                            <tr>
                                <td>II - Departamento de Responsabilidade Social</td>
                                <td>{{ $response->R44 ?? 'Não informado' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        <div style="margin-top: 30px; text-align: right; font-size: 12px;">
            Gerado em: {{ now()->format('d/m/Y H:i') }}
        </div>
    </div>
</body>
</html>
