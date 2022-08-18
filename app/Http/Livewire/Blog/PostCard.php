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
//        $blog_Likes = $this->post->likes;
//        foreach ($blog_Likes as $like){
//            $this->existing_likes += $like->likes;
//        }

        $blog_views = $this->post->views;
        foreach ($blog_views as $view){
            $this->existing_views += $view->views;
        }

//        if ($this->existing_likes > 0){
//            $this->isExistingUser = true;
//        }
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
