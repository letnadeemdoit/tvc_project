<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog\Blog;
use App\Models\House;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DisplayAsList extends Component
{
    public $Blog_Id, $HouseId, $Subject,$Content;

    public $updateMode = false;
    protected $listeners = [
        'openResetBlogForm'
    ];

    public function render()
    {
        $blogs = Blog:: paginate(18);

        return view('dash.blog.display-as.list',compact('blogs'));
    }
    public function resetInput()
    {
        $this->Subject = '';
        $this->Content = '';
    }
    public function openResetBlogForm() {
        $this->updateMode = false;
        $this->resetInput();
        $this->emit('openModal');
    }
    public function editBlogData($blogId)
    {
        $blog = Blog::findOrFail($blogId);
            $this->Subject = $blog->Subject;
            $this->Content = $blog->Content;
            $this->Blog_Id = $blog->BlogId;
            $this->HouseId = $blog->HouseId;
        $this->updateMode = true;
        $this->emit('openModal');
    }
    protected function rules()
    {
        return [
            'Subject' => 'required',
            'Content' => 'required',
        ];
    }

    public function updateBlog($Blog_Id){
        $this->validate();
        $updateBlog = array(
            'Subject'        => $this->Subject,
            'Content' => $this->Content,
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
        $houseid = Auth::user()->HouseId;
        $houseData = House::where('HouseId', $houseid)->first();
        $date = date('Y/m/d H:i:s');
        Blog::create([
            'HouseId'       => $houseid,
            'Subject'        => $this->Subject,
            'Content' => $this->Content,
            'Author' => 'james',
            'BlogDate' => $date,
            'Audit_user_name' => $houseData->Audit_user_name,
            'Audit_Role' => $houseData->Audit_Role,
            'Audit_FirstName' => $houseData->Audit_FirstName,
            'Audit_LastName' => $houseData->Audit_LastName,
            'Audit_Email' => $houseData->Audit_Email,
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
