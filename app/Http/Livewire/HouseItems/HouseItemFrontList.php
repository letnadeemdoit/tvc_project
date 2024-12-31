<?php

namespace App\Http\Livewire\HouseItems;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\FoodItem;
use App\Models\ShoppingItem;
use App\Models\User;
use App\Notifications\DeleteFoodItemEmailNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class HouseItemFrontList extends Component
{
    use Destroyable;

    protected $listeners = [
        'food-item-cu-successfully' => '$refresh',
        'shopping-item-cu-successfully' => '$refresh',
        'destroyed-successfully' => 'destroyedSuccessfully'
    ];

    public $title = 'food';

    public function render()
    {
        $foodItems = FoodItem::where('house_id',auth()->user()->HouseId)->get();

        $shoppingItems = ShoppingItem::where('house_id',auth()->user()->HouseId)->get();

        return view('house-items.food-and-shopping-card-list',compact('foodItems','shoppingItems'));
    }

    public function changeFoodTitle(){

       $this->title = 'food';

    }

    public function changeShoppingTitle(){

        $this->title = 'shopping';

    }

    public function destroyedSuccessfully($data)
    {
        if ($this->title === 'food'){
            $this->emitSelf('food-item-cu-successfully');
        }
        else if ($this->title === 'shopping'){
            $this->emitSelf('shopping-item-cu-successfully');
        }
    }

    public function destroy($id)
    {
        if ($this->title === 'food'){
            $this->model = FoodItem::class;
        }
        else if ($this->title === 'shopping'){
            $this->model = ShoppingItem::class;
        }
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
