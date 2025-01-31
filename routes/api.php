<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'properties'], function(){
    Route::get('/view',  [App\Http\Controllers\Api\PropertiesController::class, 'view']);
    Route::get('/types_and_locations',  [App\Http\Controllers\Api\PropertiesController::class, 'types_and_locations']);
    Route::get('/get',  [App\Http\Controllers\Api\PropertiesController::class, 'get']);
});

