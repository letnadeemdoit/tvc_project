<?php

namespace App\Http\Controllers;

use App\Models\Blog\Blog;
use App\Models\GuestBook;
use App\Models\ICal;
use App\Models\Photo\Album;
use App\Models\Subscription;
use App\Notifications\ContactUsMailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Facades\PayPal;

class GuestController extends Controller
{
    /**
     * Welcome
     * @return mixed
     */
    public function welcome()
    {
        return view('welcome');
    }

    /**
     * terms of service
     */
    public function termsService()
    {
        return view('terms-of-service');
    }

    /**
     * Contact
     * @return mixed
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Contact Email
     * @param Request $request
     * @return mixed
     */
    public function contactMail(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'comment' => 'required',
        ]);

        $user = auth()->user();
        $firstName = $request->first_name;
        $lastName = $request->last_name;
        $subject = $request->subject;
        $email = $request->email;
        $comment = $request->comment;

        Notification::route('mail', $user->email)
            ->notify(new ContactUsMailNotification($firstName, $lastName, $subject, $email, $comment));

//        Mail::send([], [], function ($message) use ($request) {
//
//            $message->to('ddnouman@gmail.com')
//                ->subject($request->first_name . ' ' . 'Contact Query')
//                ->Html(
//                    '<div style="padding: 10px; 20px">' .
//                    '<h2> Name: ' . $request->first_name . ' ' . $request->last_name . '</h2>' .
//                    '<p> Email: ' . $request->email . '<p/>' .
//                    '<h4> Subject: ' . $request->subject . '<h4/>' .
//                    '<p> Comment: ' . $request->comment . '<p/>' . '</br>' .
//                    '</div>', 'text/plain');
//        });

        return back()->with('success', 'Your Query has been Sent Successfully!');
    }

    /**
     * Policies
     * @return mixed
     */
    public function policies()
    {
        return view('policies');
    }

    /**
     * Help
     * @return mixed
     */
    public function help()
    {
        return view('help');
    }
    /**
     * Calendar
     * @return mixed
     */
    public function calendar(Request $request)
    {
        return view('calendar',[
            'user' => $request->user(),
            'iCalUrl' => $request->user()->iCalUrl(),
        ]);
    }

    /**
     * Blog
     * @return mixed
     */
    public function blog()
    {

        return view('blog');
    }

    /**
     * Blog Detals
     * @param $BlogId
     * @return mixed
     */
    public function blogDetails($BlogId)
    {
        $blogDetail = Blog::where('BlogId', $BlogId)->first();
        return view('blog-details', compact('blogDetail'));
    }

    /**
     * Privacy Policy
     * @return mixed
     */
    public function privacyPolicy()
    {

        return view('privacy-policy');

    }

    /**
     * Single Album
     * @return mixed
     */
    public function singleAlbum()
    {
        return view('photo-album-detail');
    }

    /**
     * Guest Login
     * @return mixed
     */
    public function guestLogin()
    {
        return view('guest-login');
    }

    /**
     * Login Account
     * @return mixed
     */
    public function loginAccount()
    {
        return view('login-account');
    }

    /**
     * Search House
     * @return mixed
     */
    public function searchHouse()
    {
        return view('search-house');
    }

    /**
     * Photo Gallery View
     * @return mixed
     */
    public function photoGalleryView()
    {
        return view('photo-album');
    }

    /**
     * Bulletin Board
     * @return mixed
     */
    public function bulletinBoard()
    {
        return view('bulletinBoard');
    }

    /**
     * Guest Book Frontend
     * @return mixed
     */
    public function guestBookFrontend()
    {
        return view('guest-book-frontend');
    }

    /**
     * Local Guide
     * @return mixed
     */
    public function localGuide()
    {
        return view('local-guide');
    }

    /**
     * Photo Album
     * @return mixed
     */
    public function photoAlbum()
    {

        $photoAlbum = Album::where('house_id', auth()->user()->HouseId)->get();

        return view('photo-album', compact('photoAlbum'));
    }

    /**
     * Guest Book
     * @return mixed
     */
    public function guestBook()
    {
        $guestbook = GuestBook::paginate(10);
        return view('guest-book', compact('guestbook'));
    }

    /**
     * ICal
     * @param ICal $ical
     * @return mixed
     */
    public function ical(ICal $ical)
    {
        abort_if(!is_any_subscribed(), 403);
        return response($ical->toICSUrl())->withHeaders([
            'Content-type' => 'text/calendar; charset=utf-8',
//            'Content-Disposition' => 'attachment; filename="calendar.ics"'
        ]);
    }

    /**
     * Paypal IPN
     * @param Request $request
     * @return mixed
     */
    public function paypalIPN(Request $request)
    {
        $ipnData = $request->post();
        Log::channel('paypal')->info('IPN Data: ', $ipnData);

        $ipnData['cmd'] = '_notify-validate';

        if (is_array($ipnData)) {
            Log::channel('paypal')->info('Sending IPN Verification Request ');
            $response = null;

            if (config('paypal.mode') === 'sandbox') {
                Log::channel('paypal')->info('Sandbox');
                $response = Http::send('POST', 'https://ipnpb.sandbox.paypal.com/cgi-bin/webscr', [
                    'form_params' => $ipnData
                ]);
                Log::channel('paypal')->info('Sandbox Response: ', [$response]);
            } else {
                Log::channel('paypal')->info('Production');
                $response = Http::send('POST', 'https://ipnpb.paypal.com/cgi-bin/webscr', [
                    'form_params' => $ipnData
                ]);
                Log::channel('paypal')->info('Production Response: ', [$response]);
            }

            if ($response->ok()) {
                $body = trim($response->body());
                Log::channel('paypal')->info('IPN Verification Response: ', [$body]);
                if ($body === 'VERIFIED') {
                    Log::channel('paypal')->info('IPN Response from Paypal Server: ', ['VERIFIED']);
                    $paypal = PayPal::setProvider();
                    $paypal->getAccessToken();

                    $paypalSubscription = $paypal->showSubscriptionDetails($ipnData['recurring_payment_id']);

                    if (isset($paypalSubscription['error'])) {
                        Log::channel('paypal')->error('IPN Update Subscription: ', [$paypalSubscription['error']]);
//                        [
//                            "error" => [
//                                "name" => "RESOURCE_NOT_FOUND",
//                                "message" => "The specified resource does not exist.",
//                                "debug_id" => "715c50ff50877",
//                                "details" => [
//                                    [
//                                        "issue" => "INVALID_RESOURCE_ID",
//                                        "description" => "Requested resource ID was not found.",
//                                    ],
//                                ],
//                                "links" => [
//                                    [
//                                        "href" => "https://developer.paypal.com/docs/api/v1/billing/subscriptions#RESOURCE_NOT_FOUND",
//                                        "rel" => "information_link",
//                                        "method" => "GET",
//                                    ],
//                                ],
//                            ],
//                        ]
                    } else {
                        Log::channel('paypal')->info('IPN Subscription Details: ', $paypalSubscription);
                        $subscription = Subscription::where('subscription_id', $paypalSubscription['id'])->update([
                            'status' => $paypalSubscription['status']
                        ]);

                        Log::channel('paypal')->info('IPN Update Subscription Successfully: ', [$subscription]);
                    }


                } elseif ($body === 'INVALID') {
                    Log::channel('paypal')->info('IPN Response from Paypal Server: ', ['INVALID']);
                }
            }
        }

        return response('');
    }
}
