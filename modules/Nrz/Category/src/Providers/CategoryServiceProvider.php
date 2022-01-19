<?php

namespace Nrz\Category\Providers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Nrz\Category\Database\Seeder\CategoryTableSeeder;

class CategoryServiceProvider extends ServiceProvider
{
    protected $namespace = 'Nrz\Category\Http\Controllers';

    public function register()
    {
        Route::middleware('api')
            ->prefix("api")
//            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/category_routes.php');
        $this->loadMigrationsFrom(__DIR__ . "/../Database/Migrations");
        DatabaseSeeder::$seeders[] = CategoryTableSeeder::class;
    }

    public function boot()
    {

    }

}
