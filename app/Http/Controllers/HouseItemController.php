<?php

namespace App\Http\Controllers;

use App\Models\FoodItem;
use App\Models\ShoppingItem;
use Illuminate\Http\Request;

class HouseItemController extends Controller
{
    public function index(){

        $foodItems = FoodItem::where('house_id',auth()->user()->HouseId);
        $shoppingItems = ShoppingItem::where('house_id',auth()->user()->HouseId);

        return view('house-items.index',compact('foodItems','shoppingItems'));


    }
}
