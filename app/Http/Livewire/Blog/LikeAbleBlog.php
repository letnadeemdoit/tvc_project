<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog\Blog;
use App\Models\Likes;
use Illuminate\Http\Request;
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
        $this->existing_likes = count($blog_Likes);
        $user = auth()->user();

        $blog_likes = Likes::where('user_id' ,$user->user_id)->where('likeable_id' ,$this->post->BlogId)->first();
        if ($blog_likes){
            $this->isExistingUser = true;
        }
    }

    public function render()
    {
        return view('blog.like-able-blog');
    }

    public function likeBlog(Request $request){
        $user = auth()->user();
        if ($this->isExistingUser){
            $blog_likes = Likes::where('user_id' ,$user->user_id)->where('likeable_id' ,$this->post->BlogId)->first();
            if ($blog_likes){
                $blog_likes->delete();
                $this->existing_likes = $this->existing_likes-1;
                $this->isExistingUser = false;
            }
            $this->emit('blog-likes-cu-successfully');
        }
        else{
            $blog_likes = Likes::where('user_id' ,$user->user_id)->where('likeable_id' ,$this->post->BlogId)->first();
            if (is_null($blog_likes)){
                $like = new Likes();
                $like->fill([
                    'user_id' => $user->user_id,
                    'ip_address' => $request->getClientIp(),
                    'likes' => 1,
                ]);

                $this->post->likes()->save($like);

                $this->existing_likes = $this->existing_likes+1;
                $this->isExistingUser = true;
            }

            $this->emit('blog-likes-cu-successfully');
        }

    }
}
