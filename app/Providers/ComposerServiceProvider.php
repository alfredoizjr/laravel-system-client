<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
       //pasar solo al partial
        //View::composer('layouts.nav','App\Http\ViewComposers\StatsComposer');
        //podemos pasar a mas de una Vista
        //View::composer('layouts.nav','otra.vista','App\Http\ViewComposers\StatsComposer');
        View::composers([
              'App\Http\ViewComposers\StatsComposer' => 'layouts.nav'
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
