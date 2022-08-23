<?php

namespace App\Http\Livewire\Settings\Categories;

use App\Http\Livewire\Traits\Toastr;
use App\Models\Blog\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateOrUpdateCategoryItem extends Component
{
    use WithFileUploads;
    use Toastr;
    public $user;

    public $state = [];
    public $isCreating = false;
    public $file;

    public ?Category $categoryItem;

    protected $listeners = [
        'showCategoryCUModal',
    ];

    public function render()
    {
        return view('dash.settings.category.create-or-update-category-item');
    }

    public function hydrate()
    {
        $this->dispatchBrowserEvent('modal-is-shown');
    }

    public function showCategoryCUModal($toggle, ?Category $categoryItem)
    {
//        dd($blogItem);
        $this->emitSelf('toggle', $toggle);
        $this->categoryItem = $categoryItem;
        $this->reset(['state', 'file']);

        if ($categoryItem->id) {
            $this->isCreating = false;
            $this->state = \Arr::only($categoryItem->toArray(), ['name', 'type', 'description', 'image']);
        }else{
            $this->isCreating = true;
        }
    }

    public function saveCategoryItemCU()
    {
//        dd($this->state);
        $this->resetErrorBag();
        $date = date('Y/m/d H:i:s');
        $inputs = $this->state;

        if ($this->file) {
            $inputs['image'] = $this->file;
        }else{
            unset($inputs['image']);
        }

        Validator::make($inputs, [
            'name' => 'required|string|max:255',
            'type' => 'required',
            'image' => 'nullable|mimes:png,jpg,gif,tiff',
            'description' => 'required|string|max:255',
        ])->validateWithBag('saveCategoryItemCU');

        $slug = Str::slug($inputs['name']);

        $this->categoryItem->fill([
            'user_id' => $this->user->user_id,
            'house_id' => $this->user->HouseId,
            'name' => $inputs['name'],
            'description' => $inputs['description'],
            'type' => $inputs['type'],
            'slug' => $slug,
        ])->save();

        $this->categoryItem->updateFile($this->file);

        $this->emitSelf('toggle', false);
        $this->emit('Category-cu-successfully');
        $this->success( 'Category ' .($this->isCreating ? 'created' : 'updated'). ' successfully.');
    }

    public function updatedFile() {
        $this->validateOnly('file', ['file' => 'required|mimes:png,jpg,gif,tiff']);
    }

    public function deleteFile() {
        if ($this->categoryItem->id) {
            $this->categoryItem->deleteFile('image');
            $this->emit('Category-deleted-successfully');
        }
    }
}
