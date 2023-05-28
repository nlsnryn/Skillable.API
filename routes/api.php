<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SkillsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

route::group(['prefix' => 'v1'], function() {
    route::apiResource('skills', SkillsController::class)->middleware('auth:sanctum');

    route::post('/login', [AuthController::class, 'login']);
    route::post('/register', [AuthController::class, 'register']);
    route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});


