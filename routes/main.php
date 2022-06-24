<?php

use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\TestingController;
// use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UpdateProfileController;
use App\Http\Controllers\FeatureController;

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

// Route::get('/edit_profile', [UpdateProfileController::class, 'index'])->name('edit_profile')->middleware('auth');
Route::post('/edit_profile', [UpdateProfileController::class, 'update'])->name('submit_edit')->middleware('auth');
// Route::get('/homePage', [UpdateProfileController::class, 'landingPage'])->middleware('auth');

Route::get('/result', [FeatureController::class, 'query'])->name('getTableResult');

Route::post('/loadmore', [FeatureController::class, 'load_data'])->name('loadmore.load_data');
Route::post('/loadmoreNames', [FeatureController::class, 'load_names'])->name('loadmore.load_names');

// Route::get('/payPal', function() {
//     return view('feature.payPal', ['title' => 'PayPal Testing']);
// })->middleware('auth');
// Route::get('/payPal', [FeatureController::class, 'index'])->middleware('auth');
Route::post('/payPal', [FeatureController::class, 'payPalPayment'])->name('payPal.post')->middleware('auth');


//Profile editing
Route::get('/profile', [UpdateProfileController::class, 'profile_page'])->name('profile_page_trial')->middleware('auth');
Route::get('/profile/edit', [UpdateProfileController::class, 'change_profile'])->name('change_page_trial')->middleware('auth');


//About us
Route::get('/about', [FeatureController::class, 'about'])->name('about');






// Route::get('/login/google/redirect', [AccountController::class, 'googleLoginRedirect'])->name('googleLogin');
// Route::get('/login/google/callback', [AccountController::class, 'googleCallback'])->name('googleCallback');

// Route::get('/registration', [AccountController::class, 'registration']);
// Route::post('/registration', [AccountController::class, 'store']);
// Route::get('/login', [AccountController::class, 'login']);
// Route::post('/login', [AccountController::class, 'authenticate']);
