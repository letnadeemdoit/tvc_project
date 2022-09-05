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

    public function getAlbumsCountProperty() {
        return Album::where('parent_id', $this->album->id)->whereHas('nestedAlbums')->orWhereHas('photos')->count();
    }

    public function getPhotosCountProperty() {
        return $this->album->photos->count();
    }

}
