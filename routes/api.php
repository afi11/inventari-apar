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

Route::prefix('apar')->group(function () {
    Route::get('/datatable', [App\Http\Controllers\CRUDController::class, 'getDataTable']);
    Route::post('/store', [App\Http\Controllers\CRUDController::class, 'store']);
    Route::put('/update/{id}', [App\Http\Controllers\CRUDController::class, 'update']);
    Route::delete('/delete/{id}', [App\Http\Controllers\CRUDController::class, 'delete']);
});

