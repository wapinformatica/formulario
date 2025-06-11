<?php

namespace App\Http\Livewire\Administrativo\Usuario;

use App\Models\ModelHasRole;
use App\Models\Pessoa;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $title = 'Cadastro de Usuarios';
    public $pages = 'Usuários';
    public $search = '';
    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public $selected = [];
    public $showModalCreateUpdate = false;
    public $showModalCreatePessoa = false;
    public $showModalDelete = false;
    public $user_id;
    public $message;
    public $roles;
    public $pessoas;
    public $data = [
        'name' => '',
        'email' => '',
        'password' => '',
        'role_id' => '',
        'password_confirmation' => '',
        'Pes_ID' => '',
    ];

    public function render()
    {
        if($this->data['Pes_ID'] != ''){
            $pessoa = Pessoa::find($this->data['Pes_ID']);
            $this->data['name'] = $pessoa->Nome;
            $this->data['email'] = $pessoa->e_mail;
        }
        return view('livewire.administrativo.usuario.index',[
            'users' => User::queryFilter($this->search, $this->perPage)
        ]);
    }

    public function mount()
    {
        $this->roles = Role::all();
        $this->pessoas = Pessoa::all();
    }

    public function storeUpdate()
    {
        if($this->user_id){
            $this->update();
        } else {
            $this->store();
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        $this->user_id  = $user->id;
        $this->data['name'] = $user->name;
        $this->data['email'] = $user->email;
        $this->data['role_id'] = $user->role_id;
        $this->showModalCreateUpdate = true;
    }

    public function create()
    {
        $this->user_id = null;
        $this->data['name'] = '';
        $this->data['email'] = '';
        $this->data['password'] = '';
        $this->data['password_confirmation'] = '';
        $this->data['role_id'] = '';
        $this->showModalCreatePessoa = true;
    }

    public function store()
    {
        if(!$this->validateUser()){
            return session()->flash('danger', $this->message);
        }
        $role = Role::find($this->data['role_id']);
        $pessoa = Pessoa::where('Pes_ID', $this->data['Pes_ID'])->first();
        $user = User::create([
            'name' => $pessoa->Nome,
            'email' => $pessoa->e_mail,
            'password' => Hash::make($this->data['password']),
            'role_id' => $this->data['role_id']
        ]);
        $user->assignRole($role->name);
        session()->flash('message', [
             'type' => 'success',
             'title' => 'Sucesso',
             'text' => 'Usuário Salvo com sucesso.'
        ]);
        return redirect()->route('pages.usuarios');
    }

    public function update()
    {
        $id = $this->user_id;
        $user = User::find($id);
        $role = Role::find($this->data['role_id']);
        if($this->data['password'] != ''){
            if(!$this->validateUser()){
                return session()->flash('danger', $this->message);
            }
            $password = Hash::make($this->data['password']);
        } else {
            $password = $user->password;
        }
        $user_role_id = $user->role_id;
        $userUpdate = $user->update([
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'password' => $password,
            'role_id' => $this->data['role_id'],
        ]);

        if($user_role_id != $this->data['role_id']){
            ModelHasRole::where('model_id', $user->id)->delete();
            $user->assignRole($role->name);
        }

        session()->flash('message', [
             'type' => 'success',
             'title' => 'Sucesso',
             'text' => 'Usuário Salvo com sucesso.'
        ]);
        return redirect()->route('pages.usuarios');
    }

    public function validateUser()
    {
        $result = false;
        if( strlen($this->data['password']) < 6 ){
            $this->message = 'Obrigatório informar 6 caracteres na senha.';
        }
        else if($this->data['password'] != $this->data['password_confirmation'])
            $this->message = 'Senha não confere';
        else if ( User::where('email', $this->data['email'])->get()->count() > 0  ){
            $this->message = 'E-mail já cadastrado tente outro e-mail';
        }
        else
            $result = true;
        return $result;
    }

    public function delete($id)
    {
        $user = User::find($id);
        $this->user_id  = $user->id;
        $this->data['first_name'] = $user->first_name;
        $this->showModalDelete = true;
    }

    public function destroy()
    {
        try{
            DB::beginTransaction();
            $user = User::find($this->user_id);
            User::where('id', $this->user_id)->delete();
            DB::commit();
            $this->showModalDelete = false;
            session()->flash('message', [
                'type' => 'success',
                'title' => 'Sucesso',
                'text' => 'Usuário '. $user->name .' Excluído com sucesso.'
            ]);
            return redirect()->route('pages.usuarios');
        } catch (\Exception $ex) {
            DB::rollback();
            session()->flash('message', [
                'type' => 'warning',
                'title' => 'Erro',
                'text' => 'Usuário '. $user->name .' Excluído com sucesso.'
            ]);
            return redirect()->route('pages.usuarios');
        }
    }
}
