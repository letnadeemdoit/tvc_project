<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog\Blog;
use App\Models\House;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class DisplayAsList extends Component
{
    use WithFileUploads;
    public $searchQuery, $Blog_Id, $OldBlogImage, $HouseId, $Subject,$Content ,$BlogImage,$imagepath=null;

    public $updateMode = false;
    protected $listeners = [
        'openResetBlogForm',
    ];
    public function render()
    {

        $blogs = Blog::query()
            ->where('Subject', 'like', '%'.$this->searchQuery.'%')
            ->orWhere('Author', 'like', '%'.$this->searchQuery.'%')
            ->orWhere('Audit_Email', 'like', '%'.$this->searchQuery.'%')
            ->orWhere('Audit_FirstName', 'like', '%'.$this->searchQuery.'%')
            ->orderBy('BlogId','DESC')->paginate(18);
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
        $this->resetInput();
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
            'BlogImage' => 'required|image|max:1024',
        ];
    }

    public function updateBlog($Blog_Id){
        if (isset($this->BlogImage) && !empty($this->BlogImage)){
            $this->imagepath = $this->BlogImage->store('blog-image', 'public');
        }
        else{
            $this->imagepath =  $this->OldBlogImage;
        }
        $this->validate();
        $updateBlog = array(
            'Subject'        => $this->Subject,
            'Content' => $this->Content,
            'BlogImage' => $this->imagepath,
        );
        $houseid = Auth::user()->HouseId;
        Blog::where('BlogId', $Blog_Id)->where('HouseId', $houseid)->update($updateBlog);
        $this->updateMode = false;
        $this->emit('hideModal');
        session()->flash('success', 'Blog Updated successfully...');
    }
    public function createBlog()
    {
        $this->resetErrorBag();
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
    }

    public function destroy($id)
    {
        $blog = Blog::where('BlogId', $id);

        if ($blog) {

            $this->emit('hideModal');

            $blog->delete();
            session()->flash('success', 'Blog Deleted successfully...');
            return redirect()->to('/blogs');

        }
    }

}
