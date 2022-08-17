<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog\Blog;
use App\Models\Blog\BlogComment;
use App\Models\Likes;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class PostCard extends Component
{
    public Blog $post;
    public $BlogComments = [];
    public $existing_likes;

    protected $listeners = [
        'readBlogComments',
    ];

    public function render()
    {
        $blog_Likes = $this->post->likes;
        foreach ($blog_Likes as $like){
            $this->existing_likes += $like->likes;
        }
        return view('blog.post-card');
    }


    public function likeBlog($blogId){
        $this->existing_likes = 0;
        $likes = Likes::where('blog_id', $blogId)->get();
        foreach ($likes as $like){
            $existing_likes += $like->likes;
        }
        $like = new Likes();

        $like->fill([
            'user_id' => auth()->user()->user_id,
            'blog_id' => $this->post->BlogId,
            'likes' => $existing_likes+1,
        ]);

        $this->post->likes()->save($like);

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
