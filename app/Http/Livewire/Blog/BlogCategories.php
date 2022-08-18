<?php

namespace App\Http\Livewire\Blog;

use App\Models\Category;
use Livewire\Component;

class BlogCategories extends Component
{
    public function render()
    {
        $categories = Category::where('type', 'blog')->get();
        return view('blog.blog-categories', compact('categories'));
    }
}
