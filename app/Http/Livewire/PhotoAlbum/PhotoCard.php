<?php

namespace App\Http\Livewire\PhotoAlbum;

use App\Models\Photo\Album;
use App\Models\Photo\Photo;
use Livewire\Component;

class PhotoCard extends Component
{

    public Photo $photo;

    public function render()
    {
        return view('photo-album.photo-card');
    }

}
