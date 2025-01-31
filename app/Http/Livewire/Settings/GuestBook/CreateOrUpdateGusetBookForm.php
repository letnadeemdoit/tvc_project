<?php

namespace App\Http\Livewire\Settings\GuestBook;

use App\Http\Livewire\Traits\Toastr;
use App\Models\GuestBook;
use App\Models\User;
use App\Notifications\GuestBookNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateOrUpdateGusetBookForm extends Component
{
    use WithFileUploads;
    use Toastr;

    public $isShowingModal = false;
    public $siteUrl = null;

    public $state = [];

    public $file;

    public $user;

    public $isCreating = false;

    public ?GuestBook $guestBook;

    protected $listeners = [
        'showGuestBookCUModal',
    ];

    public function render()
    {
        return view('dash.settings.guest-book.create-or-update-guest-book-form');
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

//        if ($guestBook->id) {
//            $this->state = \Arr::only($guestBook->toArray(), ['title','name','content','image','status']);
//        }

        if ($guestBook->id) {
            $this->isCreating = false;
            $this->state = \Arr::only($guestBook->toArray(), ['title', 'name', 'content', 'image', 'status']);
        } else {
            $this->isCreating = true;
            $this->state = [];
        }
    }

    public function saveGuestBookCU()
    {
        $this->resetErrorBag();

        $inputs = $this->state;

        if ($this->file) {
            $inputs['image'] = $this->file;
        } else {
            unset($inputs['image']);
        }

        Validator::make($inputs, [
            'name' => 'required|string|max:40',
            'title' => 'required|string|max:80',
            'content' => 'required',
            'image' => 'nullable|mimes:png,jpg,gif,tiff',
        ])->validateWithBag('saveGuestBookCU');

        $this->guestBook->fill([
            'user_id' => auth()->user()->user_id,
            'house_id' => auth()->user()->HouseId,
            'name' => $inputs['name'],
            'title' => $inputs['title'],
            'status' => $inputs['status'] ?? 0,
            'content' => $inputs['content'],
        ])->save();

        $this->guestBook->updateFile($this->file);

        try {
            $this->siteUrl = route('guest.guest-book.index');

            $createdHouseName = $this->user->house->HouseName;
            $ccList = [];
            if ($this->user) {
                $ccList[] = $this->user->email;
            }

            if (!is_null($this->user->house->guest_book_email_list) && !empty($this->user->house->guest_book_email_list) && $this->isCreating) {

                $guestBookEmailsList = explode(',', $this->user->house->guest_book_email_list);
                if (count($guestBookEmailsList) > 0 && !empty($guestBookEmailsList)) {

//                    $users = User::whereIn('email', $guestBookEmailsList)->where('HouseId', $this->user->HouseId)->get();
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

//        try {
//            $items = $this->guestBook;
//            $createdHouseName = auth()->user()->house->HouseName;
//            $isAction = $this->isCreating ? 'created' : 'updated';
//
//            $users = User::where('HouseId', $this->user->HouseId)->where('role', 'Administrator')->where('is_confirmed', 1)->get();
//
//            foreach ($users as $user) {
//                $user->notify(new GuestBookNotification($items, $isAction, $createdHouseName));
//            }
//
//        } catch (Exception $e) {
//
//        }

        $this->emitSelf('toggle', false);

//        $this->success('saved Successfully');
        $this->success('Guest Book ' . ($this->isCreating ? 'created' : 'updated') . ' successfully.');
        $this->emit('guest-book-cu-successfully');
    }

    public function updatedFile()
    {
        $this->validateOnly('file', ['file' => 'required|mimes:png,jpg,gif,tiff']);
    }

    public function deleteFile()
    {
        if ($this->guestBook->id) {
            $this->guestBook->deleteFile();
            $this->emit('guest-book-cu-successfully');
        }
    }

}
