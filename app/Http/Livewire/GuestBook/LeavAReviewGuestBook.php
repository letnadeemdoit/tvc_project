<?php

namespace App\Http\Livewire\GuestBook;

use App\Http\Livewire\Traits\Toastr;
use App\Models\GuestBook;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class LeavAReviewGuestBook extends Component
{
    use WithFileUploads;
    use Toastr;

    public $isShowingModal = false;

    public $state = [];

    public $file;

    public ?GuestBook $guestBook;


    public function render()
    {
        return view('guest-book.leave-a-review-guest-book');
    }

    public function leaveReviewGuestBookCUModal()
    {

        $this->resetErrorBag();

        $inputs = $this->state;

        if ($this->file) {
            $inputs['image'] = $this->file;
        }else{
            unset($inputs['image']);
        }

        Validator::make($inputs, [
            'name' => 'required',
            'title' => 'required|string|max:100',
            'content' => 'required',
            'image' => 'nullable|mimes:png,jpg,gif,tiff',
        ])->validateWithBag('leaveReviewGuestBookCUModal');

        GuestBook::create([
            'user_id' => auth()->user()->user_id,
            'house_id' => auth()->user()->HouseId,
            'name' => $inputs['name'].' '.$inputs['last_name'] ?? null,
            'title' => $inputs['title'],
            'status' => $inputs['status'] ?? 0,
            'content' => $inputs['content'],
        ]);

        return redirect()->route('guest.guest-book.index');

//        $this->guestBook->updateFile($this->file);

//        $this->success('saved Successfully');

    }

    public function updatedFile() {
        $this->validateOnly('file', ['file' => 'required|mimes:png,jpg,gif,tiff']);
    }

}
