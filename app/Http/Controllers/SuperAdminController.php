<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    public function manageUsers(Request $request)
    {
        return view('dash.super-admin.index', [
            'user' => $request->user()
        ]);

    }

    public function index(){

        return view('dash.super-admin.auth.index');

    }

    public function login(Request $request){

        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->is_super_admin) {

                return redirect()->route('super-admin.manage-users');

            }

        }else{
            return redirect()->route('super-admin.login')
                ->with('error','Email-Address And Password Are Wrong.');
        }

    }

}
