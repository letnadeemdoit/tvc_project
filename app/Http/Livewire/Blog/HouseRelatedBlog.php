<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog\Blog;
use App\Models\BlogViews;
use Livewire\Component;
use Illuminate\Http\Request;

class HouseRelatedBlog extends Component
{
    public Blog $blog;
    public $existing_views;
    public $blogcomments;

    public function mount(Request $request) {
        $blog_views = BlogViews::where('viewable_id' ,$this->blog->BlogId)->distinct(['ip_address','user_id'])->count();
        if ($blog_views){
            $this->existing_views = $blog_views;
        }
        $this->blogcomments = $this->blog->comments()->count();
    }

    public function render()
    {
        return view('blog.house-related-blogs');
    }
}
