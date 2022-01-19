<?php

namespace Nrz\User\Database\Repo;

use Nrz\User\Models\User;

class UserRepo
{

    protected function getQuery()
    {
        return User::query();
    }

    public function storeUser($data)
    {
        return $this->getQuery()->create([
            "name" => $data["name"],
            "email" => $data["email"],
            "password" => bcrypt($data["password"])
        ]);
    }

    public function findUserByEmail($userEmail)
    {
        return $this->getQuery()->where("email", $userEmail)->firstOrFail();
    }

}
