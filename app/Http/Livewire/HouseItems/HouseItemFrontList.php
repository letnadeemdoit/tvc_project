<?php

namespace App\Http\Livewire\HouseItems;

use App\Models\FoodItem;
use App\Models\ShoppingItem;
use Livewire\Component;

class HouseItemFrontList extends Component
{

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

}
