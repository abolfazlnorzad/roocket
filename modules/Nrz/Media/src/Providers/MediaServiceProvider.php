<?php

namespace Nrz\Media\Providers;

use Illuminate\Support\Facades\Route;

class MediaServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $namespace = 'Nrz\Media\Http\Controllers';
    public function register()
    {
        Route::middleware('api')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/media_routes.php');
        $this->loadMigrationsFrom(__DIR__."/../Database/Migration");
        $this->mergeConfigFrom(__DIR__ . "/../Config/mediaFile.php", 'mediaFile');
    }

    public function boot()
    {

    }

}
