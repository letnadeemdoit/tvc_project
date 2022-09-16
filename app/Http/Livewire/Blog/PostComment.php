<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog\Blog;
use App\Models\Blog\BlogComment;
use App\Models\Blog\BlogNestedComment;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class PostComment extends Component
{
    public $user;

    public ?Blog $blog;


    public $type;

    public $isMoreComments = false;

    public $remainingComments;

    public $totalComments;

    public $showAllComments = false;

    public $newestComment = true;


    public $state = [];

    public function render()
    {
        $blogComments = $this->blog->comments()->count();

        if ($blogComments > 3){
            $this->remainingComments = $blogComments - 3;
            $this->isMoreComments = true;
        }

        if ($this->newestComment){
            if ($this->showAllComments){
                $BlogComments = $this->blog->comments()->orderBy('id', 'DESC')->get();
                $this->isMoreComments = false;
            }
            else{
                $BlogComments = $this->blog->comments()->orderBy('id', 'DESC')->limit(3)->get();
            }
        }
        else
        {
            if ($this->showAllComments){
                $BlogComments = $this->blog->comments()->orderBy('id', 'ASC')->get();
                $this->isMoreComments = false;
            }
            else{
                $BlogComments = $this->blog->comments()->orderBy('id', 'ASC')->limit(3)->get();
            }
        }

        $this->totalComments = $blogComments;

        return view('blog.post-comment', compact('BlogComments'));
    }

    public function addBlogComment()
    {
        $this->resetErrorBag();
        $mydatetime =date("Y-m-d H:i:s");
        $inputs = $this->state;
        Validator::make($inputs, [
            'Content' => 'required|max:255',
        ])->validateWithBag('addBlogComment');

        $comment = new Comment();

        $comment->fill([
            'user_id' => auth()->user()->user_id,
            'house_id' => auth()->user()->HouseId,
            'message' => $inputs['Content'] ?? null,
        ]);

        session()->flash('success', 'Your Comment has been submitted successfully...');

        $this->blog->comments()->save($comment);
        $this->reset('state');
    }
    public function changeType() {
        if ($this->type == 'Newest'){
            $this->newestComment = true;
        }
        else{
            $this->newestComment = false;
        }
    }

    public  function moreComment(){
        $this->showAllComments = true;
    }


    public function addBlogSubComment($commentId){
        $this->resetErrorBag();
        $inputs = $this->state;
        Validator::make($inputs, [
            'nested_content' => 'required|max:1000',
        ])->validateWithBag('addBlogSubComment');

        BlogNestedComment::create([
            'comment_id'        => $commentId,
            'blog_id'        => $this->blog->BlogId,
            'user_id'        => $this->user->user_id ?? null,
            'author'        => $this->user->first_name ?? null,
            'nested_content' => $inputs['nested_content'],
        ]);
        $this->reset('state');

    }
}
