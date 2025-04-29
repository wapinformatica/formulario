<?php

namespace App\Http\Livewire\Administrativo\PerfilAcesso;

use Exception;
use Livewire\Component;
use App\Models\Menu;
use App\Models\RoleHasPermission;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class PermissionProfile extends Component
{
    public $title = 'Incluir Permissões em ';
    public $pages = 'Permissões';
    public $role_id ;
    public $role = [];
    public $name_permission;
    public $Modelmenu;
    public $menuFinal = [];
    public $dataMenu = [];
    public $permissions = [];
    public  $selected = [];
    public $menu_id;
    public $menu_name;
    public $multiSelected = false;
    public $count = 0;
    protected $listeners = ['postAdded' => 'updateMenu'];

    public function render()
    {
        return view('livewire.administrativo.perfil-acesso.permission-profile');
    }

    public function salve(){
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        foreach($this->permissions as $permission){
            RoleHasPermission::where('permission_id', $permission->id)->where('role_id', $this->role_id)->delete();
        }
        foreach($this->selected  as $value){
            RoleHasPermission::create([
               'permission_id' => $value,
               'role_id' => $this->role_id
            ]);
        }
        session()->flash('success', 'Salvo com sucesso');
        //return redirect()->route('admin.permission', ['permission' => $this->role_id]);
    }

    public function mount()
    {
        $this->role = Role::find($this->role_id);
        $this->name_permission = $this->role->description;
        $this->title = $this->title . $this->role->description;
        $this->menuFinal = [];
        $this->Modelmenu = DB::select("SELECT * FROM menus");
        $this->construirMenu($this->Modelmenu, $this->menuFinal, null);
        $this->dataMenu = $this->menuFinal;
    }

    function construirMenu(array $menus, array &$menuFinal, $menuSuperiorId, $nivel = 0)
    {
       try{
            $this->count++;
            foreach ($menus as $menu) {
                if ($menu->menu_id_superior == $menuSuperiorId) {
                    $menuFinal[] = [
                        "id" => $menu->id,
                        "text" => $menu->name,
                        "state" => ["opened" => true ],
                    ];
                }
            }
            $nivel++;
            for ($i = 0; $i < count($menuFinal); $i++)
            {
                $menuFinal[$i]['children'] = [];
                $menuFinal[$i]['nivel'] = $nivel;
                $this->construirMenu($menus, $menuFinal[$i]['children'], $menuFinal[$i]['id'], $nivel);
            }
        } catch (Exception $ex) {

        }
    }

    public function updateMenu($id){
        $menu = Menu::where('id',$id )->first();
        $this->menu_id = $menu->id;
        $this->menu_name = $menu->name;
        $this->multiSelected = false;
        $this->permissions = $this->allQueryPermission();
        $this->selected = $this->allQueryPermission()->where('selected', true)->pluck('id');
    }

    public function allQueryPermission()
    {
        try {
            $role_id = $this->role_id;
            $query = Permission::
                    select([
                        'permissions.id',
                        'permissions.name',
                        'permissions.title',
                        DB::raw("(CASE WHEN role_has_permissions.role_id is not null THEN 1 ELSE 0 END) AS selected")
                    ])
                    ->leftJoin('role_has_permissions',function($join) use($role_id){
                        $join->on('role_has_permissions.permission_id','=','permissions.id')
                        ->where('role_has_permissions.role_id', '=', $role_id);
                    })
                    ->where('permissions.menu_id', $this->menu_id)->get();
        } catch (Exception $ex) {
            return [];
        }
        return (object) $query;
    }

    public function selectPageRows(){
        //$this->multiSelected = !$this->multiSelected;
        if($this->multiSelected)
            $this->selected = $this->allQueryPermission()->pluck('id');
        else
            $this->selected = [];
    }

}
