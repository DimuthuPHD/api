<?php

use App\Http\Controllers\Appointment\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::resource('appointment', AppointmentController::class)->except(['show', 'destroy']);
