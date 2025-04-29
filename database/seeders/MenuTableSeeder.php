<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use Spatie\Permission\Models\Permission;

class MenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        /** -------------- Start Menu-------------------- */
        $menu = Menu::create(
            [
                'name' => 'Dashboards',
                'route' => 'dashboards',
                'icon' => 'fas fa-th',
                'status' => 1,
            ]
        );
        Permission::create(
            [
                'name' => 'dashboards_view',
                'menu_id' => $menu->id,
                'title' => 'Acessar Dashboards',
            ]
        );
        /** -------------- End Menu------------------- */
        /** -------------- Start Menu2-------------------- */
        $menu_principal = Menu::create(
            [
                'name' => 'Administrativos',
                'route' => 'dashboards',
                'icon' => 'fas fa-edit',
                'status' => 1,
            ]
        );
        Permission::create(
            [
                'name' => 'administrativas_view',
                'menu_id' =>  $menu_principal->id,
                'title' => 'Acessar Area Administrativa',
            ]
        );
            $menu = Menu::create(
                [
                    'menu_id_superior' => $menu_principal->id,
                    'name' => 'Usuários',
                    'route' => 'pages.usuarios',
                    'icon' => 'far fa-circle',
                    'status' => 1,
                ]
            );
            Permission::create(
                [
                    'name' => 'usuarios_view',
                    'menu_id' => $menu->id,
                    'title' => 'Acessar Usuários',
                ]
            );
            Permission::create(
                [
                    'name' => 'usuarios_edit',
                    'menu_id' => $menu->id,
                    'view' => false,
                    'title' => 'Editar Usuários',
                ]
            );
            Permission::create(
                [
                    'name' => 'usuarios_create',
                    'menu_id' => $menu->id,
                    'view' => false,
                    'title' => 'Criar Usuários',
                ]
            );
            Permission::create(
                [
                    'name' => 'usuarios_delete',
                    'menu_id' => $menu->id,
                    'view' => false,
                    'title' => 'Excluir Usuários',
                ]
            );

            $menu = Menu::create(
                [
                    'menu_id_superior' => $menu_principal->id,
                    'name' => 'Perfil de Acesso',
                    'route' => 'pages.perfilacesso',
                    'icon' => 'far fa-circle',
                    'status' => 1,
                ]
            );
            Permission::create(
                [
                    'name' => 'perfildeacesso_view',
                    'menu_id' => $menu->id,
                    'title' => 'Acessar Perfil de Acesso',
                ]
            );
            Permission::create(
                [
                    'name' => 'perfildeacesso_incluir',
                    'menu_id' => $menu->id,
                    'view' => false,
                    'title' => 'incluir Permissão',
                ]
            );
            Permission::create(
                [
                    'name' => 'perfildeacesso_edit',
                    'menu_id' => $menu->id,
                    'view' => false,
                    'title' => 'Editar Perfil de Acesso',
                ]
            );
            Permission::create(
                [
                    'name' => 'perfildeacesso_create',
                    'menu_id' => $menu->id,
                    'view' => false,
                    'title' => 'Criar Perfil de Acesso',
                ]
            );
            Permission::create(
                [
                    'name' => 'perfildeacesso_delete',
                    'menu_id' => $menu->id,
                    'view' => false,
                    'title' => 'Excluir Perfil de Acesso',
                ]
            );
            $menu = Menu::create(
                [
                    'menu_id_superior' => $menu_principal->id,
                    'name' => 'Formulário de Perguntas',
                    'route' => 'pages.question',
                    'icon' => 'far fa-circle',
                    'status' => 1,
                ]
            );
            Permission::create(
                [
                    'name' => 'questionforms_view',
                    'menu_id' => $menu->id,
                    'title' => 'Acessar Formulário de Perguntas',
                ]
            );
            Permission::create(
                [
                    'name' => 'questionforms_incluir',
                    'menu_id' => $menu->id,
                    'view' => false,
                    'title' => 'incluir Formulário de Perguntas',
                ]
            );
            Permission::create(
                [
                    'name' => 'questionforms_delete',
                    'menu_id' => $menu->id,
                    'view' => false,
                    'title' => 'Excluir Formulário de Perguntas',
                ]
            );
        /** -------------- end Usuario-------------------- */
        /** -------------- Start Menu-------------------- */
        $menu = Menu::create(
            [
                'name' => 'Lista Cadastros',
                'route' => 'registrationlist',
                'icon' => 'fas fa-table',
                'status' => 1,

            ]
        );
        Permission::create(
            [
                'name' => 'registrationlist_view',
                'menu_id' => $menu->id,
                'title' => 'Acessar Lista de Cadastro',
            ]
        );
        Permission::create(
            [
                'name' => 'registrationlist_approval',
                'menu_id' => $menu->id,
                'view' => false,
                'title' => 'Aprovar/Rejeitar Cadastro',
            ]
        );
        Permission::create(
            [
                'name' => 'registrationlist_print',
                'menu_id' => $menu->id,
                'view' => false,
                'title' => 'Imprimir Cadastro',
            ]
        );
        Permission::create(
            [
                'name' => 'registrationlist_change',
                'menu_id' => $menu->id,
                'view' => false,
                'title' => 'Permite Alterar Aprovar/Rejeitar efetuados',
            ]
        );
        /** -------------- End Menu------------------- */
    }
}
