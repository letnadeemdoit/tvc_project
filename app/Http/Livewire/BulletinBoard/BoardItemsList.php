<?php

namespace App\Http\Livewire\BulletinBoard;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\Board;
use App\Models\Category;
use App\Models\LocalGuide;
use Livewire\Component;
use Livewire\WithPagination;

class BoardItemsList extends Component
{
    use WithPagination;
    use Destroyable;

    public $user;

    public $search = '';

    public $categories;

    public $category = 'all';

    public $page = 1;

    public $per_page = 15;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'per_page' => ['except' => 15],
        'category' => ['except' => 'all'],
    ];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'category-change-cu-successfully' => '$refresh',
    ];

    public function mount()
    {
        $this->model = Board::class;
        $this->categories = Category::where('type', 'bulletin-board')->where('house_id', $this->user->HouseId)->get();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $data = Board::where('HouseId', $this->user->HouseId)
            ->when($this->category !== 'all', function ($query) {
                $query->whereHas('category', function ($query) {
                    $query->where('slug', $this->category);
                });
            })
            ->orderBy('id', 'DESC')
            ->paginate($this->per_page);

        return view('bulletin-board.board-items-list',compact('data'));
    }
}
