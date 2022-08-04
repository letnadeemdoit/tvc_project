<?php

namespace App\Http\Livewire\GuestBook\DisplayAs;
use App\Models\GuestBook;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
class BookList extends Component
{
    use WithFileUploads;
    public $image,$bookId, $title, $name, $content,$oldImage;
    public $updateMode = false;
    protected $listeners = [
        'openResetForm'
    ];

    public function render()
    {
        $bookdata = GuestBook::paginate(12);
        return view('dash.guest-book.display-as.list', compact('bookdata'));
    }
    public function resetInput()
    {
        $this->title = '';
        $this->name = '';
        $this->content = '';
        $this->oldImage = '';
        $this->image = '';
        $this->bookId = '';
    }
    public function openResetForm() {
        $this->updateMode = false;
        $this->resetInput();
        $this->emit('openModal');
    }
    protected function rules()
    {
        return [
            'title' => 'required',
            'name' => 'required',
            'content' => 'required',
            'image' => 'required'
        ];
    }
    public function addGuestBook(){
        $this->validate();
        $path =  $this->image->store('guest-books', 'public');
        $user_id = Auth::user()->user_id;
        $house_id = Auth::user()->HouseId;
        GuestBook::create([
            'user_id'       => $user_id,
            'house_id'       => $house_id,
            'title'        => $this->title,
            'name'        => $this->name,
            'content' => $this->content,
            'image' => $path,
        ]);
        $this->emit('hideModal');
        session()->flash('success', 'New Content Created successfully...');

    }

    public function editGuestBook($bookid){
        $GuestBook = GuestBook::findOrFail($bookid);
        if ($GuestBook){
            $this->title = $GuestBook["title"];
            $this->name = $GuestBook["name"];
            $this->content = $GuestBook["content"];
            $this->oldImage = $GuestBook["image"];
            $this->bookId = $GuestBook["id"];
        }
        else{
            return redirect()->to('/guest-book');
        }
        $this->updateMode = true;
        $this->emit('openModal');
    }
    public function updateGuestBook($bookid){
        $this->validate();
        $path =  $this->image->store('public');
        $user_id = Auth::user()->user_id;
        $house_id = Auth::user()->HouseId;
        $updateBook = array(
            'user_id'       => $user_id,
            'house_id'       => $house_id,
            'title'        => $this->title,
            'name'        => $this->name,
            'content' => $this->content,
            'image' => $path,
        );
        GuestBook::where('id', $bookid)->update($updateBook);
        $this->emit('hideModal');
        session()->flash('success', 'Content updated successfully...');
        return redirect()->to('/guest-book');
        $this->updateMode = false;

    }



    public function destroy($id)
    {
        $book = GuestBook::where('id', $id)->first();

        if ($book) {
            $book->delete();
            $this->emit('hideModal');
            session()->flash('success', 'Content Deleted successfully...');
        }
    }
}
