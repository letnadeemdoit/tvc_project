<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function accountInformation(Request $request)
    {
        return view('dash.settings.account-information.index', [
            'user' => $request->user()
        ]);
    }

    public function billing(Request $request)
    {
        return view('dash.settings.billing.index', [
            'user' => $request->user()
        ]);
    }

    public function users(Request $request)
    {
        return view('dash.settings.users.index', [
            'user' => $request->user()
        ]);
    }

    public function rooms(Request $request)
    {
        return view('dash.settings.rooms.index', [
            'user' => $request->user()
        ]);
    }

    public function additionalHouses(Request $request)
    {
        return view('dash.settings.additional-houses.index', [
            'user' => $request->user()
        ]);
    }

    public function notifications(Request $request)
    {
        return view('dash.settings.notifications.index', [
            'user' => $request->user()
        ]);
    }

    public function vacations(Request $request)
    {
        return view('dash.settings.vacations.index', [
            'user' => $request->user()
        ]);
    }

    public function bulletinBoard(Request $request)
    {
        return view('dash.settings.bulletin-board.index', [
            'user' => $request->user()
        ]);
    }

    public function auditHistory(Request $request)
    {
        return view('dash.settings.audit-history.index', [
            'user' => $request->user()
        ]);
    }

    public function blog(Request $request)
    {
        return view('dash.settings.blog.index', [
            'user' => $request->user()
        ]);
    }

    public function guestBook(Request $request)
    {
        return view('dash.settings.guest-book.index', [
            'user' => $request->user()
        ]);
    }
}
