<?php

namespace App\Http\Controllers;

use App\Models\Blog\Blog;
use App\Models\GuestBook;
use App\Models\House;
use App\Models\ICal;
use App\Models\Photo\Album;
use App\Models\Subscription;
use App\Models\Vacation;
use App\Notifications\ContactUsMailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Facades\PayPal;
use GuzzleHttp\Client;

class GuestController extends Controller
{

    /**
     * Welcome
     * @return mixed
     */
    public function welcome()
    {
        $blogs = Blog::where('is_public',1)->get();
        return view('welcome', compact('blogs'));
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

        $current_user = auth()->user();

        $firstName = $request->first_name;
        $lastName = $request->last_name;
        $subject = $request->subject;
        $email = $request->email;
        $comment = $request->comment;

        Notification::route('mail', $request->email)
            ->notify(new ContactUsMailNotification($firstName, $lastName, $subject, $email, $comment));

        Mail::send([], [], function ($message) use ($request) {

            $message->to('support@thevacationcalendar.com')
                ->subject($request->first_name . ' ' . 'Contact Query')
                ->Html(
                    '<div style="padding: 10px; 20px">' .
                    '<h2> Contact Us Notification</h2>' .
                    '<p> Name: ' . $request->first_name . ' ' . $request->last_name . '</p>' .
                    '<p> Email: ' . $request->email . '<p/>' .
                    '<p> Subject: ' . $request->subject . '<p/>' .
                    '<p> Comment: ' . $request->comment . '<p/>' . '</br>' .
                    '</div>', 'text/plain');
//            $message->from($request->email, $request->first_name. ' ' . $request->last_name);
        });



        $client = new Client();
        try {
            // Check if contact exists
            $response = $client->get('https://api.hubapi.com/crm/v3/objects/contacts/' . $email, [
                'query' => ['idProperty' => 'email'],
                'headers' => [
                    'Authorization' => 'Bearer ' . env('HUBSPOT_API_TOKEN', ''),
                    'Content-Type' => 'application/json',
                ],
            ]);

            $contact = json_decode($response->getBody(), true);

            if (!isset($contact['id'])) {
                // Contact does not exist, create it
                $response = $client->post('https://api.hubapi.com/crm/v3/objects/contacts', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . env('HUBSPOT_API_TOKEN', ''),
                        'Content-Type' => 'application/json',
                    ],
                    'json' => [
                        'properties' => [
                            'email' => $email,
                            'firstname' => $firstName,
                            'lastname' => $lastName,
                            'houseid' => $current_user->HouseId,
                            'housename' => $current_user->house->HouseName,
                        ],
                    ],
                ]);

                $contact = json_decode($response->getBody(), true);
            }

            $contactId = $contact['properties']['hs_object_id'];

            // Create a ticket & associate to contact
            $client->post('https://api.hubapi.com/crm/v3/objects/tickets', [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('HUBSPOT_API_TOKEN', ''),
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'properties' => [
                        'hs_pipeline' => '0',
                        'hs_pipeline_stage' => '1',
                        'hs_ticket_priority' => 'MEDIUM',
                        'subject' => $subject,
                        'content' => $comment,
                    ],
                    'associations' => [
                        [
                            'to' => [
                                'id' => $contactId,
                            ],
                            'types' => [
                                [
                                    'associationCategory' => 'HUBSPOT_DEFINED',
                                    'associationTypeId' => 16,
                                ],
                            ],
                        ],
                    ],
                ],
            ]);
        } catch (\Exception $e) {
            return back()->withErrors('There was an error processing your request: ' . $e->getMessage());
        }



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
     * Pricing
     * @return mixed
     */
    public function pricing()
    {
        return view('pricing');
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

    public function requestToJoinVacation(Request $request)
    {
        $vacationId = $request->query('vacationId');
        $initialDate = $request->query('initialDate');
        return view('request-to-join-vacation', [
            'vacationId' => $vacationId,
            'initialDate' => $initialDate,
            'user' => $request->user(),
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


    /**
     * getHouseImage
     * @return mixed
     */

    public function getHouseImage(Request $request)
    {
        $houseId = $request->input('houseId');
        $selectedHouse = House::where('HouseID', $houseId)->select('HouseID', 'login_image','is_default_login_image')->firstOrFail();

        if ($selectedHouse) {
            return response()->json($selectedHouse);
        } else {
            return response()->json(['message' => 'House not found'], 404);
        }
    }

}
