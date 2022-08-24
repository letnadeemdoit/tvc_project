<?php

namespace App\Http\Livewire\Houses\PhotoAlbums\Photos;

use App\Http\Livewire\Traits\Toastr;
use App\Models\Photo\Photo;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateOrUpdatePhoto extends Component
{

    use WithFileUploads;
    use Toastr;

    public $album;

    public $isCreating = false;

    public $isShowingModal = false;

    public $state = [];

    public $file;

    public ?Photo $photo;

    protected $listeners = [
        'showPhotoCUModal',
    ];

    public function render()
    {

        return view('dash.houses.photo-albums.photos.create-or-update-photo');

    }

    public function hydrate()
    {
        $this->dispatchBrowserEvent('modal-is-shown');
    }

    public function showPhotoCUModal($toggle, ?Photo $photo)
    {
        $this->emitSelf('toggle', $toggle);
        $this->photo = $photo;
        $this->reset(['state', 'file']);

        if ($photo->PhotoId) {
            $this->isCreating = false;
            $this->state = \Arr::only($photo->toArray(), ['HouseId','album_id','description','path']);
        }else{
            $this->isCreating = true;
        }
    }

    public function savePhotoCU()
    {
        $this->resetErrorBag();

        $inputs = $this->state;

        if ($inputs['image']) {

//            $inputs['image'] = $this->file;

//            $getFileSize = $inputs['image']->getSize();

            $baseImage = $inputs['image'];

            $folderPath = public_path('new-albums/');

            $image_parts = explode(";base64,", $inputs['image']);

            $image_type_aux = explode("image/", $image_parts[0]);

            $image_type = $image_type_aux[1];

            $image_base64 = base64_decode($image_parts[1]);

            $file = $folderPath . uniqid() . '.png';


           $filePutContent =  file_put_contents($file, $image_base64);


//            $fileNameWithExtension = $file->getClientOriginalName();
//
//            $filename = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);

//            $extension = $file->getClientOriginalExtension();
//
//            $fileNameStore = $filename.'_'.time().'.'.$extension;
//
//            $file->storeAs('public/new-albums', $fileNameStore);

//            $file->storeAs('public/new-albums/thumbnail', $file);

            $thumbnailPath = public_path($file);

            $img = Image::make($thumbnailPath)->resize(250,250, function ($constraint){

                $constraint->aspectRatio();

            });

            $img->save($thumbnailPath);

        }else{

            unset($inputs['image']);

        }

        Validator::make($inputs, [
            'image' => 'required|mimes:png,jpg,gif,tiff',
        ])->validateWithBag('savePhotoCU');

        $this->photo->fill([
            'HouseId' => auth()->user()->user_id,
            'album_id' => $this->album->id,
            'description' => $inputs['description'] ?? null,
        ])->save();

        $this->photo->updateFile($this->file,'path');

        $this->emitSelf('toggle', false);

        $this->emit('photo-cu-successfully');

        $this->success( 'Photo ' .($this->isCreating ? 'created' : 'updated'). ' successfully.');
    }

    public function updatedFile() {
        $this->validateOnly('file', ['file' => 'required|mimes:png,jpg,gif,tiff']);
    }

    public function deleteFile() {
        if ($this->photo->id) {
            $this->photo->deleteFile();
            $this->emit('photo-cu-successfully');
        }
    }


}
