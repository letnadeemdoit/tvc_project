<?php

namespace App\Http\Livewire\Settings\BulletinBoard;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\Board;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class BoardItemsList extends Component
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
        'bulletin-board-cu-successfully' => '$refresh',
    ];

    public function mount()
    {
        $this->model = Board::class;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $data = Board::where('HouseId', $this->user->HouseId)
            ->when($this->search !== '', function ($query) {
                $query->where(function ($query) {
                    $query
                        ->where('title', 'LIKE', "%$this->search%")
                        ->orWhere('Board', 'LIKE', "%$this->search%");
                });
            })
            ->paginate($this->per_page);

        return view('dash.settings.bulletin-board.board-items-list',compact('data'));

    }
}
