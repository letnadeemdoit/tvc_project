<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog\Blog;
use Livewire\Component;

class HouseRelatedBlog extends Component
{
    public Blog $blog;
//    public $existing_likes;
    public $existing_views;

    public function mount() {
        $blog_views = Blog::where('BlogId' ,$this->blog->BlogId)->withCount('views')->first();
        $this->existing_views = $blog_views->views_count;
    }

    public function render()
    {
        return view('blog.house-related-blogs');
    }
}
