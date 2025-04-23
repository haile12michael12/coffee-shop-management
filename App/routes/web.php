<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\GoogleController; 
 
// Authentication Routes
Route::prefix('auth')->group(function () {
    Route::get('/register', function () {
        return Auth::check() ? redirect()->route('taskManagement.index') : view('auth.register');
    })->name('register');

    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', function () {
        return Auth::check() ? redirect()->route('taskManagement.index') : view('auth.login');
    })->name('login');

    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Google Authentication
    Route::get('/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('/google/callback', [GoogleController::class, 'handleGoogleCallback']);
});

// Task Management Routes (Requires Authentication)
Route::middleware('auth')->prefix('taskManagement')->name('taskManagement.')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('index');
    Route::post('/DateRange', [TaskController::class, 'DateRange'])->name('DateRange');

    // Task CRUD Operations
    Route::get('/task', [TaskController::class, 'create'])->name('create');
    Route::post('/task', [TaskController::class, 'create']);
    Route::post('/store', [TaskController::class, 'store'])->name('store');
    Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('editTask');
    Route::patch('/{task}', [TaskController::class, 'update'])->name('updateTask');
    Route::delete('/{task}', [TaskController::class, 'destroy'])->name('destroy');
});
 
Route::fallback(function () {
    return response()->view('components.errors.404', [], 404);
});