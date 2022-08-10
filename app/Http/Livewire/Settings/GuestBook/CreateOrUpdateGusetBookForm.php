<?php

namespace App\Http\Livewire\Settings\GuestBook;

use App\Models\GuestBook;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateOrUpdateGusetBookForm extends Component
{
    use WithFileUploads;

    public $isShowingModal = false;

    public $state = [];

    public $file;

    public ?GuestBook $guestBook;

    protected $listeners = [
        'showGuestBookCUModal',
    ];

    public function render()
    {
        return view('dash.settings.guest-book.create-or-update-guest-book-form') ;
    }

    public function hydrate()
    {
        $this->dispatchBrowserEvent('modal-is-shown');
    }

    public function showGuestBookCUModal($toggle, ?GuestBook $guestBook)
    {
        $this->emitSelf('toggle', $toggle);
        $this->guestBook = $guestBook;
        $this->reset(['state', 'file']);

        if ($guestBook) {
            $this->state = \Arr::only($guestBook->toArray(), ['title','name','content','image','status']);
        }
    }

    public function saveGuestBookCU()
    {
        $this->resetErrorBag();

        $inputs = $this->state;

        if ($this->file) {
            $inputs['image'] = $this->file;
        }

        Validator::make($inputs, [
            'name' => 'required',
            'title' => 'required|string|max:100',
            'content' => 'required',
            'image' => 'nullable|mimes:png,jpg,gif,tiff',
        ])->validateWithBag('saveGuestBookCU');

        $this->guestBook->fill([
            'user_id' => auth()->user()->user_id,
            'house_id' => auth()->user()->HouseId,
            'name' => $inputs['name'],
            'title' => $inputs['title'],
            'status' => $inputs['status'],
            'content' => $inputs['content'],
        ])->save();

        $this->guestBook->updateFile($this->file);

        $this->emitSelf('toggle', false);

        $this->emit('user-cu-successfully');
    }

    public function updatedFile() {
        $this->validateOnly('file', ['file' => 'required|mimes:png,jpg,gif,tiff']);
    }

    public function deleteFile() {
        if ($this->guestBook->id) {
            $this->guestBook->deleteFile();
            $this->emit('user-cu-successfully');
        }
    }

}
