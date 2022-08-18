<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog\Blog;
use Livewire\Component;

class HouseRelatedBlog extends Component
{
    public Blog $blog;
    public $existing_likes;
    public $existing_views;

    public function mount() {
        $blog_Likes = $this->blog->likes;
        foreach ($blog_Likes as $like){
            $this->existing_likes += $like->likes;
        }

        $blog_views = $this->blog->views;
        foreach ($blog_views as $view){
            $this->existing_views += $view->views;
        }

        if ($this->existing_likes > 0){
            $this->isExistingUser = true;
        }
    }

    public function render()
    {
        return view('blog.house-related-blogs');
    }
}
