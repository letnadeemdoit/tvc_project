<?php

namespace App\Http\Livewire\Houses\PhotoAlbum;

use App\Models\Photo\Album;
use App\Models\Photo\Photo;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class DisplayAsList extends Component
{
    public $state = [];

    public $updateMode = false;

    protected $listeners = [
        'showModal'
    ];

    public Album $album;

    public function render()
    {
        $albums = Album::paginate(15);
        return view('dash.houses.photo-album.display-as.list',compact('albums'));
    }

    public function showModal() {
        $this->updateMode = false;
        $this->reset('state');
        $this->emit('openModal');
    }

    public function createPhotoAlbum(){

        Validator::make($this->state, [
            'name' => 'required',
        ])->validate();

        Album::create([

            'user_id' => \Auth::user()->user_id,
            'house_id' => \Auth::user()->HouseId,
            'parent_id' => $this->state['parent_id'] ?? null,
            'name' =>  $this->state['name'],
            'description' =>  $this->state['description'] ?? null,

        ]);

        $this->emit('hideModal');
        session()->flash('success', 'Album Created successfully...');

    }

    public function edit($id)
    {
        $album = Album::findOrFail($id);
        $this->state = \Arr::only($album->toArray(), ['id', 'parent_id', 'name', 'description']);
        $this->updateMode = true;
        $this->emit('openModal');
    }

    public function UpdatePhotoAlbum(){

        Validator::make($this->state, [
            'name' => 'required',
        ])->validate();

        $album = Album::findOrFail($this->state['id']);

        $album->fill([
            'user_id' => \Auth::user()->user_id,
            'house_id' => \Auth::user()->HouseId,
            'parent_id' => $this->state['parent_id'] ?? null,
            'name' =>  $this->state['name'],
            'description' =>  $this->state['description'] ?? null,

        ])->save();

        $this->updateMode = false;
        $this->emit('hideModal');
        session()->flash('success', 'Album updated successfully...');

    }

    public function destroy($id)
    {
        $album = Album::where('id', $id);

        if ($album) {

            $this->emit('hideModal');

            session()->flash('success', 'Album Deleted successfully...');

            $album->delete();

        }
    }
}
