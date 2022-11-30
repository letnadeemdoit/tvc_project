<?php

namespace App\Http\Controllers;

use App\Models\House;

class Select2Controller extends Controller
{
    public function houses()
    {
        return response()->json([
            'results' => House::selectRaw('HouseID as id, Status, CONCAT(HouseName, " (", IF(Address1 is not null and Address1 <> "", CONCAT(Address1, ", "), ""), IF(Address2 is not null and Address2 <> "", CONCAT(Address2, ", "), ""), IF(City is not null and City <> "", CONCAT(City, ", "), ""), IF(State is not null and State <> "", CONCAT(State, ", "), ""), IF(Country is not null and Country <> "", CONCAT(Country, ""), ""), ")") as text')
                ->where(function ($query) {
                    $query->where('HouseName', 'LIKE', '%' . \request()->get('q', '---') . '%')
                        ->orWhere('Address1', 'LIKE', '%' . \request()->get('q', '---') . '%')
                        ->orWhere('Address2', 'LIKE', '%' . \request()->get('q', '---') . '%')
                        ->orWhere('City', 'LIKE', '%' . \request()->get('q', '---') . '%')
                        ->orWhere('State', 'LIKE', '%' . \request()->get('q', '---') . '%')
                        ->orWhere('Country', 'LIKE', '%' . \request()->get('q', '---') . '%');
                })
                ->whereIn('Status', ['A','P','C'])
                ->limit(15)
                ->get()
                ->toArray(),
        ]);
    }
}
