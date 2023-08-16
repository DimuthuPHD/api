<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make someth    ing great!
|
*/

Route::get('/', [LoginController::class, 'showLoginForm'])->name('loginView');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logOut', [LoginController::class, 'logOut'])->name('logOut');


Route::group(['middleware' => ['auth:web']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
