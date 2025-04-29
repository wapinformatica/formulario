<?php

namespace App\Http\Livewire\Config;

use App\Models\Menu;
use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Spatie\Permission\Models\Permission;

class MenuSide extends Component
{
    public $Modelmenu;
    public $menuFinal = [];
    public $dataMenu = [];
    public $permissao = [];
    public $menu_id;
    public $menu_name;

    public function render()
    {
        return view('livewire.config.menu-side');
    }

    public function mount()
    {
        $this->menuFinal = [];
        $this->Modelmenu = $this->allMenus();
        $this->construirMenu($this->Modelmenu, $this->menuFinal, null);
        $this->dataMenu = $this->menuFinal;
    }

    function construirMenu(array $menus, array &$menuFinal, $menuSuperiorId, $nivel = 0)
    {
       try{
            foreach ($menus as $menu) {
                if ($menu->menu_id_superior == $menuSuperiorId) {
                    $menuFinal[] = [
                        "id" => $menu->id,
                        "menu_id_superior" => $menu->menu_id_superior,
                        "name" => $menu->name_menu,
                        "permission" => $menu->permission,
                        "route" => $menu->route,
                        "icon" => $menu->icon,
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

    public function allMenus(){
        $query = DB::select("SELECT
            menus.id,
            menus.name as name_menu,
            menus.menu_id_superior,
            menus.route,
            menus.icon,
            permissions.name as permission
            FROM menus
            INNER JOIN permissions ON(permissions.menu_id = menus.id and permissions.view = true)");
        return $query;
    }
}
