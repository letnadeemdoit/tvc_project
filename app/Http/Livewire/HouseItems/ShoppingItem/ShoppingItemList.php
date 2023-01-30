<?php

namespace App\Http\Livewire\HouseItems\ShoppingItem;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\ShoppingItem;
use App\Models\User;
use App\Notifications\DeleteNotification;
use Livewire\Component;
use Livewire\WithPagination;

class ShoppingItemList extends Component
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
//        'destroyed-successfully' => '$refresh',
        'shopping-item-cu-successfully' => '$refresh',
        'destroyed-successfully' => 'destroyedSuccessfully'
    ];

    public function mount()
    {
        $this->model = ShoppingItem::class;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        $data = ShoppingItem::where('house_id', $this->user->HouseId)
//            ->when($this->user->is_owner_only, function ($query) {
//                $query->where('user_id', $this->user->user_id);
//            })
            ->when($this->search !== '', function ($query) {
                $query->where(function ($query) {
                    $query
                        ->where('name', 'LIKE', "%$this->search%");
                });
            })
            ->paginate($this->per_page);

        return view('dash.house-items.shopping-item-list.shopping-item-list',compact('data'));
    }

    public function destroyedSuccessfully($data)
    {
        $this->emitSelf('food-item-cu-successfully');

        $name = $data['name'];
        $isAction = 'Deleted';
        $createdHouseName = $this->user->house->HouseName;
        $isModel = 'Shopping Item';

        try {

            $users = User::where('HouseId', $this->user->HouseId)->where('role', 'Administrator')->where('is_confirmed', 1)->get();

            foreach ($users as $user) {
                $user->notify(new DeleteNotification($name,$isAction,$createdHouseName,$isModel));
            }
//            if (!is_null(auth()->user()->house->request_to_use_house_email_list) && !empty(auth()->user()->house->request_to_use_house_email_list)) {
//
//                $request_to_use_house_email_list = explode(',', auth()->user()->house->request_to_use_house_email_list);
//
//                if (count($request_to_use_house_email_list) > 0 && !empty($request_to_use_house_email_list)) {
//
////                    $users = User::whereIn('email', $request_to_use_house_email_list)->where('HouseId', auth()->user()->HouseId)->get();
//                    $users = User::where('HouseId', $this->user->HouseId)->where('role', 'Administrator')->where('is_confirmed', 1)->get();
//                    foreach ($users as $user) {
//                        $user->notify(new DeleteNotification($name,$isAction,$createdHouseName,$isModel));
//                    }
//
////                  Notification::send($users, new BlogNotification($items,$blogUrl,$createdHouseName));
//                    $request_to_use_house_email_list = array_diff($request_to_use_house_email_list, $users->pluck('email')->toArray());
//
//                    if (count($request_to_use_house_email_list) > 0) {
//
//                        Notification::route('mail', $request_to_use_house_email_list)
//                            ->notify(new DeleteNotification($name,$isAction,$createdHouseName,$isModel));
//
//                    }
//                }
//
//            }
        } catch (Exception $e) {

        }
    }

}
