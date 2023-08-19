<?php

use App\Http\Controllers\JobSeeker\JobSeekerController;
use Illuminate\Support\Facades\Route;

Route::resource('job-seeker', JobSeekerController::class)->except(['show', 'destroy']);

