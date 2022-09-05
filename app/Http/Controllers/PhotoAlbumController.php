<?php

namespace App\Http\Controllers;

use App\Models\Photo\Album;
use Illuminate\Http\Request;

class PhotoAlbumController extends Controller
{
    public function index(Request $request) {
        return view('photo-album.index', [
            'user' => $request->user()
        ]);
    }
}
