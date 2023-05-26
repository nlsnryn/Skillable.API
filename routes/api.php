<?php

use App\Http\Controllers\Api\V1\SkillsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

route::group(['prefix' => 'v1'], function() {
    route::apiResource('skills', SkillsController::class);
});
