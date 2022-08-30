<?php

namespace App\Http\Livewire\PhotoAlbum;

use App\Models\Photo\Album;
use Livewire\Component;

class PhotoAlbumCard extends Component
{

    public Album $album;


    public function render()
    {
        return view('photo-album.photo-album-cards');
    }

}
