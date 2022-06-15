<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// use Illuminate\Support\Facades\Redis;

class UpdateProfileController extends Controller
{
    public function index() {
        return view('main.change_profile', ['title' => 'Change Profile']);
    }

    public function update(Request $request) {
        $request->validate([
            'description' => 'required|max:255',
            'g-recaptcha-response' => function($attribute, $value, $fail) {
                $secretKey = env('GOOGLE_CAPTCHA_SECRET');
                $response = $value;
                $userIP = $_SERVER['REMOTE_ADDR'];
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$userIP";
                $response = file_get_contents($url);
                $response = json_decode($response);
                // dd($response);
                if(!$response->success) {
                    return back()->with('google_captcha_error', 'Google Captcha failed to validate !');
                    // $fail($attribute, 'Google Recaptcha failed to validate !');
                }
            }
        ]);

        User::where('email', $request->email)->update([
            'description' => $request->description,
        ]);

        return back()->with('updated', 'You have successfully updated your description and or your profile picture !');
    }
}
