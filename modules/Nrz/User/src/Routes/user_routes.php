<?php

use Illuminate\Support\Facades\Route;


Route::middleware('guest:sanctum')->prefix("v1")->group(function () {

    Route::post('logout', [\Nrz\User\Http\Controllers\Auth\V1\LoginController::class, "logout"])
        ->middleware("auth:sanctum")
        ->withoutMiddleware('guest:sanctum')
        ->name("logout");

    Route::post('login', [\Nrz\User\Http\Controllers\Auth\V1\LoginController::class, "login"]);
    Route::post('register', [\Nrz\User\Http\Controllers\Auth\V1\RegisterController::class, "register"]);
    Route::post('forgot-password', [\Nrz\User\Http\Controllers\Auth\V1\ForgotPassword::class, 'forgotPassword']);
    Route::post('reset-password', [\Nrz\User\Http\Controllers\Auth\V1\ForgotPassword::class, 'resetPassword']);

});
