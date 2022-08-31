<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog\Blog;
use App\Models\BlogViews;
use Livewire\Component;

class HouseRelatedBlog extends Component
{
    public Blog $blog;
    public $existing_views;

    public function mount() {
        $blog_views = BlogViews::where('user_id' ,auth()->user()->user_id)->where('viewable_id' ,$this->blog->BlogId)->get();
        if ($blog_views)
            $this->existing_views = count($blog_views);
    }

    public function render()
    {
        return view('blog.house-related-blogs');
    }
}
