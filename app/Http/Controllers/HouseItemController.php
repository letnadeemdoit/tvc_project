<?php

namespace App\Http\Controllers;

use App\Models\FoodItem;
use App\Models\ShoppingItem;
use Illuminate\Http\Request;

class HouseItemController extends Controller
{
    public function index(Request $request){

        return view('house-items.index', [
            'user' => $request->user()
        ]);

    }
}
