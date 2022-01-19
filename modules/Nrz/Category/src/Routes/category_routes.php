<?php

use Illuminate\Support\Facades\Route;
use Nrz\Category\Http\Controllers\V1\CategoryController;


Route::apiResource('v1/category', CategoryController::class);
