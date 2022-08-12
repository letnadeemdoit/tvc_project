<?php

namespace App\Http\Livewire\Blog\BlogCards;

use App\Models\Blog\Blog;
use App\Models\Blog\BlogComment;
use Livewire\Component;

class BlogDetail extends Component
{
    public $BlogId;
    public function mount($BlogId){
        $this->BlogId = $BlogId;
    }
    public function render()
    {
        $blogDetail = Blog::where('BlogId', $this->BlogId)->first();
        return view('blog-details', compact('blogDetail'));
    }
    public function blogDetail($BlogId)
    {
        $blogDetail = Blog::where('BlogId', $BlogId)->first();
        return view('blog-details', compact('blogDetail'));
    }
    public function addBlogComment($blogId)
    {
        dd($blogId);
//        $this->validate();
        $blog = Blog::where('BlogId', $this->BlogId)->first();
        $mydatetime =date("Y-m-d H:i:s");
        BlogComment::create([
            'BlogId'        => $blog->BlogId,
            'HouseId'        => $blog->HouseId,
            'Author'        => $blog->Author,
            'BlogDate'       => $mydatetime,
            'Audit_user_name'        => $blog->Audit_user_name,
            'Audit_Role'        => $blog->Audit_Role,
            'Audit_FirstName'       => $blog->Audit_FirstName,
            'Audit_LastName'      => $blog->Audit_LastName,
            'Audit_Email' => $blog->Audit_Email,
            'Content' => $this->Content,
        ]);
        $this->resetInput();
        $this->emit('hideModal');
        session()->flash('success', 'New Blog Comment Added successfully...');
    }
}
