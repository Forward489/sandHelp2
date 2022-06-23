<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Str;
use DB;
use Illuminate\Support\Facades\Hash;
use Mail;

use function PHPUnit\Framework\isNull;

class AccountController extends Controller
{
    public function login()
    {
        // return view('account.login', ['title' => 'Login Page']);
        return view('testing.account.login', ['title' => 'Login']);
    }

    public function registration()
    {
        return view('testing.account.registration', ['title' => 'Register']);
    }

    public function store(Request $request)
    {
        // dd($request);
        $check_password = User::where('email', $request->email)->first();
        if ($check_password != null) {
            $validate = $request->validate(
                [
                    'name' => 'max:255',
                    'email' => 'required|max:255|email:dns',
                    'password' => 'required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%_]).*$/|confirmed',
                    'password_confirmation' => 'required',
                    'gender' => 'required',
                    'birthdate' => 'required|date_format:Y-m-d',
                    'g-recaptcha-response' => function ($attribute, $value, $fail) {
                        $secretKey = env('GOOGLE_CAPTCHA_SECRET');
                        $response = $value;
                        $userIP = $_SERVER['REMOTE_ADDR'];
                        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$userIP";
                        $response = file_get_contents($url);
                        $response = json_decode($response);
                        // dd($response);
                        if (!$response->success) {
                            return back()->with('google_captcha_error', 'Google Captcha failed to validate !');
                            // $fail($attribute, 'Google Recaptcha failed to validate !');
                        }
                    }
                ],
                ['password.regex' => 'Password must contain minimum of 1 uppercase, 1 number and 1 unique expression (!$#%_) else then . or ,']
            );
            // dd($check_password);
            if ($check_password->password == null) {
                $validate['password'] = bcrypt($validate['password']);
                if ($validate['name'] == "") {
                    User::where('email', $request->email)->update([
                        'password' => $validate['password'],
                        'gender' => $validate['gender'],
                        'birthdate' => $validate['birthdate'],
                        'is_verified' => 1,
                    ]);
                } else {
                    User::where('email', $request->email)->update([
                        'name' => $validate['name'],
                        'password' => $validate['password'],
                        'gender' => $validate['gender'],
                        'birthdate' => $validate['birthdate'],
                        'is_verified' => 1,
                    ]);
                }
                // return redirect('/account/login')->with('success', 'You are now registered in our website !');
                return redirect()->route('login_trial')->with('success', 'You are now registered in our website !');
            } else {
                return back()->with('existing_alert', 'Existing e-mail already used in this site');
            }
            // User::create($validate);
        } else {
            $validate = $request->validate(
                [
                    'name' => 'required|max:255',
                    'email' => 'required|max:255|email:dns|unique:users',
                    'password' => 'required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%_]).*$/|confirmed',
                    'gender' => 'required',
                    'birthdate' => 'required|date_format:Y-m-d',
                    'g-recaptcha-response' => function ($attribute, $value, $fail) {
                        $secretKey = env('GOOGLE_CAPTCHA_SECRET');
                        $response = $value;
                        $userIP = $_SERVER['REMOTE_ADDR'];
                        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$userIP";
                        $response = file_get_contents($url);
                        $response = json_decode($response);
                        // dd($response);
                        if (!$response->success) {
                            return back()->with('google_captcha_error', 'Google Captcha failed to validate !');
                            // $fail($attribute, 'Google Recaptcha failed to validate !');
                        }
                    }
                ],
                ['password.regex' => 'Password must contain minimum of 1 uppercase, 1 number and 1 unique expression (!$#%_) else then . or ,']
            );
            $validate['password'] = bcrypt($validate['password']);

            User::create($validate);

            $this->sendVerifyEmail($request->email);
            // return redirect('/account/login')->with('success', 'You have been registered in our website don\'t forget to verify your e-mail to access our website!');
            return redirect()->route('login_trial')->with('success', 'You have been registered in our website don\'t forget to verify your e-mail to access our website!');
        }
        // return redirect('/auth');
    }



