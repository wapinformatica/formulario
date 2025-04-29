<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\Traints\CheckPermission;

class PanelController extends Controller
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
    public function index()
    {
        return view('panel');
    }

    public function registrationlist()
    {
        $this->checkPermission('registrationlist_view');
        return view('pages.registrationlist.index');
    }
    
    public function error404()
    {
        return view('error404');
    }
}
