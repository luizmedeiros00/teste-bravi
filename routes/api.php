<?php

use App\Http\Controllers\PersonController;
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

Route::controller(PersonController::class)
    ->name('person.')
    ->prefix('person')
    ->group(function() {
        Route::post('/', 'store')->name('store');
        Route::put('{person}', 'update')->name('update');
        Route::delete('{person}', 'destroy')->name('destroy');
        Route::get('{person}', 'show')->name('show');
        Route::get('/', 'index')->name('index');
    });
