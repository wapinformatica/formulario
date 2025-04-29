<?php

namespace App\Http\Livewire\Administrativo\QuestionForm;

use App\Models\Form;
use App\Models\User;
use App\Models\RoleHasPermission;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $title = 'Cadastro de Formulários';
    public $pages = 'Cadastro';
    public $search = '';
    public $perPage = 25;
    public $sortField = 'id';
    public $sortAsc = true;
    public $namePerfil;
    public $idPerfil;
    public $showModalCreateUpdate = false;
    public $showModalDelete = false;
    public $company;
    public $selected = [];
    public $message;

    public function render()
    {
        return view('livewire.administrativo.question-form.index',[
            'forms' => $this->getList()
        ]);
    }

    public function storeUpdate(){
        if($this->idPerfil){
            $this->update();
        } else {
            $this->store();
        }
    }

    public function create()
    {
        return redirect()->route('pages.question.create');
    }

    public function edit($id)
    {
        return redirect()->route('pages.question.update',['id' => $id]);
    }

    public function getList()
    {
        try{
            $query = Form::where('forms.name', 'like', "%{$this->search}%")->paginate($this->perPage);
        } catch (Exception $ex) {
            return [];
        }
        return $query;
    }

    public function update()
    {
        if($this->namePerfil != ''){
            try{
                $nome = strtolower(str_replace(' ', '', $this->namePerfil));
                $nome = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$nome);
                $newName = $nome;
                $role = Role::where('id', $this->idPerfil)->first();
                if($role->name != $newName){
                    if(!$this->validateProfile($newName)){
                        $this->showModalCreateUpdate = false;
                        return session()->flash('warning', $this->message);
                    }
                }
                DB::beginTransaction();
                Role::where('id', $this->idPerfil)->update([
                    'name' => $newName,
                    'title' => $this->namePerfil,
                    'description' => $this->namePerfil
                ]);
                DB::commit();
                $this->showModalCreateUpdate = false;
                session()->flash('message', [
                    'type' => 'success',
                    'title' => 'Sucesso',
                    'text' => 'Perfil de Acesso atualizado com sucesso.'
                ]);
                return redirect()->route('pages.perfilacesso');
            } catch (\Exception $ex) {
                dd($ex);
                DB::rollback();
                return redirect()->back()->withInput();
            }
        }
    }

    public function store()
    {
        if($this->namePerfil != ''){
            try{
                $nome = strtolower(str_replace(' ', '', $this->namePerfil));
                $nome = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$nome);
                if(!$this->validateProfile($nome)){
                    $this->showModalCreateUpdate = false;
                    return session()->flash('warning', $this->message);
                }
                DB::beginTransaction();
                Role::create([
                    'name' => $nome,
                    'title' => $nome,
                    'description' => $this->namePerfil,
                    'status' => 1,
                ]);
                DB::commit();
                $this->showModalCreateUpdate = false;
                session()->flash('message', [
                    'type' => 'success',
                    'title' => 'Sucesso',
                    'text' => 'Perfil de Acesso salvo com sucesso.'
                ]);
                return redirect()->route('pages.perfilacesso');
            } catch (\Exception $ex) {
                DB::rollback();
                return redirect()->back()->withInput();
            }
        }
    }

    public function destroy()
    {
        if($this->idPerfil != ''){
            try{
                DB::beginTransaction();
                Role::where('id', $this->idPerfil)->delete();
                RoleHasPermission::where('role_id', $this->idPerfil)->delete();
                DB::commit();
                $this->showModalCreateUpdate = false;
                session()->flash('message', [
                    'type' => 'success',
                    'title' => 'Sucesso',
                    'text' => 'Perfil Excluído com sucesso.'
                ]);
                return redirect()->route('pages.perfilacesso');
            } catch (\Exception $ex) {
                DB::rollback();
                return redirect()->back()->withInput();
            }
        }
    }

    public function delete($id)
    {
        $role = Role::find($id);
        $user = User::where('role_id', $role->id)->get();
        if($user->count() > 0){
            return session()->flash('warning', 'Impossivel excluir tem usuário incluído nesse perfil.');
        }
        $this->idPerfil = $role->id;
        $this->namePerfil = $role->description;
        $this->showModalDelete = true;
    }

    public function validateProfile($name)
    {
        $result = false;
        $role = Role::where('name', $name)->get();
        if( $role->count() > 0)
            $this->message = 'Já existe um perfil de acesso com esse nome, impossível continuar...';
        else
            $result = true;

        return $result;
    }

}