    public function authenticate(Request $request)
    {
        // dd($request);    
        $verified = User::where('email', $request->email)->first();
        $credentials = $request->validate(
            [
                'email' => 'required',
                'password' => 'required',
                'g-recaptcha-response' => function ($attribute, $value, $fail) {
                    $secretKey = env('GOOGLE_CAPTCHA_SECRET');
                    $response = $value;
                    $userIP = $_SERVER['REMOTE_ADDR'];
                    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$userIP";
                    $response = file_get_contents($url);
                    $response = json_decode($response);
                    // dd($response);
                    if (!$response->success) {
                        return back()->with('google_captcha_error', 'Google Captcha failed to validate !');
                        // $fail($attribute, 'Google Recaptcha failed to validate !');
                    }
                },
            ],
            ['password.required' => 'Password must not be empty !']
        );
        // dd($credentials);
        unset($credentials['g-recaptcha-response']);
        // dd($check_if_null);
        // $check_password = User::where('email', $request->email)->first();
        if (!($verified == null)) {
            $is_google = $verified->provider;
            $verified = $verified->is_verified;
            if ($verified) {
                if (Auth::attempt($credentials)) {
                    $request->session()->regenerate();
                    return redirect()->route('init');
                }
                // else {
                //     return back()->with('loginError', 'Login failed !');
                // }
            } elseif ($is_google == 'google') {
                return back()->with("reregister", "You need to re-register your email account on the sign up page with this e-mail or just press Login with Google");
            }
            // else {
            //     return back()->with('email_not_verified', 'Verify your e-mail first to login');
            // }
        }
        // dd($check_if_null);
        // dd($request);
        // if(!isNull($check_if_null)) {
        // dd($check_if_null);

        // }
        return back()->with('loginError', 'Login failed ! Check your e-mail and or password again !');
        // $check_password_null = User::where('email', $request->email)->first();

        // dd($verification_check);


    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // return redirect('/account/login')->with('logged out', 'Logged out successfully');
        return redirect()->route('login_trial')->with('logged out', 'Logged out successfully');
    }

