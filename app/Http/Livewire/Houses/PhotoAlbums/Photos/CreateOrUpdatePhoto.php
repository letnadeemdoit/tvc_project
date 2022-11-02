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

        if ($this->file) {
            $inputs['image'] = $this->file;
        }

        Validator::make($inputs, [
            'image' => [
                $this->isCreating ? 'required' : 'nullable',
                'mimes:png,jpg,gif,tiff'
            ],
            'description' => 'nullable|string|max:255',
        ])->validateWithBag('savePhotoCU');


        $this->photo->fill([
            'HouseId' => auth()->user()->HouseId,
            'album_id' => $this->album->id,
            'description' => $inputs['description'] ?? null,
        ])->save();

        if ($this->file) {
            $this->photo->updateFile($this->file, 'path');
        }
        $this->emitSelf('toggle', false);

        $this->dispatchBrowserEvent('refresh-photos-list-in-album');
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
