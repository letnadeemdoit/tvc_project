<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog\Blog;
use Livewire\Component;

class PostCard extends Component
{
    public Blog $post;

    public function render()
    {
        dd($this->post->user());
        return view('blog.post-card');
    }
}
