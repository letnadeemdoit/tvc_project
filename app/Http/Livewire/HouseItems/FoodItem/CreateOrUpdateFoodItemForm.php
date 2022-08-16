<?php

namespace App\Http\Livewire\HouseItems\FoodItem;

use App\Http\Livewire\Traits\Toastr;
use App\Models\FoodItem;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateOrUpdateFoodItemForm extends Component
{

    use WithFileUploads;
    use Toastr;

    public $isShowingModal = false;

    private $isCreating = false;

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
        $this->reset(['state', 'file']);

        if ($foodItemList) {
            $this->state = \Arr::only($foodItemList->toArray(), ['user_id','house_id','name','location','expiration_date','']);
        }
    }

    public function saveFoodItemCU()
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
        ])->validateWithBag('saveFoodItemCU');

        $this->foodItemList->fill([
            'user_id' => auth()->user()->user_id,
            'house_id' => auth()->user()->HouseId,
            'name' => $inputs['name'],
            'location' => $inputs['location'] ?? null,
            'expiration_date' => $inputs['expiration_date'] ?? null,
            'description' => $inputs['description'] ?? null,
        ])->save();

        $this->foodItemList->updateFile($this->file);

        $this->emitSelf('toggle', false);

        $this->success('saved Successfully');

        $this->emit('food-item-cu-successfully');
    }

    public function updatedFile() {
        $this->validateOnly('file', ['file' => 'required|mimes:png,jpg,gif,tiff']);
    }

    public function deleteFile() {
        if ($this->foodItemList->id) {
            $this->foodItemList->deleteFile();
            $this->emit('local-guide-cu-successfully');
        }
    }


}
