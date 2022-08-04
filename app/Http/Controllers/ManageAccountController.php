<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageAccountController extends Controller
{
    public function settings(Request $request) {
        return view('dash.manage-account.settings', [
            'user' => $request->user()
        ]);
    }

    public function subscriptions(Request $request) {
        return view('dash.manage-account.subscriptions', [
            'user' => $request->user()
        ]);
    }

    public function invoices(Request $request) {
        return view('dash.manage-account.invoices', [
            'user' => $request->user()
        ]);
    }
}
