<?php

namespace App\Http\Livewire\HouseItems\ShoppingItem;

use App\Http\Livewire\Traits\Toastr;
use App\Models\ShoppingItem;
use App\Models\User;
use App\Notifications\FoodItemsNotification;
use App\Notifications\ShoppingItemsNotification;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateOrUpdateShoppingItemForm extends Component
{

    use WithFileUploads;
    use Toastr;

    public $isShowingModal = false;

    public $state = [];

    public $user;

    public $file;

    public $isCreating = false;

    public ?ShoppingItem $shoppingItemList;

    protected $listeners = [
        'showShoppingItemCUModal',
    ];

    public function render()
    {
        return view('dash.house-items.shopping-item-list.create-or-update-shopping-item-form');
    }

    public function hydrate()
    {
        $this->dispatchBrowserEvent('modal-is-shown');
    }

    public function showShoppingItemCUModal($toggle, ?ShoppingItem $shoppingItemList)
    {
        $this->emitSelf('toggle', $toggle);
        $this->shoppingItemList = $shoppingItemList;
        $this->file = null;

        if ($shoppingItemList->id) {
            $this->isCreating = false;
            $this->state = \Arr::only($shoppingItemList->toArray(), ['user_id','house_id','name','location','expiration_date','']);
        }else{
            $this->isCreating = true;
            $this->state = [];
        }
    }

    public function saveShoppingItemCU()
    {
        $this->resetErrorBag();

        $inputs = $this->state;

        if ($this->file) {
            $inputs['image'] = $this->file;
        }else{
            unset($inputs['image']);
        }

        Validator::make($inputs, [
            'name' => 'required|string|max:100',
        ])->validateWithBag('saveShoppingItemCU');

        if ($this->isCreating){
            $this->shoppingItemList->user_id = auth()->user()->user_id;
            $this->shoppingItemList->house_id = auth()->user()->HouseId;
        }

        $this->shoppingItemList->fill([
            'name' => $inputs['name'],
            'location' => $inputs['location'] ?? null,
            'expiration_date' => $inputs['expiration_date'] ?? null,
            'description' => $inputs['description'] ?? null,
        ])->save();

        $this->shoppingItemList->updateFile($this->file);

        try {
            $items = $this->shoppingItemList;
            $createdHouseName = auth()->user()->house->HouseName;
            $isAction = $this->isCreating ? 'created' : 'updated';

            $users = User::where('HouseId', $this->user->HouseId)->where('role', 'Administrator')->where('is_confirmed', 1)->get();

            foreach ($users as $user) {
                $user->notify(new ShoppingItemsNotification($items, $isAction, $createdHouseName));
            }

        } catch (Exception $e) {

        }

        $this->emitSelf('toggle', false);

        $this->emit('shopping-item-cu-successfully');

        $this->success( 'Shopping Item ' .($this->isCreating ? 'created' : 'updated'). ' successfully.');

    }

    public function updatedFile() {
        $this->validateOnly('file', ['file' => 'required|mimes:png,jpg,gif,tiff']);
    }

    public function deleteFile() {
        if ($this->shoppingItemList->id) {
            $this->shoppingItemList->deleteFile();
            $this->emit('shopping-item-cu-successfully');
        }
    }


}
