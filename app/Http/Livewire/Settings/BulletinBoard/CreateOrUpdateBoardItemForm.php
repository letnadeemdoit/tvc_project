<?php

namespace App\Http\Livewire\Settings\BulletinBoard;

use App\Http\Livewire\Traits\Toastr;
use App\Models\Board;
use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateOrUpdateBoardItemForm extends Component
{
    use WithFileUploads;
    use Toastr;

    public $user;

    public $state = [];

    public $file;

    public ?Board $boardItem;

    protected $listeners = [
        'showBulletinBoardCUModal',
//        'refresh-cu' => '$refresh',
    ];

    public function render()
    {
        $categories = Category::where('type', 'bulletin-board')->where('house_id', $this->user->HouseId)->get();

        return view('dash.settings.bulletin-board.create-or-update-board-item-form', compact('categories'));
    }

    public function hydrate()
    {
        $this->dispatchBrowserEvent('modal-is-shown');
    }

    public function showBulletinBoardCUModal($toggle, ?Board $boardItem)
    {
//        $this->emitSelf('refresh-cu');

        $this->emitSelf('toggle', $toggle);
        $this->boardItem = $boardItem;
        $this->reset(['state', 'file']);

        if ($boardItem->id) {
            $this->state = \Arr::only($boardItem->toArray(), ['title', 'image','category_id', 'Board']);
        }
    }

    public function saveBulletinBoardCU()
    {
        $this->resetErrorBag();

        $inputs = $this->state;

        if ($this->file) {
            $inputs['image'] = $this->file;
        } else {
            unset($inputs['image']);
        }

        Validator::make($inputs, [
            'title' => 'required|string|max:100',
            'image' => 'nullable|mimes:png,jpg,gif,tiff',
//            'category_id' => 'nullable|exists:categories,id',
            'category_id' => 'required',
            'Board' => 'required|max:60000',
        ])->validateWithBag('saveBulletinBoardCU');

        $this->boardItem->fill([
            'HouseId' => auth()->user()->HouseId,
            'title' => $inputs['title'] ?? '',
            'category_id' => $inputs['category_id'] ?? null,
            'Board' => $inputs['Board'],
        ])->save();

        $this->boardItem->updateFile($this->file);

        $this->emitSelf('toggle', false);

        $this->success('saved Successfully');

        $this->emit('bulletin-board-cu-successfully');
    }

    public function updatedFile()
    {
        $this->validateOnly('file', ['file' => 'required|mimes:png,jpg,gif,tiff']);
    }

    public function deleteFile()
    {
        if ($this->boardItem->id) {
            $this->boardItem->deleteFile();
            $this->success('Image deleted Successfully');
            $this->emit('bulletin-board-cu-successfully');
        }
    }

}
