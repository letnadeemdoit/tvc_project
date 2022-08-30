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

    public function show(Request $request, Album $album)
    {
        $nestedAlbums = $album->nestedAlbums;
        return view('photo-album.album-detail.show', [
            'user' => $request->user(),
            'album' => $album,
            'nestedAlbums' => $nestedAlbums
        ]);
    }

}
