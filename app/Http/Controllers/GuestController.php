<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function contact()
    {
        return view('contact');
    }

    public function policies()
    {
        return view('policies');
    }

    public function help()
    {
        return view('help');
    }

    public function bulletinBoard(){
        return view('bulletinBoard');
    }

    public function blog() {
        return view('blog');
    }
    public function PrivacyPolicy() {
        return view('privacy-policy');
    }
    public function guestLogin() {
        return view('guest-login');
    }
    public function loginAccount() {
        return view('login-account');
    }
    public function searchHouse() {
        return view('search-house');
    }
}
