<?php

namespace App\Http\Livewire\Houses\PhotoAlbums;

use App\Http\Livewire\Traits\Toastr;
use App\Models\Photo\Album;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateOrUpdatePhotoAlbum extends Component
{

    use WithFileUploads;
    use Toastr;
    public $user;

    public $isCreating = false;

    public $isShowingModal = false;

    public $state = [];

    public $file;

    public ?Album $album;

    protected $listeners = [
        'showAlbumCUModal',
    ];

    public function render()
    {
        $albumCategory = Album::where('house_id', $this->user->HouseId)->get();

        return view('dash.houses.photo-albums.create-or-update-photo-album-form', compact('albumCategory'));
    }

    public function hydrate()
    {
        $this->dispatchBrowserEvent('modal-is-shown');
    }

    public function showAlbumCUModal($toggle, ?Album $album)
    {
        $this->emitSelf('toggle', $toggle);
        $this->album = $album;
        $this->reset(['state', 'file']);

        if ($album->id) {
            $this->isCreating = false;
            $this->state = \Arr::only($album->toArray(), ['house_id','user_id','parent_id','name','image','description']);
        }else{
            $this->isCreating = true;
        }
    }

    public function saveAlbumCU()
    {
        $this->resetErrorBag();

        $inputs = array_filter($this->state);

        if ($this->file) {
            $inputs['image'] = $this->file;
        } else{
            unset($inputs['image']);
        }

        Validator::make($inputs, [
            'name' => 'required|string|max:100',
            'image' => 'nullable|mimes:png,jpg,gif,tiff',
            'description' => 'nullable|string|max:255',
        ])->validateWithBag('saveAlbumCU');

        $this->album->fill([
            'user_id' => $this->user->user_id,
            'house_id' => $this->user->HouseId,
            'parent_id' => $inputs['parent_id'] ?? null,
            'name' => $inputs['name'],
            'description' => $inputs['description'] ?? null,
        ])->save();

        $this->album->updateFile($this->file);

        $this->emitSelf('toggle', false);

        $this->emit('photo-album-cu-successfully');

        $this->success( 'Photo Album ' .($this->isCreating ? 'created' : 'updated'). ' successfully.');
    }

    public function updatedFile() {
        $this->validateOnly('file', ['file' => 'required|mimes:png,jpg,gif,tiff']);
    }

    public function deleteFile() {
        if ($this->album->id) {
            $this->album->deleteFile();
            $this->emit('photo-album-cu-successfully');
        }
    }


}
