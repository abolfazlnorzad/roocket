<?php

namespace Nrz\User\Http\Controllers\Auth\V1;

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Hash;
use Nrz\User\Database\Repo\UserRepo;
use Nrz\User\Http\Requests\V1\LoginRequest;
use Nrz\User\Http\Resources\V1\UserResource;

class LoginController extends ApiController
{
    public function login(LoginRequest $request, UserRepo $userRepo)
    {
        $user = $userRepo->findUserByEmail($request->email);

        if (!$user or !Hash::check($request->password, $user->password)) {
            return $this->errorResponse("The information entered does not match our information", 401);
        }

        return $this->successResponse([
            'user' => new UserResource($user),
            'token' => $user->createToken('token-for-user-' . $user->id)->plainTextToken
        ], 200, "successful");
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->successResponse(null, 200, "logout was successfully !");
    }
}
