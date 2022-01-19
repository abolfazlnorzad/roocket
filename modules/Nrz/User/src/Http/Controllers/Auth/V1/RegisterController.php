<?php

namespace Nrz\User\Http\Controllers\Auth\V1;

use App\Http\Controllers\ApiController;
use Nrz\User\Database\Repo\UserRepo;
use Nrz\User\Http\Requests\V1\RegisterRequest;
use Nrz\User\Http\Resources\V1\UserResource;

class RegisterController extends ApiController
{
    public function register(RegisterRequest $request, UserRepo $userRepo)
    {
        $newUser = $userRepo->storeUser($request->all());

        return $this->successResponse([
            'user' => new UserResource($newUser),
            'token' => $newUser->createToken('token-for-user-' . $newUser->id)->plainTextToken
        ], 200, "successful");
    }
}
