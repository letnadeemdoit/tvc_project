<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog\Blog;
use App\Models\Blog\BlogComment;
use Livewire\Component;

class PostCard extends Component
{
    public Blog $post;
    public $BlogComments = [];

    protected $listeners = [
        'readBlogComments',
    ];

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