    public function googleLoginRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        $user = Socialite::driver('google')->user();
        // dd($user);
        $available = User::where('email', $user->email)->first();
        $this->createUpdateUser($user, 'google');
        if (!$available) {
            return redirect()->route('change_page_trial');
        }
        // return redirect('/homePage');
        return redirect()->route('init');
    }

    private function createUpdateUser($data, $provider)
    {
        $user = User::where('email', $data->email)->first();

        if ($user) {
            $user->update([
                'provider' => $provider,
                'provider_id' => $data->id,
                'avatar' => $data->avatar,
                // 'is_verified' => 1,
            ]);
        } else {
            $user = User::create([
                'name' => $data->name,
                'email' => $data->email,
                'provider' => $provider,
                'provider_id' => $data->id,
                'avatar' => $data->avatar,
                'is_verified' => 1,
            ]);
        }

        Auth::login($user);
    }

    private function sendVerifyEmail($email)
    {
        $token = Str::random(64);

        DB::table('verification_tokens')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $action_link = route('emailVer', [
            'token' => $token,
            'email' => $email,
            'title' => 'E-mail Verification'
        ]);

        $body = "Please verify your email on link down below to start accessing our website";

        Mail::send('layouts.email_verification_template', ['action_link' => $action_link, 'body' => $body, 'title' => 'Verify E-mail'], function ($message) use ($email) {
            $message->from('glenn.sandhelp@gmail.com', 'Sand Help');
            $message->to($email, 'Sand Help')->subject('Verify E-mail');
        });
    }

    public function emailVerification(Request $request, $token = NULL)
    {
        return view('testing.account.email_verification', ['title' => 'Verify E-mail', 'token' => $token, 'email' => $request->email]);
    }

    public function emailVerificationControl(Request $request)
    {
        $check_token = DB::table('verification_tokens')->where([
            'email' => $request->email,
            'token' => $request->token
        ])->first();

        if ($check_token) {
            User::where('email', $request->email)->update([
                'is_verified' => 1
            ]);

            DB::table('verification_tokens')->where([
                'email' => $request->email
            ])->delete();

            return redirect('account/login')->with('verified', 'Your account is successfully verified, please login to continue !')->with('email', $request->email);
        }
        return redirect()->route('login_trial')->with('invalid_verification', 'Verification failed! You either verified your account already or haven\'t registered with that e-mail !');
        // return redirect('account/login')->with('invalid_verification', 'Verification failed! You either verified your account already or haven\'t registered with that e-mail !');
    }

    public function forgot_password()
    {
        // return view('account.forgot_password_index', ['title' => 'Forgot Password']);
        return view('testing.account.forgot_password_index', ['title' => 'Forgot Password']);
    }

    public function sendForgetToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'g-recaptcha-response' => function ($attribute, $value, $fail) {
                $secretKey = env('GOOGLE_CAPTCHA_SECRET');
                $response = $value;
                $userIP = $_SERVER['REMOTE_ADDR'];
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$userIP";
                $response = file_get_contents($url);
                $response = json_decode($response);
                // dd($response);
                if (!$response->success) {
                    return back()->with('google_captcha_error', 'Google Captcha failed to validate !');
                    // $fail($attribute, 'Google Recaptcha failed to validate !');
                }
            },
        ]);

        $check_password_null = User::where('email', $request->email)->first();

        if (!isNull($check_password_null)) {
            $check_password_null = $check_password_null->password;
            if ($check_password_null == null) {
                // dd($check_password_null);
                return back()->with('google_logged', 'You are logged with Google account. You need to set up your password first at Sign Up');
            }
        }

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $action_link = route('reset.password.form', [
            'token' => $token,
            'email' => $request->email,
            'title' => 'Password Reset'
        ]);
        // $action_link = route('reset.password.form', [
        //     'token' => $token,
        //     'email' => $request->email,
        //     'title' => 'Password Reset'
        // ]);

        $body = "We received a request to reset your password under the e-mail of $request->email. To reset your password, click the link below";

        Mail::send('layouts.email_forgot_template', ['action_link' => $action_link, 'body' => $body, 'title' => 'Reset Password'], function ($message) use ($request) {
            $message->from('glenn.sandhelp@gmail.com', 'Sand Help');
            $message->to($request->email, 'Sand Help')->subject('Reset Password');
        });

        return back()->with('sent', 'We have sent you the link to reset your password. Check your e-mail !');
    }

    public function resetPasswordForm(Request $request, $token = NULL)
    {
        return view('testing.account.forgot_password_form', ['title' => 'Reset Password', 'token' => $token, 'email' => $request->email]);
    }

    public function resetPasswordControl(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%_]).*$/|confirmed',
                'password_confirmation' => 'required'
            ],
            ['password.regex' => 'Password must contain a minimum of 1 uppercase, 1 number, and 1 unique expression (!$#%_) except then . or ,']
        );

        $check_token = DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token
        ])->first();

        if ($check_token) {
            User::where('email', $request->email)->update([
                'password' => bcrypt($request->password)
            ]);

            DB::table('password_resets')->where([
                'email' => $request->email
            ])->delete();

            return redirect()->route('login_trial')->with('info', 'Password reset, you can now log in with your new password')->with('email', $request->email);
            // return redirect('account/login')->with('info', 'Password reset, you can now log in with your new password')->with('email', $request->email);
        }

        return back()->with('invalid', 'Invalid token !');
    }

    public function changePasswordIndex()
    {
        $check = User::where('email', auth()->user()->email)->first();
        if (!$check->password) {
            return view('testing.main.change_profile', ['title' => 'Edit Profile']);
            // return view('main.change_profile', ['title' => 'Change Profile']);
        } else {
            return view('account.changePassword', ['title' => 'Change Password']);
        }
    }

    public function changePassword(Request $request)
    {
        $update_password = $request->validate([
            'old_password' => 'required|min:8',
            'password' => 'required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%_]).*$/|confirmed',
            'password_confirmation' => 'required',
            'g-recaptcha-response' => function ($attribute, $value, $fail) {
                $secretKey = env('GOOGLE_CAPTCHA_SECRET');
                $response = $value;
                $userIP = $_SERVER['REMOTE_ADDR'];
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$userIP";
                $response = file_get_contents($url);
                $response = json_decode($response);
                // dd($response);
                if (!$response->success) {
                    return back()->with('google_captcha_error', 'Google Captcha failed to validate !');
                    // $fail($attribute, 'Google Recaptcha failed to validate !');
                }
            },
        ]);

        $old_password = auth()->user()->password;

        if (Hash::check($update_password['old_password'], $old_password)) {
            User::where('email', $request->email)->update([
                'password' => Hash::make($update_password['password']),
            ]);
            return redirect()->route('change_page_trial')->with('password_updated', 'Password successfully updated !');
        }

        return back()->with('password_not_match', 'Your old password doesn\'t match');
    }
}
