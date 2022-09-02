<?php

namespace App\Http\Livewire\PhotoAlbum;

use App\Models\Photo\Album;
use Livewire\Component;

class PhotoAlbumCard extends Component
{

    public Album $album;

    public $albumPhotos;

    public $nestedPhoto;

    public function mount() {
        $this->albumPhotos = $this->album->photos;
        $this->nestedPhoto = count($this->albumPhotos);
    }


    public function render()
    {
        $childAlbum  = Album::where('house_id', $this->album->house_id)->where('parent_id', $this->album->id)->first();
        return view('photo-album.photo-album-cards', compact('childAlbum'));
    }

}
