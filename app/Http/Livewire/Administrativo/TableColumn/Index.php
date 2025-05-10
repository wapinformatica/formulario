<?php

namespace App\Http\Livewire\Administrativo\TableColumn;

use App\Models\Column;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $title = 'Cadastro de Tabela Colunas';
    public $pages = 'Tabela Colunas';
    public $search = '';
    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public $selected = [];
    public $showModalCreateUpdate = false;
    public $showModalDelete = false;
    public $message;
    public $roles;
    public $data = [
        'id' => '',
        'name_table' => '',
        'name_column' => '',
        'status' => '1',
    ];

    public function render()
    {
        return view('livewire.administrativo.table-column.index',[
            'columns' => Column::queryFilter($this->search, $this->perPage)
        ]);
    }

    public function mount()
    {

    }

    public function edit($id)
    {
        $column = Column::find($id);
        $this->data['id']  = $column->id;
        $this->data['name_table'] = $column->name_table;
        $this->data['name_column'] = $column->name_column;
        $this->data['status'] = $column->status;
        $this->showModalCreateUpdate = true;
    }

    public function create()
    {
        $this->reset('data');
        $this->showModalCreateUpdate = true;
    }

    public function storeUpdate()
    {
        if($this->data['id']){
            $this->update();
        } else {
            $this->store();
        }
    }

    public function store()
    {
        try{
            $exists = Column::where('name_table', $this->data['name_table'])
                ->where('name_column', $this->data['name_column'])
                ->exists();

            if ($exists) {
                session()->flash('message', [
                    'type' => 'warning',
                    'title' => 'Erro',
                    'text' => 'A combinação de Tabela e Coluna já existe no banco de dados.'
                ]);
                return;
            }
            $column = Column::create([
                'name_table' => $this->data['name_table'],
                'name_column' => $this->data['name_column'],
                'status' => $this->data['status']
            ]);
            session()->flash('message', [
                 'type' => 'success',
                 'title' => 'Sucesso',
                 'text' => 'Tabela '. $column->name_column .' Coluna Salvo com sucesso.'
            ]);
        } catch (\Exception $ex) {
            session()->flash('message', [
                'type' => 'warning',
                'title' => 'Erro',
                'text' => $ex->getMessage()
            ]);
            return redirect()->route('pages.tablecolumn');
        }

        return redirect()->route('pages.tablecolumn');
    }

    public function update()
    {
        try {
            $exists = Column::where('name_table', $this->data['name_table'])
                ->where('name_column', $this->data['name_column'])
                ->where('id', '!=', $this->data['id'])
                ->exists();

            if ($exists) {
                session()->flash('message', [
                    'type' => 'warning',
                    'title' => 'Erro',
                    'text' => 'A combinação de Tabela e Coluna já existe no banco de dados.'
                ]);
                return;
            }

            $column = Column::find($this->data['id']);
            $column->update([
                'name_table' => $this->data['name_table'],
                'name_column' => $this->data['name_column'],
                'status' => $this->data['status']
            ]);
            session()->flash('message', [
                'type' => 'success',
                'title' => 'Sucesso',
                'text' => 'Tabela '. $column->name_column .' Coluna Salvo com sucesso.'
            ]);
        } catch (\Exception $ex) {
            session()->flash('message', [
                'type' => 'warning',
                'title' => 'Erro',
                'text' => $ex->getMessage()
            ]);
            return redirect()->route('pages.tablecolumn');
        }

        return redirect()->route('pages.tablecolumn');
    }

    public function delete($id)
    {
        $column = Column::find($id);
        $this->data['id'] = $column->id;
        $this->showModalDelete = true;
    }

    public function destroy()
    {
        try{
            DB::beginTransaction();
            $column = Column::find($this->data['id']);
            Column::where('id', $this->data['id'])->delete();
            DB::commit();
            $this->showModalDelete = false;
            session()->flash('message', [
                'type' => 'success',
                'title' => 'Sucesso',
                'text' => 'Tabela Coluna '. $column->name_column .' Excluído com sucesso.'
            ]);
            return redirect()->route('pages.tablecolumn');
        } catch (\Exception $ex) {
            DB::rollback();
            session()->flash('message', [
                'type' => 'warning',
                'title' => 'Erro',
                'text' => $ex->getMessage()
            ]);
            return redirect()->route('pages.tablecolumn');
        }
    }
}
