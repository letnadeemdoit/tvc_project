<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;

class Select2Controller extends Controller
{
    public function houses()
    {
        return response()->json([
            'results' => House::select('HouseID as id', 'HouseName as text')
                ->where('HouseName', 'LIKE', '%' . \request()->get('q', '---') . '%')
                ->limit(15)
                ->get()
                ->toArray(),
        ]);
    }
}
