<?php

namespace App\Http\Livewire\HouseItems\FoodItem;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\FoodItem;
use App\Models\User;
use App\Notifications\DeleteFoodItemEmailNotification;
use App\Notifications\DeleteNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class FoodItemList extends Component
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
        'food-item-cu-successfully' => '$refresh',
        'destroyed-successfully' => 'destroyedSuccessfully'
    ];

    public function mount()
    {
        $this->model = FoodItem::class;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        $data = FoodItem::where('house_id', $this->user->HouseId)
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

        return view('dash.house-items.food-item-list.food-item-list',compact('data'));
    }

    public function destroyedSuccessfully($data)
    {
        $this->emitSelf('food-item-cu-successfully');

        $title = $data['name'];
        $createdHouseName = $this->user->house->HouseName;
        $isModel = 'Food Item';
        $owner = null;
        if (!empty($data['user_id'])) {
            $owner = User::where('user_id', $data['user_id'])->first();
        }
        $ccList = [];
        if ($owner && primary_user()->email !== $owner->email) {
            $ccList[] = $owner->email;
        }

        try {

//            $users = User::where('HouseId', $this->user->HouseId)->where('role', 'Administrator')->where('is_confirmed', 1)->get();
//
//            foreach ($users as $user) {
//                $user->notify(new DeleteNotification($name,$isAction,$createdHouseName,$isModel));
//            }

            if (!is_null($this->user->house->food_item_list) && !empty($this->user->house->food_item_list)) {

                $foodItemEmailsList = explode(',', $this->user->house->food_item_list);

                if (count($foodItemEmailsList) > 0 && !empty($foodItemEmailsList)) {

//                    $users = User::whereIn('email', $foodItemEmailsList)->where('HouseId', $this->user->HouseId)->get();
//                    foreach ($users as $user) {
//                        $user->notify(new DeleteFoodItemEmailNotification($ccList,$isModel,$title,$this->user,$createdHouseName));
//                    }
//                    $foodItemEmailsList = array_diff($foodItemEmailsList, $users->pluck('email')->toArray());

                    if (count($foodItemEmailsList) > 0) {

                        Notification::route('mail', $foodItemEmailsList)
                            ->notify(new DeleteFoodItemEmailNotification($ccList,$isModel,$title,$this->user,$createdHouseName));

                    }
                }
            }
        } catch (Exception $e) {

        }
    }

    public function destroy($id)
    {
        if ($this->model) {
            $deletableModel = app($this->model)->findOrFail($id);
            $this->emit(
                'destroyable-confirmation-modal',
                $this->model,
                $id,
                $this->destroyableConfirmationContent
            );
        }
    }

}
