<?php

namespace App\Http\Livewire\Settings\Rooms;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\Room\Room;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class RoomsList extends Component
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
        'room-cu-successfully' => '$refresh',
    ];

    public function mount()
    {
        $this->model = Room::class;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $data = Room::where('HouseId', $this->user->HouseId)
            ->when($this->search !== '', function ($query) {
                $query->where(function ($query) {
                    $query
                        ->where('RoomName', 'LIKE', "%$this->search%");
                });
            })
            ->orderBy('RoomID', 'DESC')
            ->paginate($this->per_page);

        return view('dash.settings.rooms.rooms-list', compact('data'));
    }
}
