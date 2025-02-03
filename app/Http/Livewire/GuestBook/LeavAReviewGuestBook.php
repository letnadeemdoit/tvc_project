<?php

namespace App\Http\Livewire\GuestBook;

use App\Http\Livewire\Traits\Toastr;
use App\Models\GuestBook;
use App\Models\User;
use App\Notifications\GuestBookNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class LeavAReviewGuestBook extends Component
{
    use WithFileUploads;
    use Toastr;

    public $isShowingModal = false;

    public $state = [];
    public $user;
    public $siteUrl = null;

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


        try {
            $this->siteUrl = route('guest.guest-book.index');

            $createdHouseName = $this->user->house->HouseName;
            $ccList = [];
            if ($this->user && primary_user()->email !== $this->user->email) {
                $ccList[] = $this->user->email;
            }

            if (!is_null($this->user->house->guest_book_email_list) && !empty($this->user->house->guest_book_email_list)) {

                $guestBookEmailsList = explode(',', $this->user->house->guest_book_email_list);
                $guestBookEmailsList = array_merge($guestBookEmailsList, $ccList);
                $guestBookEmailsList = array_unique(array_filter($guestBookEmailsList));

                if (count($guestBookEmailsList) > 0 && !empty($guestBookEmailsList)) {
//                    $users = User::whereIn('email', $guestBookEmailsList)->where('HouseId', $this->user->HouseId)->get();
//
//                    foreach ($users as $user) {
//                        $user->notify(new GuestBookNotification($ccList,$inputs['title'],$this->user, $this->siteUrl, $createdHouseName));
//                    }
//                    $guestBookEmailsList = array_diff($guestBookEmailsList, $users->pluck('email')->toArray());

                    if (count($guestBookEmailsList) > 0) {
                        Notification::route('mail', $guestBookEmailsList)
                            ->notify(new GuestBookNotification($ccList,$inputs['title'],$this->user, $this->siteUrl, $createdHouseName));
                    }
                }


            }
        } catch (Exception $e) {

        }




        session()->flash('success', 'Your feedback is submitted successfully...');

        $this->state = "";

        $this->dispatchBrowserEvent('name-updated');

//        $this->success('Blog successfully.');


//        return redirect()->route('guest.guest-book.index');

    }

    public function resetFeedbackForm(){

        $this->reset(['state','file']);

//        $this->file = null;

//        if ($this->file) {
//            $inputs['image'] = ;
//        }
    }

    public function updatedFile() {
        $this->validateOnly('file', ['file' => 'required|mimes:png,jpg,gif,tiff']);
    }

}
