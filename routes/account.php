<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

//Integrated login
Route::get('/registration', [AccountController::class, 'registration']);
Route::post('/registration', [AccountController::class, 'store']);

Route::get('/login', [AccountController::class, 'login']);
Route::post('/login/post', [AccountController::class, 'authenticate']);

//Google login
Route::get('/login/google/redirect', [AccountController::class, 'googleLoginRedirect'])->name('googleLogin');
Route::get('/login/google/callback', [AccountController::class, 'googleCallback'])->name('googleCallback');


Route::post('/logout', [AccountController::class, 'logout']);

//forgot password
Route::get('/forgot_password', [AccountController::class, 'forgot_password'])->name('forgotPasswordIndex');
Route::post('/forgot_password', [AccountController::class, 'sendForgetToken'])->name('forgotPassword');

Route::get('/login/password_reset/{token}', [AccountController::class, 'resetPasswordForm'])->name('reset.password.form');
Route::post('/login/password_reset/', [AccountController::class, 'resetPasswordControl'])->name('reset.password.control');

Route::get('/authenticate/{token}', [AccountController::class, 'emailVerification'])->name('emailVer');
Route::post('/authenticate', [AccountController::class, 'emailVerificationControl'])->name('emailVerControl');
?>