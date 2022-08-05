<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog\Blog;
use App\Models\House;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class DisplayAsList extends Component
{
    use WithFileUploads;
    public $Blog_Id, $OldBlogImage, $HouseId, $Subject,$Content ,$BlogImage;

    public $updateMode = false;
    protected $listeners = [
        'openResetBlogForm'
    ];
    public function render()
    {
        $blogs = Blog::orderBy('BlogId','DESC')->paginate(18);
        return view('dash.blog.display-as.list',compact('blogs'));
    }
    public function resetInput()
    {
        $this->Subject = '';
        $this->Content = '';
        $this->OldBlogImage = '';
        $this->BlogImage = '';

    }
    public function openResetBlogForm() {
        $this->resetErrorBag();
        $this->updateMode = false;
        $this->resetInput();
        $this->emit('openModal');
    }
    public function editBlogData($blogId)
    {
        $this->resetErrorBag();
        $blog = Blog::findOrFail($blogId);
            $this->Subject = $blog->Subject;
            $this->Content = $blog->Content;
            $this->OldBlogImage = $blog->BlogImage;
            $this->Blog_Id = $blog->BlogId;
            $this->HouseId = $blog->HouseId;
        $this->updateMode = true;
        $this->emit('openModal');
    }
    protected function rules()
    {
        return [
            'Subject' => 'required|min:5|max:40',
            'Content' => 'required|min:20|max:1000',
            'BlogImage' => 'required',
        ];
    }

    public function updateBlog($Blog_Id){
        $this->validate();
        $path =  $this->BlogImage->store('blog-image', 'public');
        $updateBlog = array(
            'Subject'        => $this->Subject,
            'Content' => $this->Content,
            'BlogImage' => $path,
        );
        $houseid = Auth::user()->HouseId;
        Blog::where('BlogId', $Blog_Id)->where('HouseId', $houseid)->update($updateBlog);
        $this->updateMode = false;
        $this->emit('hideModal');
        session()->flash('success', 'Blog Updated successfully...');
//        return redirect()->to('/blogs');
    }
    public function createBlog()
    {
        $this->validate();
        $user = Auth::user();
        $path =  $this->BlogImage->store('blog-image', 'public');
        $houseData = House::where('HouseId', $user->HouseId)->first();
        $date = date('Y/m/d H:i:s');
        Blog::create([
            'HouseId'       => $user->HouseId,
            'Subject'        => $this->Subject,
            'Content' => $this->Content,
            'Author' => $user->first_name,
            'BlogDate' => $date,
            'Audit_user_name' => $houseData->Audit_user_name,
            'Audit_Role' => $houseData->Audit_Role,
            'Audit_FirstName' => $houseData->Audit_FirstName,
            'Audit_LastName' => $houseData->Audit_LastName,
            'Audit_Email' => $houseData->Audit_Email,
            'BlogImage' => $path,
        ]);
        $this->emit('hideModal');
        session()->flash('success', 'New Blog Created successfully...');
//        return redirect()->to('/blogs');
    }

    public function destroy($id)
    {
        $blog = Blog::where('BlogId', $id);

        if ($blog) {

            $this->emit('hideModal');

            $blog->delete();
            session()->flash('success', 'Blog Deleted successfully...');

        }
    }

}
