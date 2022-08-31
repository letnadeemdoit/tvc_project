<?php

namespace App\Http\Livewire\Settings\Categories;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\Blog\Blog;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoriesItemList extends Component
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
        'Category-cu-successfully' => '$refresh',
    ];

    public function mount()
    {
        $this->model = Category::class;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $data = Category::where('house_id', $this->user->HouseId)
            ->when($this->user->is_owner_only, function ($query) {
                $query->where('user_id', $this->user->user_id);
            })
            ->when($this->search !== '', function ($query) {
                $query->where(function ($query) {
                    $query
                        ->where('name', 'LIKE', "%$this->search%")
                        ->orWhere('type', 'LIKE', "%$this->search%");
                });
            })

            ->orderBy('id', 'DESC')
            ->paginate($this->per_page);
        return view('dash.settings.category.category-item-list', compact('data'));
    }
}
