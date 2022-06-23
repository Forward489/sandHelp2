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

Route::get('/', [FeatureController::class, 'init_page'])->name('init')->middleware('guest');

Route::get('/home',[FeatureController::class, 'home'])->name('home_page')->middleware('auth');
