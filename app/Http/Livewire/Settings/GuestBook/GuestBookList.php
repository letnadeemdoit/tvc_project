<?php

namespace App\Http\Livewire\Settings\GuestBook;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\Board;
use App\Models\Guest;
use App\Models\GuestBook;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class GuestBookList extends Component
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
        'guest-book-cu-successfully' => '$refresh',
    ];

    public function mount()
    {
        $this->model = GuestBook::class;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        $data = GuestBook::where('house_id', $this->user->HouseId)
            ->when($this->search !== '', function ($query) {
                $query->where(function ($query) {
                    $query
                        ->where('name', 'LIKE', "%$this->search%")
                        ->orWhere('title', 'LIKE', "%$this->search%")
                        ->orWhere('content', 'LIKE', "%$this->search%");
                });
            })
            ->latest()
            ->paginate($this->per_page);

        return view('dash.settings.guest-book.guest-book-list',compact('data'));
    }

}
