<?php

use App\Http\Controllers\Api\Admin\BookController;
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

Route::group(['prefix' => 'admin'], function (){
    Route::apiResource('books', BookController::class);
});

Route::get('search', [\App\Http\Controllers\Api\BookController::class, 'search']);
Route::get('filters', [\App\Http\Controllers\Api\BookController::class, 'getFilters']);
