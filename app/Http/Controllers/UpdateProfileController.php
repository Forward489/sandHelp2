<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;
// use Illuminate\Support\Facades\Redis;

class UpdateProfileController extends Controller
{

    public function profile_page() {
        return view('testing.main.profile_page', ['title' => 'Profile Page']);
    }
    public function change_profile()
    {
        return view('testing.main.change_profile', ['title' => 'Edit Profile']);
        // $check = User::where('email', auth()->user()->email)->first();
        // // dd($check->password);
        // if (!$check->password) {
        //     return view('main.change_profile', ['title' => 'Change Profile']);
        // } else {
        //     return view('homepage', ['title' => 'Home Page']);
        // }
    }
 
    public function index()
    {
        return view('testing.main.change_profile', ['title' => 'SandHelp-Profile Page']);
    }

    public function update(Request $request)
    {
        
        // dd($request->file('profile_picture'));
        $request->validate([
            'description' => 'max:255',
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
        ]);

        // dd($request);

        // dd($request);

        if ($request->password) {
            $validatePassword = $request->validate([
                'password' => 'required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%_]).*$/|confirmed',
                'password_confirmation' => 'required',
            ]);
            User::where('email', $request->email)->update([
                'password' => bcrypt($validatePassword['password']),
            ]);
        }
        if ($request->gender) {
            $validateGender = $request->validate([
                'gender' => 'required',
            ]);
            User::where('email', $request->email)->update([
                'gender' => $validateGender['gender'],
            ]);
        }

        if ($request->birthdate) {
            $validateBirthdate = $request->validate([
                'birthdate' => 'required|date_format:Y-m-d',
            ]);
            User::where('email', $request->email)->update([
                'birthdate' => $validateBirthdate['birthdate'],
            ]);
        }

        if ($request->file('profile_picture')) {
            $picture = $request->validate([
                'profile_picture' => 'image|file|max:2048',
            ]);

            if (auth()->user()->profile_picture) {
                $file = auth()->user()->profile_picture;
                File::delete($file);
            }
            
            $picture['profile_picture'] = $request->file('profile_picture')->store('profilePhotos');

            User::where('email', $request->email)->update([
                'profile_picture' => $picture['profile_picture'],
            ]);

            // return back()->with('updated', 'You have successfully updated your description and or your profile picture !');
        }

        // return $request->file('image')->store('profile_pictures');

        User::where('email', $request->email)->update([
            'description' => $request->description,
        ]);

        return redirect()->route('change_page_trial')->with('updated', 'You have successfully updated your description and or your profile picture !');
    }
}
