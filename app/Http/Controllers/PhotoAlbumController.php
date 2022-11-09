<?php

namespace App\Http\Controllers;

use App\Models\Photo\Album;
use Illuminate\Http\Request;

class PhotoAlbumController extends Controller
{
    public function index(Request $request) {

        $album = Album::find($request->get('parent_id'));


        return view('photo-album.index', [
            'user' => $request->user(),
            'album' => $album
        ]);
    }
}
