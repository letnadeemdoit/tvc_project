<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class BulletinBoardController extends Controller
{
    public function index(){

        $data = Board::where('HouseId', auth()->user()->HouseId)->get();

        return view('bulletin-board.index',compact('data'));

    }
}
