<?php

namespace Database\Seeders\Traints;

use App\Models\User;
use App\Models\UserCompanie;
use Spatie\Permission\Models\Role;

trait RootTableSeeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function rootTableSeeder($user_id)
    {
        /** -------------- Start Permissão-------------------- */
        $roles = [
            [
                'name' => 'administrador',
                'title' => 'administrador',
                'description' => 'Administrador',
                'permissions' => ['dashboards_view',
                                  'administrativas_view',
                                  'usuarios_view',
                                  'usuarios_edit',
                                  'usuarios_create',
                                  'usuarios_delete',
                                  'perfildeacesso_view',
                                  'perfildeacesso_edit',
                                  'perfildeacesso_incluir',
                                  'perfildeacesso_create',
                                  'perfildeacesso_delete',
                                  'tablecolumn_view',
                                  'tablecolumn_edit',
                                  'tablecolumn_create',
                                  'tablecolumn_delete',
                                  'registrationlist_view',
                                  'registrationlist_approval',
                                  'registrationlist_print',
                                  'registrationlist_change',
                                  'questionforms_view',
                                  'questionforms_incluir',
                                  'questionforms_delete']
            ]
        ];

        foreach ($roles as $key => $value) {
            $permission = $value['permissions'];
            unset($value['permissions']);
            $role = Role::create($value);
            $role->givePermissionTo($permission);
            $user = User::find($user_id);
            $user->where('id', $user_id)->update([
                'role_id' => $role->id
            ]);
            $user->assignRole($role->name);
        }

    }

}
