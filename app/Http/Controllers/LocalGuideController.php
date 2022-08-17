<?php

namespace App\Http\Controllers;

use App\Models\LocalGuide;
use Illuminate\Http\Request;

class LocalGuideController extends Controller
{
    public function index(){

        $data = LocalGuide::where('house_id', auth()->user()->HouseId)->get();

        return view('local-guide.index',compact('data'));

    }

    public function show($id){

        $localGuide = LocalGuide::findOrFail($id);
        return view('local-guide.show',compact('localGuide'));

    }
}
