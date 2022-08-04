<?php

namespace App\Http\Controllers;


use App\Models\Photo\Album;
use App\Models\Photo\Photo;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(){

        $users= User::paginate(20);

        return view('dash.index',compact('users'));

    }


    public function blogs(){

        return view('dash.blog.index');

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
}
