<?php

namespace App\Http\Livewire\LocalGuide;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\LocalGuide;
use App\Models\LocalGuideCategory;
use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class LocalGuideList extends Component
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
        'user-cu-successfully' => '$refresh',
    ];

    public function mount()
    {
        $this->model = LocalGuide::class;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        $data = LocalGuide::where('house_id', $this->user->HouseId)
            ->when($this->search !== '', function ($query) {
                $query->where(function ($query) {
                    $query
                        ->where('title', 'LIKE', "%$this->search%")
                        ->orWhere('address', 'LIKE', "%$this->search%")
                        ->orWhere('datetime', 'LIKE', "%$this->search%");
                });
            })
            ->paginate($this->per_page);

        return view('dash.local-guide.local-guide-list',compact('data'));
    }
}
