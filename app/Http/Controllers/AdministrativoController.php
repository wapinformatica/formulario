<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\Traints\CheckPermission;

class AdministrativoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    use CheckPermission;
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function usuarios()
    {
        $this->checkPermission('usuarios_view');
        return view('pages.administrativo.usuarios.index');
    }

    public function questions()
    {
        $this->checkPermission('questionforms_view');
        return view('pages.administrativo.question.index');
    }

    public function questionsCreate()
    {
        $this->checkPermission('questionforms_incluir');
        return view('pages.administrativo.question.create');
    }

    public function questionsUpdate($id)
    {
        $this->checkPermission('questionforms_incluir');
        return view('pages.administrativo.question.update',[
            'formId' => $id
        ]);
    }

    public function perfilAcesso()
    {
        $this->checkPermission('usuarios_view');
        return view('pages.administrativo.perfil-acesso.index');
    }

    public function permission($id)
    {
        $this->checkPermission('usuarios_view');
        return view('pages.administrativo.perfil-acesso.permission',[
            'role_id' => $id
        ]);
    }

    public function tableColumn()
    {
        $this->checkPermission('tablecolumn_view');
        return view('pages.administrativo.tablecolumn.index');
    }
}
