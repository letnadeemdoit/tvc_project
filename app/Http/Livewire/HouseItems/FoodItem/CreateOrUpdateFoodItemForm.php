<?php

namespace App\Http\Livewire\HouseItems\FoodItem;

use App\Http\Livewire\Traits\Toastr;
use App\Models\FoodItem;
use App\Models\User;
use App\Notifications\FoodItemsNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateOrUpdateFoodItemForm extends Component
{

    use WithFileUploads;
    use Toastr;

    public $isShowingModal = false;

    public $user;

    public $isCreating = false;

    public $state = [];

    public $file;

    public ?FoodItem $foodItemList;

    protected $listeners = [
        'showFoodItemCUModal',
    ];

    public function render()
    {
        return view('dash.house-items.food-item-list.create-or-update-food-item-form');
    }

    public function hydrate()
    {
        $this->dispatchBrowserEvent('modal-is-shown');
    }

    public function showFoodItemCUModal($toggle, ?FoodItem $foodItemList)
    {
        $this->emitSelf('toggle', $toggle);
        $this->foodItemList = $foodItemList;
        $this->file = null;

        if ($foodItemList->id) {
            $this->isCreating = false;
            $this->state = \Arr::only($foodItemList->toArray(), ['user_id', 'house_id', 'name', 'location', 'expiration_date']);
        } else {
            $this->isCreating = true;
            $this->state = [];
        }
    }

    public function saveFoodItemCU()
    {
        $this->resetErrorBag();

        $inputs = $this->state;

        if ($this->file) {
            $inputs['image'] = $this->file;
        } else {
            unset($inputs['image']);
        }

        Validator::make($inputs, [
            'name' => 'required|string|max:100',
        ])->validateWithBag('saveFoodItemCU');

        if ($this->isCreating) {
            $this->foodItemList->user_id = auth()->user()->user_id;
            $this->foodItemList->house_id = auth()->user()->HouseId;
        }

        $this->foodItemList->fill([
            'name' => $inputs['name'],
            'location' => $inputs['location'] ?? null,
            'expiration_date' => $inputs['expiration_date'] ?? null,
            'description' => $inputs['description'] ?? null,
        ])->save();


        $this->foodItemList->updateFile($this->file);

        try {
            $items = $this->foodItemList;
            $createdHouseName = $this->user->house->HouseName;
            $isAction = $this->isCreating ? 'created' : 'updated';

            if (!is_null($this->user->house->food_item_list) && !empty($this->user->house->food_item_list)) {

                $foodEmailsList = explode(',', $this->user->house->food_item_list);
                if (count($foodEmailsList) > 0 && !empty($foodEmailsList)) {
                    $users = User::whereIn('email', $foodEmailsList)->where('HouseId', $this->user->HouseId)->get();

                    foreach ($users as $user) {
                        $user->notify(new FoodItemsNotification($items, $isAction, $createdHouseName));
                    }
//                Notification::send($users, new BlogNotification($items,$blogUrl,$createdHouseName));
                    $foodEmailsList = array_diff($foodEmailsList, $users->pluck('email')->toArray());
                    if (count($foodEmailsList) > 0) {
                        Notification::route('mail', $foodEmailsList)
                            ->notify(new FoodItemsNotification($items, $isAction, $createdHouseName));
                    }
                }
            }
        } catch (Exception $e) {

        }

//        try {
//            $items = $this->foodItemList;
//            $createdHouseName = auth()->user()->house->HouseName;
//            $isAction = $this->isCreating ? 'created' : 'updated';
//
//            $users = User::where('HouseId', $this->user->HouseId)->where('role', 'Administrator')->where('is_confirmed', 1)->get();
//
//            foreach ($users as $user) {
//                $user->notify(new FoodItemsNotification($items, $isAction, $createdHouseName));
//            }
//
//        } catch (Exception $e) {
//
//        }

        $this->emitSelf('toggle', false);
        $this->emit('food-item-cu-successfully');
        $this->success('Food Item ' . ($this->isCreating ? 'created' : 'updated') . ' successfully.');

    }

    public function updatedFile()
    {
        $this->validateOnly('file', ['file' => 'required|mimes:png,jpg,gif,tiff']);
    }

    public function deleteFile()
    {
        if ($this->foodItemList->id) {
            $this->foodItemList->deleteFile();
            $this->emit('food-item-cu-successfully');
        }
    }


}
