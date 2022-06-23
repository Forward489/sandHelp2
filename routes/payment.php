<?php

use App\Http\Controllers\FeatureController;
use Illuminate\Support\Facades\Route;

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

Route::get('/success', [FeatureController::class, 'payment_success'])->name('payment.success');
Route::get('/failed', [FeatureController::class, 'payment_failed'])->name('payment.failed');
