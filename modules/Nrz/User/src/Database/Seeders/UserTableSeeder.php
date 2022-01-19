<?php

namespace Nrz\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Nrz\User\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::$defaultUsers as $user) {
            User::query()->firstOrCreate(
                ['email' => $user['email']]
                , [
                "email" => $user['email'],
                "name" => $user['name'],
                "password" => bcrypt($user['password']),
                "is_admin" => $user['isAdmin'] ?? false,
            ]);
        }
    }
}
