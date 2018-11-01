<?php

namespace GrahamCampbell\BootstrapCMS\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $path = glob(app_path().'/Http/Helpers/*.php');

        foreach ($path as $filename){
            require_once($filename);
        }
    }
}
