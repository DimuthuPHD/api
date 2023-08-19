<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:web', 'is_active', 'role:admin']], function () {
    Route::resource('user', UserController::class)->except(['show', 'destroy']);
});
