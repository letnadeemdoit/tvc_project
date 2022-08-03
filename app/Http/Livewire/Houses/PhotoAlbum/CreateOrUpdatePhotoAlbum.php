<?php

namespace App\Http\Livewire\Houses\PhotoAlbum;

use App\Models\Photo\Photo;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateOrUpdatePhotoAlbum extends Component
{
    use WithFileUploads;

    public $state = [];

    public $albumID;

    public $file;

    public $updateMode = false;

    protected $listeners = [
        'showModal'
    ];

    public function render()
    {

        $photos = Photo::paginate(15);

        return view('dash.houses.photo-album.create-or-update-photo-album',compact('photos'));
    }

    public function showModal() {
        $this->updateMode = false;
        $this->reset('state');
        $this->emit('openModal');
    }

    public function createPhotoAlbum(){

        dd("ok");

    }

}
