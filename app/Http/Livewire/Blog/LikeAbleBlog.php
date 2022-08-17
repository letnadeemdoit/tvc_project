<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog\Blog;
use App\Models\Likes;
use Livewire\Component;

class LikeAbleBlog extends Component
{
    public Blog $post;
    public $existing_likes;

    protected $listeners = [
        'blog-likes-successfully' => '$refresh',
    ];

    public function mount(){
        $blog_Likes = $this->post->likes;
        foreach ($blog_Likes as $like){
            $this->existing_likes += $like->likes;
        }
    }

    public function render()
    {
        return view('blog.like-able-blog');
    }

    public function likeBlog(){
        $user = auth()->user();
        $likes = Likes::where('blog_id', $this->post->BlogId)->where('user_id', $user->user_id)->get();
        if (count($likes) == 0){
            $like = new Likes();

            $like->fill([
                'user_id' => auth()->user()->user_id,
                'blog_id' => $this->post->BlogId,
                'likes' => $this->existing_likes+1,
            ]);

            $this->post->likes()->save($like);
        }
        $this->emit('blog-likes-successfully');

    }
}
