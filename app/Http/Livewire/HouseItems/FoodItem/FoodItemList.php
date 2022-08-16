<?php

namespace App\Http\Livewire\HouseItems\FoodItem;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\FoodItem;
use Livewire\Component;
use Livewire\WithPagination;

class FoodItemList extends Component
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
        'food-item-cu-successfully' => '$refresh',
    ];

    public function mount()
    {
        $this->model = FoodItem::class;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        $data = FoodItem::where('house_id', $this->user->HouseId)
            ->when($this->search !== '', function ($query) {
                $query->where(function ($query) {
                    $query
                        ->where('name', 'LIKE', "%$this->search%");
                });
            })
            ->paginate($this->per_page);

        return view('dash.house-items.food-item-list.food-item-list',compact('data'));
    }

}
