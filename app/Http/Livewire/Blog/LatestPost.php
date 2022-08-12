<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog\Blog;
use App\Models\Blog\BlogComment;
use Livewire\Component;

class LatestPost extends Component
{
    public $user;

    public Blog $post;

    public function render()
    {

        $data = Blog::where('HouseId', $this->user->HouseId)->latest('BlogId')->limit(10)->get();

        return view('blog.latest-post', compact('data'));
    }
}
