<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/properties', [App\Http\Controllers\HomeController::class, 'properties'])->name('properties');
Route::get('/property', [App\Http\Controllers\HomeController::class, 'property'])->name('property');
Route::get('/add-property', [App\Http\Controllers\HomeController::class, 'addProperty'])->name('addProperty');


Route::get('/lands', [App\Http\Controllers\HomeController::class, 'lands'])->name('lands');
Route::get('/land', [App\Http\Controllers\HomeController::class, 'land'])->name('land');
Route::get('/add-land', [App\Http\Controllers\HomeController::class, 'addLand'])->name('addLand');


Route::get('/projects', [App\Http\Controllers\HomeController::class, 'projects'])->name('projects');
Route::get('/project', [App\Http\Controllers\HomeController::class, 'project'])->name('project');
Route::get('/add-project', [App\Http\Controllers\HomeController::class, 'addProject'])->name('addProject');
