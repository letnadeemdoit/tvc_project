<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Category;
use Illuminate\Http\Request;

class BulletinBoardController extends Controller
{
    public function index(Request $request){
        return view('bulletin-board.index',[
            'user' => $request->user()
        ]);

    }
}
