<?php

namespace App\Http\Livewire\PhotoAlbum;

use App\Models\Photo\Album;
use App\Models\Photo\Photo;
use Auth;
use Livewire\Component;

class AlbumCard extends Component
{

    public Album $album;

    public function render()
    {
        return view('photo-album.album-card');
    }

//    public function getAlbumsCountProperty() {
//        return Album::where('parent_id', $this->album->id)->where(function ($query) {
//            $query->whereHas('nestedAlbums')->orWhereHas('photos');
//        })->count();
//    }

    public function getAlbumsCountProperty() {
        return Album::where('parent_id', $this->album->id)->count();
    }

    // public function getPhotosCountProperty() {
    //     return $this->album->photos->count();
    // }

    public function getPhotosCountProperty()
    {

        if ($this->album->house_id === null) {
            // Fetch photos by house_id if album's house_id is null
            return Photo::where('HouseId', Auth::user()->HouseId)->where('album_id', $this->album->id)->count();
        }

        return $this->album->photos()->count();
    }


}
