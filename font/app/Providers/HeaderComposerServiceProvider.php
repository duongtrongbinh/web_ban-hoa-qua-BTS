<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class HeaderComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('layouts.master', function ($view) {
            $idUser = session()->get('user');
            if(isset($idUser)){
                $view->with('idUser', $idUser);
            }else{
                $view->with('idUser', null);
            }
        });
    }
}
