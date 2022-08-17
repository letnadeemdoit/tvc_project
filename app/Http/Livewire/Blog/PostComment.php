<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog\Blog;
use App\Models\Blog\BlogComment;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class PostComment extends Component
{
    public $user;

    public Blog $blog;

    public $state = [];

    public function render()
    {
        $BlogComments = BlogComment::where('BlogId', $this->blog->BlogId)->orderBy('CommentId', 'DESC')->get();
        return view('blog.post-comment', compact('BlogComments'));
    }

    public function addBlogComment()
    {
        $this->resetErrorBag();
        $mydatetime =date("Y-m-d H:i:s");
        $inputs = $this->state;
        Validator::make($inputs, [
            'Content' => 'required|max:200',
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
}
