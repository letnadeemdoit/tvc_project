<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog\Blog;
use Livewire\Component;

class HouseRelatedBlog extends Component
{
    public Blog $house;

    public function render()
    {
        $blogs = Blog::where('BlogId', $this->house->BlogId)->get();
        return view('blog.latest-post', compact('blogs'));
    }
}
