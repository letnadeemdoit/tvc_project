<?php

namespace App\Http\Livewire\Settings\GuestBook;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\Board;
use App\Models\Guest;
use App\Models\GuestBook;
use App\Models\User;
use App\Notifications\DeleteGuestBookEmailNotification;
use App\Notifications\DeleteNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class GuestBookList extends Component
{
    use WithPagination;
    use Destroyable;

    public $user;

    public $search = '';

    public $page = 1;

    public $per_page = 15;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'per_page' => ['except' => 15],
    ];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'destroyed-successfully' => 'destroyedSuccessfully',
//        'destroyed-successfully' => '$refresh',
        'guest-book-cu-successfully' => '$refresh',
    ];

    public function mount()
    {
        $this->model = GuestBook::class;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        $data = GuestBook::where('house_id', $this->user->HouseId)
            ->when($this->search !== '', function ($query) {
                $query->where(function ($query) {
                    $query
                        ->where('name', 'LIKE', "%$this->search%")
                        ->orWhere('title', 'LIKE', "%$this->search%")
                        ->orWhere('content', 'LIKE', "%$this->search%");
                });
            })
            ->latest()
            ->paginate($this->per_page);

        return view('dash.settings.guest-book.guest-book-list',compact('data'));
    }

    public function destroyedSuccessfully($data)
    {
        $this->emitSelf('guest-book-cu-successfully');

        $title = $data['title'];
        $createdHouseName = $this->user->house->HouseName;
        $isModel = 'Guest Book';
        $owner = null;
        if (!empty($data['user_id'])) {
            $owner = User::where('user_id', $data['user_id'])->first();
        }
        $ccList = [];
        if ($owner && $owner->email) {
            $ccList[] = $owner->email;
        }

        try {
//            $users = User::where('HouseId', $this->user->HouseId)->where('role', 'Administrator')->where('is_confirmed', 1)->get();
//
//            foreach ($users as $user) {
//                $user->notify(new DeleteNotification($name,$isAction,$createdHouseName,$isModel));
//            }
            if (!is_null($this->user->house->guest_book_email_list) && !empty($this->user->house->guest_book_email_list)) {

                $guestBookEmailsList = explode(',', $this->user->house->guest_book_email_list);

                if (count($guestBookEmailsList) > 0 && !empty($guestBookEmailsList)) {

//                    $users = User::whereIn('email', $guestBookEmailsList)->where('HouseId', $this->user->HouseId)->get();
//
//                    foreach ($users as $user) {
//                        $user->notify(new DeleteGuestBookEmailNotification($ccList,$isModel,$title,$this->user,$createdHouseName));
//                    }
//
//                    $guestBookEmailsList = array_diff($guestBookEmailsList, $users->pluck('email')->toArray());

                    if (count($guestBookEmailsList) > 0) {

                        Notification::route('mail', $guestBookEmailsList)
                            ->notify(new DeleteGuestBookEmailNotification($ccList,$isModel,$title,$this->user,$createdHouseName));

                    }
                }
            }
        } catch (Exception $e) {

        }
    }

}
