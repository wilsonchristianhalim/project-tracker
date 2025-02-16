<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/projects', \App\Http\Controllers\ProjectController::class);
Route::resource('/tasks', \App\Http\Controllers\TaskController::class);
Route::get('/tasks/create/{project?}', [TaskController::class, 'create'])->name('tasks.create');