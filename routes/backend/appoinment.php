<?php

use App\Http\Controllers\Appointment\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:web', 'is_active']], function () {
    Route::resource('appointment', AppointmentController::class)->except(['show', 'destroy']);
});
