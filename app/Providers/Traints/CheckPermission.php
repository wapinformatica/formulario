<?php

namespace App\Providers\Traints;

use Illuminate\Support\Facades\Gate;

trait CheckPermission
{
    protected function checkPermission($permission)
    {
        if (app()->runningUnitTests()) {
            return;
        }
        if(app()->runningInConsole()){
            return;
        }
        if (Gate::denies($permission)) {
            header('location:'.url('/errors/error404').'');
            exit();
        }
    }
    /**
     * @param  type   
     * @return bool
     */
    protected function checkPermissionRule($permission)
    {
        if (app()->runningUnitTests()) {
            return;
        }
        if (app()->runningInConsole()) {
            return;
        }
        if (! Gate::denies($permission)) {
            return true;
        }
    }
}
