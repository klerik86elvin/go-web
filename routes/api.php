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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('/news')->group(function () {
    Route::get('/',[\App\Http\Controllers\NewsController::class, 'getAll']);
    Route::post('/',[\App\Http\Controllers\NewsController::class, 'store']);
    Route::get('/{id}',[\App\Http\Controllers\NewsController::class, 'get']);
    Route::put('/{id}',[\App\Http\Controllers\NewsController::class, 'edit']);
    Route::delete('/{news}',[\App\Http\Controllers\NewsController::class, 'delete']);
});
Route::prefix('/lang')->group(function (){
    Route::get('/',[\App\Http\Controllers\LanguageController::class, 'getAll']);
    Route::get('/{lang}',[\App\Http\Controllers\LanguageController::class, 'get']);
    Route::post('/',[\App\Http\Controllers\LanguageController::class, 'store']);
    Route::put('/{lang}',[\App\Http\Controllers\LanguageController::class, 'edit']);
    Route::delete('/{lang}',[\App\Http\Controllers\LanguageController::class, 'delete']);
});
