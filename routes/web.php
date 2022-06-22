<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TestingController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\FeatureController;
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

// Route::get('/', function() {return view('landing', ['title'=>'Landing Page']);})->middleware('guest');
// Route::get('/', function() {return view('landing', ['title'=>'Landing Page']);})->middleware('guest');
Route::get('/', [FeatureController::class, 'init_page'])->name('init')->middleware('guest');
// // Route::get('/', function() {return view('landing', ['title'=>'Landing Page']);})->middleware('guest');
// Route::get('/', function() {
//     return view('testing.landing', ['title'=>'Landing Page']);
// })->middleware('guest');

Route::get('/testing', [TestingController::class, 'index'])->middleware('auth');

Route::get('/landingTesting', function() {
    return view('testing.landing');
})->name('landing_testing');







// Route::get('/login/google/redirect', [AccountController::class, 'googleLoginRedirect'])->name('googleLogin');
// Route::get('/login/google/callback', [AccountController::class, 'googleCallback'])->name('googleCallback');

// Route::get('/registration', [AccountController::class, 'registration']);
// Route::post('/registration', [AccountController::class, 'store']);
// Route::get('/login', [AccountController::class, 'login']);
// Route::post('/login', [AccountController::class, 'authenticate']);
