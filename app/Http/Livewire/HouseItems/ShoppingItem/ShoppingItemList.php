<?php

namespace App\Http\Livewire\HouseItems\ShoppingItem;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\ShoppingItem;
use Livewire\Component;
use Livewire\WithPagination;

class ShoppingItemList extends Component
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
        'shopping-item-cu-successfully' => '$refresh',
    ];

    public function mount()
    {
        $this->model = ShoppingItem::class;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        $data = ShoppingItem::where('house_id', $this->user->HouseId)
            ->when($this->search !== '', function ($query) {
                $query->where(function ($query) {
                    $query
                        ->where('name', 'LIKE', "%$this->search%");
                });
            })
            ->paginate($this->per_page);

        return view('dash.house-items.shopping-item-list.shopping-item-list',compact('data'));
    }

}
