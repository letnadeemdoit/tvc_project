<?php

namespace App\Http\Livewire\Houses;


use App\Models\House;
use Livewire\Component;

class DisplayAsList extends Component
{
    public function render()
    {
        $houses = House::orderBy('HouseID','DESC')->paginate(18);

        return view('dash.houses.display-as.list',compact('houses'));
    }
}
