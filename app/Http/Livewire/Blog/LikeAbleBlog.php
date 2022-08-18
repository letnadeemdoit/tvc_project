<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog\Blog;
use App\Models\Likes;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Http\Livewire\Traits\Toastr;

class LikeAbleBlog extends Component
{
    public Blog $post;
    use Toastr;
    public $isExistingUser = false;

    public $existing_likes;

    protected $listeners = [
        'blog-likes-cu-successfully' => '$refresh',
    ];

    public function mount(){
        $blog_Likes = $this->post->likes;
        foreach ($blog_Likes as $like){
            $this->existing_likes += $like->likes;
        }
        $likes = Likes::where('blog_id', $this->post->BlogId)->where('user_id', Auth::user()->user_id)->first();
        if ($likes){
            $this->isExistingUser = true;
        }
    }

    public function render()
    {
        return view('blog.like-able-blog');
    }

    public function likeBlog(){
        $user = auth()->user();
        if ($this->isExistingUser){
            $likes = Likes::where('blog_id', $this->post->BlogId)->where('user_id', $user->user_id)->first();
            if ($likes){
                $likes->delete();
                $this->existing_likes = $this->existing_likes-1;
                $this->isExistingUser = false;
            }
            $this->emit('blog-likes-cu-successfully');
        }
        else{
            $likes = Likes::where('blog_id', $this->post->BlogId)->where('user_id', $user->user_id)->get();
            if (count($likes) == 0){
                $like = new Likes();
                $like->fill([
                    'user_id' => auth()->user()->user_id,
                    'blog_id' => $this->post->BlogId,
                    'likes' => $this->existing_likes+1,
                ]);

                $this->post->likes()->save($like);

                $this->existing_likes = $this->existing_likes+1;
                $this->isExistingUser = true;
            }

            $this->emit('blog-likes-cu-successfully');
        }

    }
}
