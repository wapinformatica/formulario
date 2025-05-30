<?php

namespace App\Http\Livewire\RegistrationList;

use App\Models\Candidato;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\WithPagination;
use App\Models\FormResponse;
use Exception;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;

    public $title = 'Lista de Cadastro';
    public $pages = 'Formulário';


    public $search = '';
    public $statusFilter = '';
    public $selectedResponse = null;
    public $approvalStatus = '';
    public $approvalNotes = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => '']
    ];

    public function render()
    {
        // $query = FormResponse::with(['form', 'answers.question'])
        //     ->latest();

        // if ($this->search) {
        //     $query->whereHas('answers', function($q) {
        //         $q->where('answer', 'like', '%'.$this->search.'%')
        //             ->whereHas('question', function($q2) {
        //                 $q2->where('question', 'Nome Completo');
        //             });
        //     });
        // }

        // if ($this->statusFilter) {
        //     $query->where('status', $this->statusFilter);
        // }

        $query = Candidato::where('Candidato_ID', '!=', null)->where('Candidato_ID', '>', 4)->orderBy('Data_Cadastro', 'asc');

        if ($this->search) {
            $query->where('R2', 'like', '%'.$this->search.'%');
        }

        return view('livewire.registration-list.index', [
            'responses' => $query->paginate(10),
            'statusOptions' => [
                '' => 'Todos',
                'pending' => 'Pendentes',
                'approved' => 'Aprovados',
                'rejected' => 'Rejeitados'
            ]
        ]);
    }

    public function viewResponse($responseId)
    {
        // $this->selectedResponse = FormResponse::with(['form', 'answers.question'])
        //     ->findOrFail($responseId);

        // $this->approvalStatus = $this->selectedResponse->status;
        // $this->approvalNotes = $this->selectedResponse->approval_notes;

        $this->selectedResponse = Candidato::where('Candidato_ID', $responseId)->first();
    }

    public function updateApproval()
    {
        $this->validate([
            'approvalStatus' => 'required|in:pending,approved,rejected',
            'approvalNotes' => 'nullable|string|max:500'
        ]);

        $this->selectedResponse->update([
            'status' => $this->approvalStatus,
            'approval_notes' => $this->approvalNotes,
            'processed_at' => now(),
            'processed_by' => auth()->id()
        ]);

        session()->flash('message', 'Status atualizado com sucesso!');
        $this->reset(['selectedResponse', 'approvalStatus', 'approvalNotes']);
    }

    public function closeModal()
    {
        $this->reset(['selectedResponse', 'approvalStatus', 'approvalNotes']);
    }

    public function downloadPhoto($responseId)
    {
        $response = Candidato::where('Candidato_ID', $responseId)->first();

        return response()->download(storage_path("app/public/{$response->Foto}"));
    }

    public function downloadDocument($responseId)
    {
        $response = Candidato::where('Candidato_ID', $responseId)->first();

        if ($response && $response->Certidao_Casamento) {
            $filePath = storage_path("app/public/{$response->Certidao_Casamento}");

            if (file_exists($filePath)) {
                return response()->download($filePath);
            }
        }

        if ($response && $response->URL_Certidao_Casamento) {
            return redirect()->away($response->URL_Certidao_Casamento);
        }
    }

    public function generatePdf($responseId, $answers = true)
    {
        // $response = FormResponse::with(['form', 'answers.question'])
        //     ->findOrFail($responseId);

        $response = Candidato::where('Candidato_ID', $responseId)->first();

        $pdf = Pdf::loadView('pdf.form-response', [
            'response' => $response,
            'answers' => $answers,
        ]);

        // Opção 1: Download direto
        return response()->streamDownload(
            fn () => print($pdf->output()),
            "candidato-{$response->Candidato_ID}.pdf"
        );

        // Opção 2: Salvar no storage e retornar URL
        // $path = "pdf/formulario-{$response->id}.pdf";
        // Storage::put($path, $pdf->output());
        // return Storage::url($path);
    }

    // public function generatePdf($responseId)
    // {
    //     $response = FormResponse::with(['form', 'answers.question'])
    //         ->findOrFail($responseId);

    //     $pdf = Pdf::loadView('pdf.form-response', [
    //         'response' => $response
    //     ]);

    //     $pdfPath = 'temp/form-response-'.$responseId.'-'.time().'.pdf';
    //     Storage::put($pdfPath, $pdf->output());

    //     $pdfUrl = Storage::url($pdfPath);

    //     $this->dispatchBrowserEvent('openPdf', ['pdf_url' => $pdfUrl]);

    //     // Opcional: limpar o arquivo depois de um tempo
    //     $this->cleanupTempFile($pdfPath);
    // }

    // protected function cleanupTempFile($path)
    // {
    //     // Limpa o arquivo após 30 minutos (opcional)
    //     dispatch(function () use ($path) {
    //         sleep(1800); // 30 minutos
    //         if (Storage::exists($path)) {
    //             Storage::delete($path);
    //         }
    //     })->afterResponse();
    // }
}
