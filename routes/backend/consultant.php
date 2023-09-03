<?php

use App\Http\Controllers\Consultant\ConsultantController;
use Illuminate\Support\Facades\Route;

Route::resource('consultant', ConsultantController::class);
Route::post('consultant/{consultant}/slots', [ConsultantController::class, 'slots'])->name('consultant.slots');
