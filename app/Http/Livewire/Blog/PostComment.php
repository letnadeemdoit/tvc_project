<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog\Blog;
use App\Models\Blog\BlogComment;
use Livewire\Component;

class PostComment extends Component
{
    public $user;

    public Blog $blog;

    public $state = [];

    public function render()
    {
        $BlogComments = [];
        $comments = BlogComment::where('BlogId', $this->blog->BlogId)->get();
        foreach ($comments as $comment){
            $BlogComments[]= [
                "CommentId" => $comment->CommentId,
                "Content" => $comment->Content,
                "Author" => $comment->Author,
                "BlogDate" => $comment->BlogDate,
            ];
        }
        return view('blog.post-comment', compact('BlogComments'));
    }
    public function addBlogComment()
    {
        $mydatetime =date("Y-m-d H:i:s");
        $inputs = $this->state;
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
        session()->flash('success', 'New Blog Comment Added successfully...');
    }
}
