<?php

namespace App\Http\Livewire\PhotoAlbum;

use App\Models\Photo\Album;
use Livewire\Component;

class AlbumCard extends Component
{

    public Album $album;

    public function render()
    {
        return view('photo-album.album-card');
    }

}
