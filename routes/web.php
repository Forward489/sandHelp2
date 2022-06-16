<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TestingController;
use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/landingPage', function() {return view('landing', ['title'=>'Landing Page']);})->middleware('guest');

Route::get('/testing', [TestingController::class, 'index'])->middleware('auth');



Route::get('/regisTest', function() {
    return view('account.registration2', ['title' => 'SandHelp-Register']);
})->name('regist_trial');
Route::get('/loginTest', function() {
    return view('account.login2', ['title' => 'SandHelp-Login']);
})->name('login_trial');
Route::get('/forgotPassword', function() {
    return view('account.forgot_password_index2', ['title' => 'SandHelp-Login']);
})->name('forgot_password_trial');



// Route::get('/login/google/redirect', [AccountController::class, 'googleLoginRedirect'])->name('googleLogin');
// Route::get('/login/google/callback', [AccountController::class, 'googleCallback'])->name('googleCallback');

// Route::get('/registration', [AccountController::class, 'registration']);
// Route::post('/registration', [AccountController::class, 'store']);
// Route::get('/login', [AccountController::class, 'login']);
// Route::post('/login', [AccountController::class, 'authenticate']);
