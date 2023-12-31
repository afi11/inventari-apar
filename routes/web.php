<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\ViewController::class, 'index']);

Route::prefix('apar')->group(function () {
    Route::get('/', [App\Http\Controllers\ViewController::class, 'index']);
    Route::get('/create', [App\Http\Controllers\ViewController::class, 'create']);
    Route::get('/detail/{id}', [App\Http\Controllers\ViewController::class, 'detail']);

    Route::get('/datatable', [App\Http\Controllers\CRUDController::class, 'getDataTable']);
    Route::post('/store', [App\Http\Controllers\CRUDController::class, 'store']);
    Route::put('/update/{id}', [App\Http\Controllers\CRUDController::class, 'update']);
    Route::delete('/delete/{id}', [App\Http\Controllers\CRUDController::class, 'delete']);
});
