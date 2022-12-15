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
            $createdHouseName = auth()->user()->house->HouseName;
            $isAction = $this->isCreating ? 'created' : 'updated';

            if (!is_null(auth()->user()->house->request_to_use_house_email_list) && !empty(auth()->user()->house->request_to_use_house_email_list)) {

                $request_to_use_house_email_list = explode(',', auth()->user()->house->request_to_use_house_email_list);

                if (count($request_to_use_house_email_list) > 0 && !empty($request_to_use_house_email_list)) {

                    $users = User::whereIn('email', $request_to_use_house_email_list)->where('HouseId', auth()->user()->HouseId)->get();

                    foreach ($users as $user) {
                        $user->notify(new FoodItemsNotification($items, $isAction, $createdHouseName));
                    }

//                  Notification::send($users, new BlogNotification($items,$blogUrl,$createdHouseName));

                    $request_to_use_house_email_list = array_diff($request_to_use_house_email_list, $users->pluck('email')->toArray());

                    if (count($request_to_use_house_email_list) > 0) {

                        Notification::route('mail', $request_to_use_house_email_list)
                            ->notify(new FoodItemsNotification($items, $isAction, $createdHouseName));

                    }
                }

            }
        } catch (Exception $e) {

        }

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
