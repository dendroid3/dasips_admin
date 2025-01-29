<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'properties'], function(){
    Route::get('/get',  [App\Http\Controllers\Api\PropertiesController::class, 'get']);
});

