<?php

use App\Http\ApiV1\Controllers\GuestController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/guest/{id}', [GuestController::class, 'get']);
    Route::post('/guest', [GuestController::class, 'create']);
    Route::patch('/guest/{id}', [GuestController::class, 'patch']);
    Route::delete('/guest/{id}', [GuestController::class, 'delete']);
})->middleware('api');
