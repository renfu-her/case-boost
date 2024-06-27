<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ProjectCategoryController;

Route::apiResource('projects', ProjectController::class);
Route::get('/projects/{slug}', [ProjectController::class, 'showBySlug']);
Route::get('/project-categories', [ProjectCategoryController::class, 'index']);

Route::group(['middleware' => ['guest']], function () {
    Route::post('/login', [AuthController::class, 'login']);
});
