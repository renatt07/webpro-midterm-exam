<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
})->middleware('guest')->name('welcome');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');

    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

    Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');

    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::delete('/tasks-clear-completed', [TaskController::class, 'destroyCompleted'])->name('tasks.destroyCompleted');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
