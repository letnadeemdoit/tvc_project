<?php

namespace App\Http\Livewire\Settings\Blog;

use App\Models\Blog\Blog;
use App\Http\Livewire\Traits\Toastr;
use App\Models\Blog\BlogComment;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateOrUpdateBlogItemForm extends Component
{
    use WithFileUploads;
    use Toastr;
    public $user;

    public $state = [];
    public $isCreating = false;
    public $file;

    public $blogCategories;

    public ?Blog $blogItem;

    protected $listeners = [
        'showBlogCUModal',
    ];
    public function mount() {
        $this->blogCategories = Category::where('type', 'blog')->get();
    }

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

        if ($blogItem->BlogId) {
            $this->isCreating = false;
            $this->state = \Arr::only($blogItem->toArray(), ['Subject', 'Content', 'image']);
        }else{
            $this->isCreating = true;
        }
    }

    public function saveBlogItemCU()
    {
        $this->resetErrorBag();
        $date = date('Y/m/d H:i:s');
        $inputs = $this->state;

        if ($this->file) {
            $inputs['image'] = $this->file;
        }else{
            unset($inputs['image']);
        }

        Validator::make($inputs, [
            'Subject' => 'required|string|max:255',
            'image' => 'nullable|mimes:png,jpg,gif,tiff',
            'Content' => 'required',
        ])->validateWithBag('saveBlogItemCU');

        $slug = Str::slug($inputs['Subject']);

        $this->blogItem->fill([
            'HouseId' => $this->user->HouseId,
            'Subject' => $inputs['Subject'],
            'Content' => $inputs['Content'],
            'Author' => $this->user->first_name,
            'BlogDate' => $date,
            'Audit_user_name' => $this->user->Audit_user_name,
            'Audit_Role' => $this->user->Audit_Role,
            'Audit_FirstName' => $this->user->Audit_FirstName,
            'Audit_LastName' => $this->user->Audit_LastName,
            'Audit_Email' => $this->user->Audit_Email,
            'category_id' => $inputs['category_id'] ?? null,
            'slug' => $slug,
        ])->save();

        $this->blogItem->updateFile($this->file);

        $this->emitSelf('toggle', false);
        $this->emit('blog-cu-successfully');

        $this->success( 'Blog ' .($this->isCreating ? 'created' : 'updated'). ' successfully.');
    }

    public function updatedFile() {
        $this->validateOnly('file', ['file' => 'required|mimes:png,jpg,gif,tiff']);
    }

    public function deleteFile() {
        if ($this->blogItem->BlogId) {
            $this->blogItem->deleteFile('image');
            $this->emit('blog-deleted-successfully');
        }
    }
}
