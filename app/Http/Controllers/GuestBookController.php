<?php

namespace App\Http\Controllers;

use App\Models\GuestBook;
use Illuminate\Http\Request;

class GuestBookController extends Controller
{
    public function index(Request $request){

        $data = GuestBook::where('house_id', auth()->user()->HouseId)
            ->where('status', 1)
            ->latest()
            ->get();

        return view('guest-book.index',compact('data'),
            [
                'user' => $request->user()
            ]
        );

    }
}
