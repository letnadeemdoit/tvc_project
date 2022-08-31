<?php

namespace App\Http\Controllers;

use App\Models\Blog\Blog;
use App\Models\GuestBook;
use App\Models\Photo\Album;
use App\Notifications\ContactUsNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

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
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'comment' => 'required',
        ]);

        Mail::send([], [], function ($message) use($request) {

            $message->to('ddnouman@gmail.com')

            ->subject($request->first_name. ' '.'Contact Query' )

            ->Html(
                '<div style="padding: 10px; 20px">'.
                '<h2> Name: '.$request->first_name . ' '. $request->last_name .'</h2>'.
                '<p> Email: '.$request->email .'<p/>' .
                '<h4> Subject: '.$request->subject .'<h4/>' .
                '<p> Comment: '.$request->comment .'<p/>'  . '</br>' .
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
    public function blog() {

        return view('blog');
    }

    public function blogDetails($BlogId) {
        $blogDetail = Blog::where('BlogId', $BlogId)->first();
        return view('blog-details', compact('blogDetail'));
    }
    public function privacyPolicy() {

        return view('privacy-policy');

    }
    public function singleAlbum(){
        return view('photo-album-detail');
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
    public function photoGalleryView(){
        return view ('photo-album');
    }
    public function bulletinBoard(){
        return view('bulletinBoard');
    }
    public function guestBookFrontend(){
        return view('guest-book-frontend');
    }
    public function localGuide(){
        return view('local-guide');
    }
    public function photoAlbum(){

        $photoAlbum = Album::where('house_id',auth()->user()->HouseId)->get();

        return view('photo-album',compact('photoAlbum'));
    }

    public function guestBook(){
        $guestbook = GuestBook::paginate(10);
        return view('guest-book', compact('guestbook'));
    }
//    public function card(){
//        return view('card');
//    }
}
