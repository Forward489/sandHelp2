<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestingController extends Controller
{
    public function index() {
        return view('testing', ['title' => 'Testing Page']);
    }
    public function auth() {
        return view('authTesting', ['title' => 'Auth Testing Page']);
    }
}
