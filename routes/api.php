<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//posts
Route::apiResource('/posts', App\Http\Controllers\Api\PostController::class);
Route::delete('/posts/{id}', 'Api\PostController@destroy');
Route::put('/posts/{id}', 'Api\PostController@update');
