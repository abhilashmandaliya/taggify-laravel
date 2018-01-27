<?php

namespace AbhilashMandaliya\GCPVisionAPI;

use Illuminate\Support\ServiceProvider;

class GCPVisionAPIServiceProvider extends ServiceProvider
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
        include __DIR__.'/routes.php';
        $this->app->make('AbhilashMandaliya\GCPVisionAPI\ImageLabelController');
    }
}
