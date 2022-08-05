<?php

namespace App\Http\Livewire\Blog\BlogCards;

use App\Models\Blog\Blog;
use App\Models\Blog\BlogComment;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class Blogs extends Component
{
    public $Content ,$BlogComments = [], $BlogId;
    public function mount()
    {

    }
    public function render()
    {
        $blogs = Blog:: paginate(20);
        return view('livewire.blog.blog-cards.blogs',compact('blogs'));
    }
    protected function rules()
    {
        return [
            'Content' => 'required',
        ];
    }
    public function readBlogComments($blogId){
        $this->BlogId = $blogId;
        $this->BlogComments = [];
        $comments = BlogComment::where('BlogId', $blogId)->get();
        foreach ($comments as $comment){
            $this->BlogComments[]= [
                "CommentId" => $comment->CommentId,
                "Content" => $comment->Content,
                "Author" => $comment->Author,
                "BlogDate" => $comment->BlogDate,
            ];
        }
    }
    public function getBlogId($BlogId){
        $this->BlogId = $BlogId;
    }
    public function addBlogComment()
    {
        $this->validate();
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
        $this->emit('hideModal');
        session()->flash('success', 'New Blog Comment successfully...');
    }

    public function destroy($id)
    {
        $blog = Blog::where('BlogId', $id)->first();
        if($blog) {
            $blog->delete();
        }
        $blogcomments = BlogComment::where('BlogId', $id)->get();
        if ($blogcomments){
            foreach ($blogcomments as $blogcomment)
            $blogcomment->delete();
        }
        $this->emit('hideModal');
        return redirect()->to('/blog-cards');
        $this->emit('showToast', 'Success!', 'board Deleted Successfully!');
    }
    public function deleteComment($CommentId)
    {
        $comment = BlogComment::where('CommentId', $CommentId)->first();
        if($comment) {
            $comment->delete();
        }
        $this->emit('hideModal');
        return redirect()->to('/blog-cards');
    }
}
