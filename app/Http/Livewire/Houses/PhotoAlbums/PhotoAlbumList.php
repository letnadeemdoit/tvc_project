<?php

namespace App\Http\Livewire\Houses\PhotoAlbums;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\Photo\Album;
use Livewire\Component;
use Livewire\WithPagination;

class PhotoAlbumList extends Component
{

    use WithPagination;
    use Destroyable;

    public $user;

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
        'photo-album-cu-successfully' => '$refresh',
    ];

    public function mount()
    {
        $this->model = Album::class;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function render()
    {
        $data = Album::
            where(function ($query){
                $query->where('house_id', $this->user->HouseId)
                    ->orWhere('house_id', null);
            })
//        where('house_id', $this->user->HouseId)
//            ->when($this->user->is_owner_only, function ($query) {
//                $query->where('user_id', $this->user->user_id);
//            })
            ->when($this->search !== '', function ($query) {
                $query->where(function ($query) {
                    $query
                        ->where('name', 'LIKE', "%$this->search%");
                });
            })
            ->paginate($this->per_page);

        return view('dash.houses.photo-albums.photo-album-list',compact('data'));
    }
}
