<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class BlogList extends Component
{
    use WithPagination;

    public $user;

    public $search;
    public $page = 1;
    public $per_page = 10;

    public $categories;

    public $category = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'per_page' => ['except' => 10],
        'category' => ['except' => 'all'],
    ];
    protected $listeners = [
        'category-change-cu-successfully' => '$refresh',
    ];


    public function mount()
    {
        $this->model = Blog::class;
        $this->categories = Category::where('type', 'blog')->where('house_id', $this->user->HouseId)->get();
    }
    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function changeCategory($category) {
        $this->emit('category-change-cu-successfully');
        $this->category = $category['slug'];
    }

    public function allCategory() {
        $this->emit('category-change-cu-successfully');
        $this->category = 'all';
    }

    public function getCategoriesProperty() {
        return Category::blog()->get();
    }

    public function render()
    {
        $data = Blog::where('HouseId', $this->user->HouseId)
            ->when($this->category !== 'all', function ($query) {
                $query->whereHas('category', function ($query) {
                   $query->where('slug', $this->category);
                });
            })
            ->orderBy('BlogId', 'DESC')
            ->paginate($this->per_page);

        return view('blog.blog-list', compact('data'));
    }
}
