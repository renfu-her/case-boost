<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\ProjectCategoryController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\FeedbackController;

// Route::apiResource('projects', ProjectController::class);
Route::group(['prefix' => 'projects', 'as' => 'projects.'], function () {
    Route::get('/', [ProjectController::class, 'index'])->name('index');
    Route::get('/{id}', [ProjectController::class, 'show'])->name('show');
    Route::post('/', [ProjectController::class, 'store'])->name('store');
    Route::post('/{project}', [ProjectController::class, 'update'])->name('update');
    Route::delete('/{project}', [ProjectController::class, 'destroy'])->name('destroy');
});
Route::get('/projects/{slug}', [ProjectController::class, 'showBySlug'])->name('projects.showBySlug');
Route::get('/project-categories', [ProjectCategoryController::class, 'index'])->name('project-categories.index');
Route::get('/project-categories/{slug}', [ProjectCategoryController::class, 'showBySlug'])->name('project-categories.showBySlug');
Route::get('/user/info/{token}', [UserController::class, 'userInfo'])->name('userInfo');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback');

Route::group(['middleware' => ['guest']], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});
