<?php

namespace Nrz\User\Providers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Nrz\User\Database\Seeders\UserTableSeeder;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        Route::middleware('api')
            ->prefix("api")
            ->group(__DIR__ . '/../Routes/user_routes.php');
        $this->loadMigrationsFrom(__DIR__ . "/../Database/Migrations/");
        DatabaseSeeder::$seeders[] = UserTableSeeder::class;
    }

    public function boot()
    {

    }

}
