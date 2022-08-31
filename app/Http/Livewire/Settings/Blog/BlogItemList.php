<?php

namespace App\Http\Livewire\Settings\Blog;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\Blog\Blog;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class BlogItemList extends Component
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
        'blog-cu-successfully' => '$refresh',
        'destroyed-successfully' => '$refresh',
    ];

    public function mount()
    {
        $this->model = Blog::class;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $data = Blog::where('HouseId', $this->user->HouseId)
            ->when($this->user->is_owner, function ($query) {
                $query->where('user_id', $this->user->user_id);
            })
            ->when($this->search !== '', function ($query) {
                $query->where(function ($query) {
                    $query
                        ->where('Subject', 'LIKE', "%$this->search%");
                });
            })

            ->orderBy('BlogId', 'DESC')
            ->paginate($this->per_page);
        return view('dash.settings.blog.blog-items-list', compact('data'));
    }
}
