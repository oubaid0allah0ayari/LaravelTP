<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Root — redirect to tasks
Route::get('/', fn() => redirect()->route('tasks.index'));

// Tasks CRUD
Route::get('/tasks',                [TaskController::class, 'index'])->name('tasks.index');
Route::get('/tasks/create',         [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks',               [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{id}',           [TaskController::class, 'show'])->name('tasks.show');
Route::get('/tasks/{id}/edit',      [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{id}',           [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{id}',        [TaskController::class, 'destroy'])->name('tasks.destroy');

// Clients CRUD
Route::get('/clients',              [ClientController::class, 'index'])->name('clients.index');
Route::get('/clients/create',       [ClientController::class, 'create'])->name('clients.create');
Route::post('/clients',             [ClientController::class, 'store'])->name('clients.store');
Route::get('/clients/{id}',         [ClientController::class, 'show'])->name('clients.show');
Route::get('/clients/{id}/edit',    [ClientController::class, 'edit'])->name('clients.edit');
Route::put('/clients/{id}',         [ClientController::class, 'update'])->name('clients.update');
Route::delete('/clients/{id}',      [ClientController::class, 'destroy'])->name('clients.destroy');
