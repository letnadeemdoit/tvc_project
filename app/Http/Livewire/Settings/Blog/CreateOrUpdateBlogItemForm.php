<?php

namespace App\Http\Livewire\Settings\Blog;

use App\Models\Blog\Blog;
use App\Models\Blog\BlogComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateOrUpdateBlogItemForm extends Component
{
    use WithFileUploads;

    public $user;

    public $state = [];

    public $file;

    public ?Blog $blogItem;

    protected $listeners = [
        'showBlogCUModal',
    ];

    public function render()
    {
        return view('dash.settings.blog.create-or-update-blog-item-form');
    }

    public function hydrate()
    {
        $this->dispatchBrowserEvent('modal-is-shown');
    }

    public function showBlogCUModal($toggle, ?Blog $blogItem)
    {
//        dd($blogItem);
        $this->emitSelf('toggle', $toggle);
        $this->blogItem = $blogItem;
        $this->reset(['state', 'file']);

        if ($blogItem) {
            $this->state = \Arr::only($blogItem->toArray(), ['Subject', 'Content', 'BlogImage']);
        }
    }

    public function saveBlogItemCU()
    {
        $this->resetErrorBag();
        $user = Auth::user();
        $date = date('Y/m/d H:i:s');
        $inputs = $this->state;

        if ($this->file) {
            $inputs['BlogImage'] = $this->file;
        }else{
            unset($inputs['BlogImage']);
        }
        $slug = str_slug($inputs['Subject']);

        Validator::make($inputs, [
            'Subject' => 'required|string|max:100',
            'BlogImage' => 'nullable|mimes:png,jpg,gif,tiff',
            'Content' => 'required',
        ])->validateWithBag('saveBlogItemCU');

        $this->blogItem->fill([
            'HouseId' => $user->HouseId,
            'Subject' => $inputs['Subject'],
            'Content' => $inputs['Content'],
            'Author' => $user->first_name,
            'BlogDate' => $date,
            'Audit_user_name' => $user->Audit_user_name,
            'Audit_Role' => $user->Audit_Role,
            'Audit_FirstName' => $user->Audit_FirstName,
            'Audit_LastName' => $user->Audit_LastName,
            'Audit_Email' => $user->Audit_Email,
            'slug' => $slug,
        ])->save();

        $this->blogItem->updateFile($this->file, 'BlogImage');

        $this->emitSelf('toggle', false);
        session()->flash('success', 'New Blog Comment Added successfully...');
//        $this->emit('blog-cu-successfully');
    }

    public function updatedFile() {
        $this->validateOnly('file', ['file' => 'required|mimes:png,jpg,gif,tiff']);
    }

    public function deleteFile() {
        if ($this->blogItem->BlogId) {
            $this->blogItem->deleteFile('BlogImage');
            $this->emit('blog-cu-successfully');
        }
    }
}
