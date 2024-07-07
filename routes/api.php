<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\ProjectCategoryController;
use App\Http\Controllers\API\UserController;

Route::apiResource('projects', ProjectController::class);
Route::get('/projects/{slug}', [ProjectController::class, 'showBySlug']);
Route::get('/project-categories', [ProjectCategoryController::class, 'index']);
Route::get('/project-categories/{slug}', [ProjectCategoryController::class, 'showBySlug']);
Route::get('/userInfo/{token}', [UserController::class, 'userInfo']);

Route::group(['middleware' => ['guest']], function () {
    Route::post('/login', [AuthController::class, 'login']);
});
