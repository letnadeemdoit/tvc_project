<?php

namespace App\Http\Livewire\PhotoAlbum;

use App\Models\House;
use App\Models\Photo\Album;
use Livewire\Component;

class PhotoAlbumList extends Component
{
    public $user;

    public function render()
    {
        $data = Album::all();

        return view('photo-album.photo-album-list',compact('data'));
    }
}
