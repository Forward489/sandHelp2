<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FeatureController extends Controller
{
    public function index()
    {
        $check = User::where('email', auth()->user()->email)->first();
        if(!$check->password) {
            return view('main.change_profile', ['title' => 'Change Profile']);
        } else {
            return view('feature.payPal', ['title' => 'PayPal Testing']);
        }
    }
}
