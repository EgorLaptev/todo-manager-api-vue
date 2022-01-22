<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;

Route::prefix('users')->group(function () {

    Route::get('', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('', [UserController::class, 'store']);
    Route::delete('/{id}', [UserController::class, 'destroy']);

});

Route::prefix('todos')->group(function () {

    Route::get('', [TodoController::class, 'index']);
    Route::get('/{id}', [TodoController::class, 'show']);
    Route::post('', [TodoController::class, 'store']);
    Route::delete('/{id}', [TodoController::class, 'destroy']);
    Route::patch('/{id}', [TodoController::class, 'update']);

});
