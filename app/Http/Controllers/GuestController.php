<?php

namespace App\Http\Controllers;

use App\Models\Blog\Blog;
use App\Notifications\ContactUsNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

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

    public function contactMail(Request $request)
    {

        Mail::send([], [], function ($message) use($request) {

            $message->to('dash@app.com')

            ->subject($request->first_name. ' '.'Contact Query' )

            ->Html(
                '<div style="padding: 10px; 20px">'.
                '<h2> Name: '.$request->first_name . ' '. $request->last_name .'</h2>'.
                '<p> Email: '.$request->email .'<p/>' .
                '<p> Phone :'.$request->phone .'<p/>' .
                '<h4> Subject: '.$request->subject .'<h4/>' .
                '<p> Deatil: '.$request->detail .'<p/>'  . '</br>' .
                '</div>', 'text/plain');
        });

        return back()->with('success','Your Query has been Sent Successfully!');
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

        $blogs = Blog:: paginate(20);

        return view('blog',compact('blogs'));
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
    public function bulletin(){
        return view('bulletin-board.index');
    }
}
