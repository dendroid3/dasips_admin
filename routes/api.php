<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'properties'], function(){
    Route::get('/view',  [App\Http\Controllers\Api\PropertiesController::class, 'view']);
    Route::get('/get',  [App\Http\Controllers\Api\PropertiesController::class, 'get']);
    Route::post('/create',  [App\Http\Controllers\Api\PropertiesController::class, 'create']);
    Route::delete('/delete',  [App\Http\Controllers\Api\PropertiesController::class, 'delete']);

    Route::get('/types_and_locations',  [App\Http\Controllers\Api\PropertiesController::class, 'types_and_locations']);
});

Route::group(['prefix' => 'land'], function(){
    Route::get('/view',  [App\Http\Controllers\Api\LandController::class, 'view']);
    Route::get('/get',  [App\Http\Controllers\Api\LandController::class, 'get']);
    Route::post('/create',  [App\Http\Controllers\Api\LandController::class, 'create']);
    Route::delete('/delete',  [App\Http\Controllers\Api\LandController::class, 'delete']);

});

Route::group(['prefix' => 'projects'], function(){
    Route::get('/view',  [App\Http\Controllers\Api\ProjectController::class, 'view']);
    Route::get('/get',  [App\Http\Controllers\Api\ProjectController::class, 'get']);
    Route::post('/create',  [App\Http\Controllers\Api\ProjectController::class, 'create']);
    Route::delete('/delete',  [App\Http\Controllers\Api\ProjectController::class, 'delete']);
});


Route::group(['prefix' => 'statistics'], function(){
    Route::get('/property',  [App\Http\Controllers\Api\StatisticsController::class, 'property']);
    Route::get('/land',  [App\Http\Controllers\Api\StatisticsController::class, 'land']);
    Route::get('/project',  [App\Http\Controllers\Api\StatisticsController::class, 'project']);
});
