<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

//Integrated login
Route::get('/registration', [AccountController::class, 'registration'])->name('regist_trial')->middleware('guest');
Route::get('/login', [AccountController::class, 'login'])->name('login_trial')->middleware('guest');


Route::post('/registration', [AccountController::class, 'store']);
Route::post('/login/post', [AccountController::class, 'authenticate']);


//Google login
Route::get('/login/google/redirect', [AccountController::class, 'googleLoginRedirect'])->name('googleLogin')->middleware('guest');
Route::get('/login/google/callback', [AccountController::class, 'googleCallback'])->name('googleCallback');


//logout
Route::post('/logout', [AccountController::class, 'logout'])->middleware('auth');


//forgot password
Route::get('/forgot', [AccountController::class, 'forgot_password'])->name('forgot_password_trial')->middleware('guest');
Route::post('/forgot_password', [AccountController::class, 'sendForgetToken'])->name('forgotPassword');


//password reset
Route::get('/login/password_reset/{token}', [AccountController::class, 'resetPasswordForm'])->name('reset.password.form');
Route::post('/login/password_reset/', [AccountController::class, 'resetPasswordControl'])->name('reset.password.control');


//email verification
Route::get('/authenticate/{token}', [AccountController::class, 'emailVerification'])->name('emailVer');
Route::post('/authenticate', [AccountController::class, 'emailVerificationControl'])->name('emailVerControl');


//change password
Route::get('/change/password', [AccountController::class, 'changePasswordIndex'])->name('change_password');
Route::post('/change_password', [AccountController::class, 'changePassword'])
;
?>