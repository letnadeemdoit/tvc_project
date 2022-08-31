<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog\Blog;
use App\Models\Blog\BlogComment;
use App\Models\Likes;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use App\Http\Livewire\Traits\Toastr;

class PostCard extends Component
{
    public Blog $post;
    use Toastr;
    public $BlogComments = [];
    public $existing_likes;
    public $existing_views;

    protected $listeners = [
        'readBlogComments',
    ];

    public function mount() {
        $blog_views = Blog::where('HouseId' , auth()->user()->HouseId)->where('BlogId' ,$this->post->BlogId)->withCount('views')->first();
        $this->existing_views = $blog_views->views_count;
    }

    public function render()
    {
        return view('blog.post-card');
    }


    public function readBlogComments($BlogId){
        dd($BlogId);
        $this->emit('openModal', $BlogId);
        $this->BlogComments = [];
        $comments = BlogComment::where('BlogId', $BlogId)->get();
        foreach ($comments as $comment){
            $this->BlogComments[]= [
                "CommentId" => $comment->CommentId,
                "Content" => $comment->Content,
                "Author" => $comment->Author,
                "BlogDate" => $comment->BlogDate,
            ];
        }
    }

}
