<?php

namespace App\Http\Livewire\PhotoAlbum;

use App\Http\Livewire\Traits\Toastr;
use App\Models\House;
use App\Models\Photo\Album;
use App\Models\Photo\Photo;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class PhotoAlbumList extends Component
{

    use WithFileUploads;
    use Toastr;

    public $user;

    public $parent_id = null;

    public $state = [];

    public $file;

    public $isCreating = false;

    public ?Album $album;

    public ?Photo $photo;

    public $sort_order = null;

    protected $queryString = [
        'parent_id' => ['except' => null],
        'sort_order' => ['except' => null]
    ];

//    protected $listeners = [
//        'refresh-photos-list-in-album' => 'refreshList'
//    ];

    public function mount() {
        if (!is_null($this->parent_id)) {
            $this->album = Album::where('id', $this->parent_id)->where('house_id', $this->user->HouseId)->first();
            if (!$this->album){
                $this->album = Album::where('id', $this->parent_id)->where('house_id', null)->where('name', 'General')->first();
            }
        } else {
            $this->album = null;
        }
    }

    public function changeSortOrder() {
        $this->sort_order = $this->sort_order;
    }


    public function render()
    {
        $data = Album::where(function ($query) {
            $query->where('house_id', $this->user->HouseId)
                ->orWhere('house_id', null);
        })
            ->when($this->parent_id !== null, function ($query) {
                $query->where('parent_id', $this->parent_id)->whereNotNull('parent_id');
            })
            ->when($this->parent_id === null, function ($query) {
                $query->whereNull('parent_id');
            })
            ->where(function ($query) {
                $query->whereHas('nestedAlbums', function ($query) {
                    $query->whereHas('nestedAlbums')->orWhereHas('photos');
                })->orWhereHas('photos')
                    ->orWhereDoesntHave('photos')->orWhereDoesntHave('nestedAlbums');
            })
            ->get();

        if ($this->album && $this->album->photos->count() > 0) {
            $albumPhotos = $this->album->photos;
            $sortedPhotos = $albumPhotos->sortBy('created_at');
            $data = $data->merge($sortedPhotos);
        }

        $data->shuffle();

        if ($this->sort_order === 'desc') {
            $data = $data->sortByDesc('created_at');
        } else {

            $data = $data->sortBy('created_at');
        }

        return view('photo-album.photo-album-list', compact('data'));
    }



    // Previous code
//    public function render()
//    {
//        $data = Album::
//
////        where('house_id', $this->user->HouseId)
//        where(function ($query) {
//            $query->where('house_id', $this->user->HouseId)
//                ->orWhere('house_id', null);
//        })
//            ->when($this->parent_id !== null, function ($query) {
//                $query->where('parent_id', $this->parent_id)->whereNotNull('parent_id');
//            })
//            ->when($this->parent_id === null, function ($query) {
//                $query->whereNull('parent_id');
//            })
//            ->where(function ($query) {
//                $query->whereHas('nestedAlbums', function ($query) {
//                    $query->whereHas('nestedAlbums')->orWhereHas('photos');
//                })->orWhereHas('photos')
//                    ->orWhereDoesntHave('photos')->orWhereDoesntHave('nestedAlbums');
//            })
////            ->where(function ($query) {
////                $query->whereHas('nestedAlbums', function ($query) {
////                    $query->whereHas('nestedAlbums')->orWhereHas('photos');
////                })->orWhereHas('photos');
////            })
//            ->get();
//
//        if ($this->album && $this->album->photos->count() > 0) {
//            $albumPhotos = $this->album->photos;
//            $sortedPhotos = $albumPhotos->sortBy('created_at');
//            $data = $data->merge($sortedPhotos);
////            $data = $data->merge($this->album->photos);
//        }
//
//        $data->shuffle();
//
//        if ($this->sort_order === 'desc') {
//            $data = $data->sortByDesc('created_at');
//        } else {
//
//            $data = $data->sortBy('created_at');
//        }
//
//        return view('photo-album.photo-album-list', compact('data'));
//    }
}
