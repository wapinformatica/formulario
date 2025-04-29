<!-- resources/views/pdf/form-response.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulário #{{ $response->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        .title { font-size: 24px; font-weight: bold; }
        .subtitle { font-size: 16px; color: #555; }
        .response-info { margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; }
        .table th { background-color: #f2f2f2; text-align: left; }
        .status-badge { 
            padding: 3px 8px; 
            border-radius: 3px; 
            font-size: 12px;
        }
        .approved { background-color: #d4edda; color: #155724; }
        .rejected { background-color: #f8d7da; color: #721c24; }
        .pending { background-color: #e2e3e5; color: #383d41; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">{{ $response->form->name }}</div>
        <div class="subtitle">
            Resposta #{{ $response->id }} - 
            {{ $response->answers->firstWhere('question.question', 'Nome Completo')->answer ?? 'N/A' }}
        </div>   
        <div class="subtitle">Resposta #{{ $response->id }}</div>
    </div>

    <div class="response-info">
        <p><strong>Data de Envio:</strong> {{ $response->created_at->format('d/m/Y H:i') }}</p>
        <p><strong>Status:</strong> 
            <span class="status-badge {{ $response->status }}">
                {{ $response->status == 'approved' ? 'Aprovado' : 
                  ($response->status == 'rejected' ? 'Rejeitado' : 'Pendente') }}
            </span>
        </p>
        @if($response->processed_at)
            <p><strong>Processado em:</strong> {{ $response->processed_at->format('d/m/Y H:i') }}</p>
            <p><strong>Por:</strong> {{ $response->processor->name ?? 'N/A' }}</p>
        @endif
        @if($response->approval_notes)
            <p><strong>Observações:</strong> {{ $response->approval_notes }}</p>
        @endif
    </div>

    <table class="table">
        <thead>
            <tr>
                <th width="40%">Pergunta</th>
                <th>Resposta</th>
            </tr>
        </thead>
        <tbody>
            @foreach($response->answers as $answer)
                <tr>
                    <td>{{ $answer->question->question }}</td>
                    <td>
                        @if(is_array(json_decode($answer->answer)))
                            <ul style="margin: 0; padding-left: 20px;">
                                @foreach(json_decode($answer->answer) as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        @else
                            {{ $answer->answer }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 30px; text-align: right; font-size: 12px;">
        Gerado em: {{ now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>