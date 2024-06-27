<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\AuthController;

Route::apiResource('projects', ProjectController::class);

Route::group(['middleware' => ['guest']], function () {
    Route::post('/login', [AuthController::class, 'login']);
});

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
