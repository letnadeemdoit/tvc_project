<?php

namespace App\Http\Controllers;

use App\Models\House;

class Select2Controller extends Controller
{
    public function houses()
    {
        return response()->json([
            'results' => House::select('HouseID as id', 'HouseName as text')
                ->where('HouseName', 'LIKE', '%' . \request()->get('q', '---') . '%')
                ->orWhere('Address1', 'LIKE', '%' . \request()->get('q', '---') . '%')
                ->orWhere('Address2', 'LIKE', '%' . \request()->get('q', '---') . '%')
                ->limit(15)
                ->get()
                ->toArray(),
        ]);
    }
}
