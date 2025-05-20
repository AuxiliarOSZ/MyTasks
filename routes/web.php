<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Home
    Route::get('/tasks', function () {
        return view('tasks.index');
    })->name('tasks.index');

    // Rutas para tareas
    Route::controller(TaskController::class)->group(function () {
        Route::get('/tasks', 'index')->name('tasks.index');
        Route::get('/tasks/create', 'create')->name('tasks.create');
        Route::post('/tasks', 'store')->name('tasks.store');        
        Route::get('/tasks/{task}', 'show')->name('tasks.show');    
        Route::get('/tasks/{task}/edit', 'edit')->name('tasks.edit'); 
        Route::put('/tasks/{task}', 'update')->name('tasks.update'); 
        Route::delete('/tasks/{task}', 'destroy')->name('tasks.destroy');
    });

    // Rutas para proyectos
    Route::controller(ProjectController::class)->group(function () {
        Route::get('/projects', 'index')->name('projects.index');        
        Route::get('/projects/create', 'create')->name('projects.create'); 
        Route::post('/projects', 'store')->name('projects.store');        
        Route::get('/projects/{project}', 'show')->name('projects.show');    
        Route::get('/projects/{project}/edit', 'edit')->name('projects.edit'); 
        Route::put('/projects/{project}', 'update')->name('projects.update'); 
        Route::delete('/projects/{project}', 'destroy')->name('projects.destroy');
    });

    // Rutas para etiquetas
    Route::controller(TagController::class)->group(function () {
        Route::get('/tags', 'index')->name('tags.index');        
        Route::get('/tags/create', 'create')->name('tags.create'); 
        Route::post('/tags', 'store')->name('tags.store');        
        Route::get('/tags/{tag}', 'show')->name('tags.show');    
        Route::get('/tags/{tag}/edit', 'edit')->name('tags.edit'); 
        Route::put('/tags/{tag}', 'update')->name('tags.update'); 
        Route::delete('/tags/{tag}', 'destroy')->name('tags.destroy');
    });
});
