<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog\Blog;
use App\Models\Blog\BlogComment;
use App\Models\Blog\BlogNestedComment;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class PostComment extends Component
{
    public $user;

    public Blog $blog;


    public $type;

    public $newestComment = true;

    public $oldestComment = false;

    public $state = [];

    public function render()
    {
        if ($this->oldestComment){
            $BlogComments = BlogComment::where('BlogId', $this->blog->BlogId)->orderBy('CommentId', 'ASC')->get();
        }
        else
        {
            $BlogComments = BlogComment::where('BlogId', $this->blog->BlogId)->orderBy('CommentId', 'DESC')->get();
        }
        return view('blog.post-comment', compact('BlogComments'));
    }

    public function addBlogComment()
    {
        $this->resetErrorBag();
        $mydatetime =date("Y-m-d H:i:s");
        $inputs = $this->state;
        Validator::make($inputs, [
            'Content' => 'required|max:1000',
        ])->validateWithBag('addBlogComment');

        BlogComment::create([
            'BlogId'        => $this->blog->BlogId,
            'HouseId'        => $this->blog->HouseId,
            'Author'        => $this->blog->Author,
            'BlogDate'       => $mydatetime,
            'Audit_user_name'        => $this->blog->Audit_user_name,
            'Audit_Role'        => $this->blog->Audit_Role,
            'Audit_FirstName'       => $this->blog->Audit_FirstName,
            'Audit_LastName'      => $this->blog->Audit_LastName,
            'Audit_Email' => $this->blog->Audit_Email,
            'Content' => $inputs['Content'],
        ]);
        $this->reset('state');
    }
    public function changeType() {
        if ($this->type == 'Newest'){
            $this->newestComment = true;
            $this->oldestComment = false;
        }
        else{
            $this->newestComment = false;
            $this->oldestComment = true;
        }
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
