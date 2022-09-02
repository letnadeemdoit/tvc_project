<?php

namespace App\Http\Livewire\PhotoAlbum;

use App\Models\House;
use App\Models\Photo\Album;
use Livewire\Component;

class PhotoAlbumList extends Component
{
    public $user;

    public $parent_id = 'id';

    protected $queryString = [
        'parent_id' => ['except' => 'id'],
    ];

    public function render()
    {

        $data = Album::
            where('house_id', $this->user->HouseId)->
            when($this->parent_id !== 'id', function ($query) {
                $query->where('parent_id', $this->parent_id);
            })
            ->orderBy('id', 'DESC')
            ->get();
        return view('photo-album.photo-album-list',compact('data'));
    }
}
