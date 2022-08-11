<?php

namespace App\Http\Controllers;


use App\Models\Board;
use App\Models\Photo\Album;
use App\Models\Photo\Photo;
use App\Models\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Utils;

class DashboardController extends Controller
{

    public function index(){

        $users= User::paginate(20);

        return view('dash.index',compact('users'));

    }


    public function blogs(){

        return view('dash.blog.display-as.index');

    }

    public function houses(){

        return view('dash.houses.index');

    }

    public function photoAlbum(){

        return view('dash.houses.photo-album.index');

    }

    public function showSingleAlbum($id){

        $album = Album::findOrFail($id);

        return view('dash.houses.photo-album.show',compact('album'));
    }


    public function guestBook(){

        return view('dash.guest-book.display-as.index');

    }

    public function bulletins(){

        return view('dash.bulletin-board.display-list.list');

    }

    public function bulletinBoard(){


        $boards = Board::where('HouseId',\Auth::user()->HouseId)->get();

        return view('dash.bulletin-board.index',compact('boards'));

    }

    public function localGuide(Request $request){

        return view('dash.local-guide.index', [
            'user' => $request->user()
        ]);

    }



}
