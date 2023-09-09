<?php

use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ConsultantController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\JobSeekerController;
use App\Http\Controllers\Api\JobTypeController;
use App\Services\JobseekerService;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum', 'ability:job_seekers']], function () {
    Route::get('countries', [ConsultantController::class, 'index']);
    Route::get('consultants', [ConsultantController::class, 'index']);
    Route::get('consultants/{consultant}', [ConsultantController::class, 'show']);
    Route::get('countries', [CountryController::class, 'index']);
    Route::get('countries/{country}', [CountryController::class, 'show']);
    Route::get('job-types', [JobTypeController::class, 'index']);
    Route::get('job-types/{jobType}', [JobTypeController::class, 'show']);
    Route::post('job-seeker/{job_seeker}/update', [JobSeekerController::class, 'updateProfile']);
});

Route::group(['middleware' => ['auth:sanctum', 'ability:consultants']], function () {
});

Route::group(['middleware' => ['auth:sanctum', 'ability:job_seekers,consultants']], function () {
    Route::get('my-appointments', [AppointmentController::class, 'index']);
    Route::post('get-available-slots', [AppointmentController::class, 'availableSlots']);
    Route::get('logout', [AuthController::class, 'logout']);
});
