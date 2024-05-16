<?php

namespace App\Http\Controllers;

use App\Models\Audit\House;
use App\Models\ProcessingSubscription;
use App\Models\Room\Room;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function accountInformation(Request $request)
    {
        abort_if($request->user()->is_guest, 403);
        return view('dash.settings.account-information.index', [
            'user' => $request->user()
        ]);
    }

    public function billing(Request $request)
    {
        abort_if(!$request->user()->is_admin || ($request->user()->is_admin && !$request->user()->primary_account), 403);
        return view('dash.settings.billing.index', [
            'user' => $request->user()
        ]);
    }

    public function calendarSettings(Request $request)
    {
        abort_if(!$request->user()->is_admin || ($request->user()->is_admin && !$request->user()->primary_account), 403);
        return view('dash.settings.calendar-settings.index', [
            'user' => $request->user()
        ]);
    }

    public function users(Request $request)
    {
        abort_if(!$request->user()->is_admin, 403);
        return view('dash.settings.users.index', [
            'user' => $request->user()
        ]);
    }

    public function rooms(Request $request)
    {
        abort_if(!$request->user()->is_admin || is_basic_subscribed(), 403);

        $addedRooms = Room::where('HouseID', $request->user()->HouseId)->count();
        $maxRooms = 0 ;

        if (is_premium_subscribed()){
            $maxRooms = 1000;
        }elseif(is_standard_subscribed()){
            $maxRooms = 6;
        }else{
            $maxRooms = 0;
        }

        return view('dash.settings.rooms.index', [
            'user' => $request->user(),
            'addedRooms' => $addedRooms,
            'maxRooms' => $maxRooms,
        ]);
    }

    public function additionalHouses(Request $request)
    {
        abort_if(!$request->user()->is_admin || ($request->user()->is_admin && !$request->user()->primary_account) || !is_premium_subscribed(), 403);

        $maxAdditionalHouse = \App\Models\House::whereHas('users', function ($query) use ($request) {
            $query->where('email', $request->user()->email)
                ->where('HouseId', '<>', $request->user()->HouseId);
        })->count();

        return view('dash.settings.additional-houses.index', [
            'user' => $request->user(),
            'maxAdditionalHouse' => $maxAdditionalHouse
        ]);
    }

    public function houseSetting(Request $request)
    {
        abort_if(!$request->user()->is_admin, 403);

        return view('dash.settings.house-settings.index', [
            'user' => $request->user()
        ]);
    }

    public function notifications(Request $request)
    {
        abort_if(!$request->user()->is_admin, 403);
        return view('dash.settings.notifications.index', [
            'user' => $request->user()
        ]);
    }

    public function vacations(Request $request)
    {
        abort_if($request->user()->is_guest, 403);

        return view('dash.settings.vacations.index', [
            'user' => $request->user(),
            'iCalUrl' => $request->user()->iCalUrl(),
        ]);
    }
    public function vacationRequestApproval(Request $request)
    {
        abort_if(!$request->user()->is_admin, 403);

        return view('dash.settings.vacation-request-approval.index', [
            'user' => $request->user(),
        ]);
    }



    public function auditHistory(Request $request)
    {
        abort_if(!$request->user()->is_admin, 403);
        return view('dash.settings.audit-history.index', [
            'user' => $request->user()
        ]);
    }
//
//    public function blog(Request $request)
//    {
//        abort_if($request->user()->is_guest, 403);
//        return view('dash.settings.blog.index', [
//            'user' => $request->user()
//        ]);
//    }

    public function category(Request $request)
    {
        abort_if(!$request->user()->is_admin, 403);
        return view('dash.settings.category.index', [
            'user' => $request->user()
        ]);
    }

    public function unsubscribePlan(Request $request)
    {
        abort_if(!$request->user()->is_admin || ($request->user()->is_admin && !$request->user()->primary_account), 403);

        $subscription = Subscription::where([
            'user_id' => auth()->user()->user_id,
            'house_id' => auth()->user()->HouseId
        ])->whereNotIn('status', ['CANCELLED','IN_PROCESS','COMPLETED','APPROVED'])->latest()->first();

        $paypalsubscription = Subscription::where([
            'user_id' => auth()->user()->user_id,
            'status' => 'ACTIVE'
        ])->latest()->first();
        ProcessingSubscription::create([
            'subscription_id' => $paypalsubscription->id,
            'plan_id' => $paypalsubscription->plan_id,
            'plan' => $paypalsubscription->plan,
            'period' => $paypalsubscription->period,
            'status' => 'APPROVAL_PENDING',
        ]);
        $subscription->cancel();

        session()->flash('status', 'You have been unsubscribed successfully. You may see the status is not changed as soon as verified from paypal it will update automatically.');
        return view('dash.settings.billing.index', [
            'user' => $request->user()
        ]);
    }


}
