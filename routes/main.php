<?php

use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\TestingController;
// use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UpdateProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes(['verify'=>true]);

Route::get('/edit_profile', [UpdateProfileController::class, 'index'])->name('edit_profile')->middleware('auth');
Route::post('/edit_profile', [UpdateProfileController::class, 'update'])->name('submit_edit')->middleware('auth');



// Route::get('/login/google/redirect', [AccountController::class, 'googleLoginRedirect'])->name('googleLogin');
// Route::get('/login/google/callback', [AccountController::class, 'googleCallback'])->name('googleCallback');

// Route::get('/registration', [AccountController::class, 'registration']);
// Route::post('/registration', [AccountController::class, 'store']);
// Route::get('/login', [AccountController::class, 'login']);
// Route::post('/login', [AccountController::class, 'authenticate']);
