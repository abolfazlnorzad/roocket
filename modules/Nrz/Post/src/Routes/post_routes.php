<?php

use Illuminate\Support\Facades\Route;
use Nrz\Post\Http\Controllers\V1\LikeController;
use Nrz\Post\Http\Controllers\V1\PostController;


Route::prefix("v1")->group(function () {
    //post routes
    Route::apiResource("post", PostController::class);

// like route
    Route::post("like-post", [LikeController::class, "checkUserLikedPost"])
        ->middleware("auth:sanctum");

//cm routes
    Route::post("send-comment", [\Nrz\Post\Http\Controllers\V1\CommentController::class, "storeComment"])
        ->middleware("auth:sanctum");
});
