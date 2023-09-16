<?php

use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ConsultantController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\JobSeekerController;
use App\Http\Controllers\Api\JobTypeController;
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
Route::get('consultants', [ConsultantController::class, 'index']);
Route::get('consultants/{consultant}', [ConsultantController::class, 'show']);
Route::get('job-types', [JobTypeController::class, 'index']);
Route::get('countries', [CountryController::class, 'index']);

Route::group(['middleware' => ['auth:sanctum', 'ability:job_seekers']], function () {
    Route::post('job-seeker/{job_seeker}/update', [JobSeekerController::class, 'updateProfile']);
});

Route::group(['middleware' => ['auth:sanctum', 'ability:consultants']], function () {
    Route::post('consultant/{consultant}/update', [ConsultantController::class, 'updateProfile']);
    Route::get('my-countries', [ConsultantController::class, 'myCountries']);
    Route::get('my-job-types', [ConsultantController::class, 'myJobTypes']);
});

Route::group(['middleware' => ['auth:sanctum', 'ability:job_seekers,consultants']], function () {
    Route::get('my-appointments', [AppointmentController::class, 'index']);
    Route::get('consultant/{consultant}', [ConsultantController::class, 'show']);
    Route::patch('appointment/store', [AppointmentController::class, 'store']);
    Route::post('appointment/{appointment}/update', [AppointmentController::class, 'update']);
    Route::get('appointment/{appointment}', [AppointmentController::class, 'show']);
    Route::get('get-available-slots', [AppointmentController::class, 'availableSlots']);
    Route::get('job-seekers', [JobSeekerController::class, 'list']);
    Route::get('logout', [AuthController::class, 'logout']);
});
