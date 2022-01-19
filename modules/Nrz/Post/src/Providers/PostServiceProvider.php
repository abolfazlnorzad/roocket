<?php

namespace Nrz\Post\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->register(PostEventServiceProvider::class);
        Route::middleware('api')
            ->prefix("api")
            ->group(__DIR__ . '/../Routes/post_routes.php');
        $this->loadMigrationsFrom(__DIR__ . "/../Database/Migrations");
    }

    public function boot()
    {
        Validator::extend('poly_exists', function ($attribute, $value, $parameters, $validator) {
            if (!$type = Arr::get($validator->getData(), $parameters[0], false)) {
                return false;
            }

            if (Relation::getMorphedModel($type)) {
                $type = Relation::getMorphedModel($type);
            }

            if (!class_exists($type)) {
                return false;
            }

            return !empty(resolve($type)->find($value));
        });
    }

}
