<?php

namespace Nrz\User\Http\Controllers\Auth\V1;

use App\Http\Controllers\ApiController;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Nrz\User\Http\Requests\V1\ResetPasswordRequest;


class ForgotPassword extends ApiController
{
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return $this->successResponse(null, 200, __($status));
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            $this->updatePassword($request)
        );

        if ($status == Password::PASSWORD_RESET) {
            return $this->successResponse(null, 200, 'Password reset successfully');
        }

        return $this->errorResponse(__($status), 500);
    }

    /**
     * @param Request $request
     * @return \Closure
     */
    protected function updatePassword(Request $request): \Closure
    {
        return function ($user) use ($request) {
            $user->forceFill([
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(60),
            ])->save();

            $user->tokens()->delete();

            event(new PasswordReset($user));
        };
    }
}
