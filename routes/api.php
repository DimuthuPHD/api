<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ConsultantController;
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

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('consultants', [ConsultantController::class, 'index']);
    Route::get('consultants/{consultant}', [ConsultantController::class, 'show']);
});
