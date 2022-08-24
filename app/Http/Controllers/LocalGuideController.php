<?php

namespace App\Http\Controllers;

use App\Models\LocalGuide;
use Illuminate\Http\Request;

class LocalGuideController extends Controller
{
    public function index(Request $request){

        return view('local-guide.index', [
            'user' => $request->user()
        ]);
//        return view('local-guide.index',compact('data'));

    }

    public function show($id){

        $localGuide = LocalGuide::findOrFail($id);
        return view('local-guide.show',compact('localGuide'));

    }
}
