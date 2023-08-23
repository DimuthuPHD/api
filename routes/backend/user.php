<?php

use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:web', 'is_active', 'role:admin']], function () {
    Route::resource('user', UserController::class)->except(['show', 'destroy']);
});

Route::get('user/profile', [ProfileController::class, 'index'])->name('user.profile');
Route::post('user/profile/{user}/update', [ProfileController::class, 'update'])->name('user.profile.update');
