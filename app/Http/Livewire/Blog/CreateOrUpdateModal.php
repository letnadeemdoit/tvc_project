<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog\Blog;
use Livewire\Component;

class CreateOrUpdateModal extends Component
{

    public $state = [];

    protected $rules = [
        'state.Author' => 'required',
        'state.Subject' => 'required',
        'state.Content' => 'required',
    ];

    public function createBlog()
    {
//        dd("ok");

        $this->validate();

        Blog::create([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        return redirect()->to('/blogs');
    }


    public function render()
    {
        return view('dash.blog.create-or-update-modal');
    }


}
