<?php

namespace App\Http\Livewire\PhotoAlbum;

use App\Models\House;
use App\Models\Photo\Album;
use Livewire\Component;

class PhotoAlbumList extends Component
{
    public $user;

    public $parent_id = null;

    public ?Album $album;

    public $sort_order = null;

    protected $queryString = [
        'parent_id' => ['except' => null],
        'sort_order' => ['except' => null]
    ];

    public function mount() {
        if (!is_null($this->parent_id)) {
            $this->album = Album::where('id', $this->parent_id)->where('house_id', $this->user->HouseId)->first();
        } else {
            $this->album = null;
        }

    }

    public function changeSortOrder() {
        $this->sort_order = $this->sort_order;
    }

    public function render()
    {

        $data = Album::where('house_id', $this->user->HouseId)
            ->when($this->parent_id !== null, function ($query) {
                $query->where('parent_id', $this->parent_id)->whereNotNull('parent_id');
            })
            ->when($this->parent_id === null, function ($query) {
                $query->whereNull('parent_id');
            })
            ->where(function ($query) {
                $query->whereHas('nestedAlbums', function ($query) {
                    $query->whereHas('nestedAlbums')->orWhereHas('photos');
                })->orWhereHas('photos');
            })
//            ->orderBy('id', 'DESC')
            ->get();

        if ($this->album && $this->album->photos->count() > 0) {
            $data = $data->merge($this->album->photos);
        }
        $data->shuffle();

        if ($this->sort_order === 'desc') {
            $data = $data->sortByDesc('created_at');
        } else {

            $data = $data->sortBy('created_at');
        }
//        dd($this->sort_order);
        return view('photo-album.photo-album-list', compact('data'));
    }
}
