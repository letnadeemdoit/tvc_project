<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog\Blog;
use Livewire\Component;

class BlogList extends Component
{
    public $search;
    public $user;
    public $page = 1;
    public $per_page = 15;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'per_page' => ['except' => 15],
    ];

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        dd($this->user);
        $blog = Blog::where('HouserId', $this->user->house_id)->orderBy('BlogId', 'DESC')
            ->paginate($this->per_page);
        return view('blog.blog-list', 'blog');
    }
}
