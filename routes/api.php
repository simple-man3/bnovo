<?php

use App\Http\ApiV1\Controllers\GuestController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/guest', [GuestController::class, 'create']);
});
