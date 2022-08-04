<?php

namespace App\Http\Livewire\Houses\PhotoAlbum;

use App\Models\Photo\Album;
use App\Models\Photo\Photo;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;


class CreateOrUpdatePhotoAlbum extends Component
{
    use WithFileUploads;

    public $state = [];

    public $image;

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

    public function save(){

        $validatedData = $this->validate([
            'image' => 'required|mimes:png,jpg,gif,tiff',
        ]);

        $imageName = $this->image->store("dummyImages",'public');

        Photo::create([

            'HouseId' => \Auth::user()->HouseId,
            'album_id' => $this->albumID,
            'path' => $imageName,

        ]);

        $this->emit('hideModal');

        session()->flash('success', 'Image successfully Uploaded.');

//        if (!empty($this->image)){
//
//            $imageHashName = $this->image->hashName();
//
//            $validateData = array_merge($validateData, [
//               'image' => 'image'
//            ]);
//
//            $data = array_merge($data, [
//               'image' => $imageHashName
//            ]);
//
//            $this->image->store('public/photos');
//            $manager = new ImageManager();
//            $image = $manager->make('storage/photos'.$imageHashName)->resize(400,300);
//            $image->save('photos/photo_'.auth()->user()->HouseId.'_'.'id'.'jpg');
//        }

//        $this->validate($validateData);

    }

}
