<?php

namespace App\Http\Livewire\Blog\BlogCards;

use App\Models\Blog\Blog;
use App\Models\Blog\BlogComment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class Blogs extends Component
{
    public $Content ,$BlogComments = [], $BlogId, $userimage;
    protected $listeners = [
        'readBlogComments'
    ];
    public function mount()
    {
        $user = Auth::user();
        $this->userimage = $user->profile_photo_path;

    }
    public function render()
    {
        $blogs = Blog::orderBy('BlogId','DESC')->paginate(20);
        return view('livewire.blog.blog-cards.blogs',compact('blogs'));
    }
    public function resetInput()
    {
        $this->Content = '';
    }
    protected function rules()
    {
        return [
            'Content' => 'required',
        ];
    }
    public function readBlogComments($BlogId){
        $this->BlogId = $BlogId;
        $this->emit('openModal', $this->BlogId);
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
    public function getBlogId($BlogId){
        $this->BlogId = $BlogId;
    }
    public function addBlogComment()
    {
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
//        return redirect()->to('/blog-cards');
        session()->flash('success', 'Blog Deleted successfully...');
    }
    public function deleteComment($CommentId)
    {
        $comment = BlogComment::where('CommentId', $CommentId)->first();
        if($comment) {
            $comment->delete();
        }
        $this->emit('hideModal');
        session()->flash('success', 'Blog Comment Deleted successfully...');
//        return redirect()->to('/blog-cards');
    }
}
