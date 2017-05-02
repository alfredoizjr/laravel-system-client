<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class RequestComposerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      View::composers([
            'App\Http\ViewComposers\RequestComposer' => 'layouts.nav'
            //tabien podemos agregar mas areglo con mas vista aqui
            //App\Http\Myfolder\Myclase' => 'mi vista' o
            //App\Http\Myfolder\Myclase' => ['mi vista1','mi vista 2']
      ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
