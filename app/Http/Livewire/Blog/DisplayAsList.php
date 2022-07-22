<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog\Blog;
use Livewire\Component;

class DisplayAsList extends Component
{
    public function render()
    {
        $blogs = Blog:: paginate(18);

        return view('dash.blog.display-as.list',compact('blogs'));
    }


    public function destroy($id)
    {
        $blog = Blog::where('BlogId', $id);

        if ($blog) {

            $this->emit('hideModal');

            $this->emit('showToast', 'success!', 'OfferForm Deleted Successfully!');

            session()->flash('success', 'Blog successfully Deleted...');

            $blog->delete();

        }
    }

}
