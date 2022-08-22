<?php

namespace App\Http\Livewire\Houses\PhotoAlbums\Photos;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\Photo\Photo;
use Livewire\Component;
use Livewire\WithPagination;

class PhotosList extends Component
{
    use WithPagination;
    use Destroyable;

    public $user;

    public $album;

    public $search = '';

    public $page = 1;

    public $per_page = 15;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'per_page' => ['except' => 15],
    ];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'destroyed-successfully' => '$refresh',
        'photo-cu-successfully' => '$refresh',
    ];

    public function mount()
    {
        $this->model = Photo::class;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $data = Photo::where('album_id', $this->album->id)
            ->paginate($this->per_page);
        return view('dash.houses.photo-albums.photos.photos-list',compact('data'));
    }
}
