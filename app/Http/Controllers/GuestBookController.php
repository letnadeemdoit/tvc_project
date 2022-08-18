<?php

namespace App\Http\Controllers;

use App\Models\GuestBook;
use Illuminate\Http\Request;

class GuestBookController extends Controller
{
    public function index(){

        $data = GuestBook::where('house_id', auth()->user()->HouseId)
            ->where('status', 1)
            ->get();

        return view('guest-book.index',compact('data'));

    }
}
