<?php

namespace App\Http\Controllers;

use App\Models\Audit\House;
use App\Models\Room\Room;
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
        abort_if(!$request->user()->is_admin, 403);
        return view('dash.settings.billing.index', [
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
        abort_if(!$request->user()->is_admin || !is_premium_subscribed(), 403);

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

    public function bulletinBoard(Request $request)
    {
        abort_if(!$request->user()->is_admin, 403);
        return view('dash.settings.bulletin-board.index', [
            'user' => $request->user()
        ]);
    }

    public function auditHistory(Request $request)
    {
        abort_if(!$request->user()->is_admin, 403);
        return view('dash.settings.audit-history.index', [
            'user' => $request->user()
        ]);
    }

    public function blog(Request $request)
    {
        abort_if($request->user()->is_guest, 403);
        return view('dash.settings.blog.index', [
            'user' => $request->user()
        ]);
    }

    public function category(Request $request)
    {
        abort_if(!$request->user()->is_admin, 403);
        return view('dash.settings.category.index', [
            'user' => $request->user()
        ]);
    }

    public function guestBook(Request $request)
    {
        abort_if(!$request->user()->is_admin, 403);
        return view('dash.settings.guest-book.index', [
            'user' => $request->user()
        ]);
    }
}
