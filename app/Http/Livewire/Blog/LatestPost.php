<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog\Blog;
use App\Models\Blog\BlogComment;
use Livewire\Component;

class LatestPost extends Component
{
    public $user;
    public $search;

    public Blog $post;

    public function render()
    {
//        $data = Blog::where('HouseId', $this->user->HouseId)->latest('BlogId')->limit(10)->get();
        $data = Blog::where('HouseId', $this->user->HouseId)
            ->latest('BlogId')
            ->when($this->search !== '', function ($query) {
                $query->where(function ($query) {
                    $query
                        ->where('Subject', 'LIKE', "%$this->search%");
                });
            })
            ->paginate(5);
        return view('blog.latest-post', compact('data'));
    }

}


