<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog\Blog;
use App\Models\Blog\BlogComment;
use App\Models\BlogViews;
use App\Models\Likes;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Http\Livewire\Traits\Toastr;

class PostCard extends Component
{
    public Blog $post;

    use Toastr;
    public $BlogComments = [];
    public $existing_likes;
    public $existing_views;
    public $blogcomments;

    protected $listeners = [
        'readBlogComments',
    ];

    public function mount() {
        $blog_views = BlogViews::where('viewable_id' ,$this->post->BlogId)->distinct(['ip_address','user_id'])->count();
        if ($blog_views){
            $this->existing_views = $blog_views;
        }
        $this->blogcomments = $this->post->comments()->count();
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
