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

    public function saveReviewFeedBackGuestBook()
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
        ])->validateWithBag('saveReviewFeedBackGuestBook');

        if (isset($inputs['image'])){
            $inputs['image'] = $this->file->store('guestbooks', 'public');
        }

        GuestBook::create([
            'user_id' => auth()->user()->user_id,
            'house_id' => auth()->user()->HouseId,
            'name' => $inputs['name'],
            'title' => $inputs['title'],
            'status' => $inputs['status'] ?? 0,
            'content' => $inputs['content'],
            'image' => $inputs['image'] ?? null,
        ]);

        session()->flash('success', 'Your feedback is submitted successfully...');

        $this->state = "";

        return redirect()->route('guest.guest-book.index');

    }

    public function resetFeedbackForm(){

        $this->state = "";

    }


    public function updatedFile() {
        $this->validateOnly('file', ['file' => 'required|mimes:png,jpg,gif,tiff']);
    }

}
