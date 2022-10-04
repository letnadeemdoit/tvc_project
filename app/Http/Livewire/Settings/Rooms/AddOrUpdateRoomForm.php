<?php

namespace App\Http\Livewire\Settings\Rooms;

use App\Http\Livewire\Traits\Toastr;
use App\Models\AmenityType;
use App\Models\Room\BedType;
use App\Models\Room\Room;
use App\Models\Room\RoomType;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AddOrUpdateRoomForm extends Component
{
    use Toastr;

    public $user;

    public $state = [];

    public ?Room $room;

    public $isCreating = false;

    protected $listeners = [
        'showRoomCUModal'
    ];

    public function showRoomCUModal($toggle, ?Room $room)
    {
//        if (! Gate::any(['create', 'update'], $room)) {
//            abort(403);
//        }

        $this->emitSelf('toggle', $toggle);
        $this->room = $room;
        $this->reset('state');

        if ($room->RoomID) {
            $this->isCreating = false;
            $this->state = [
                'name' => $room->RoomName,
                'beds' => $room->Beds,
                'type' => $room->RoomTypeID,
                'bed_type_id' => $room->bed_type_id,
                'amenities' => $room->amenities->pluck('AmenityID')->toArray(),
            ];
        } else {
            $this->isCreating = true;
            $this->state = [
            ];
        }
    }

    public function saveRoomCU()
    {
        $this->resetErrorBag();

        Validator::make($this->state, [
            'name' => ['required', 'string', 'max:100'],
            'type' => ['required', 'exists:RoomType,RoomTypeID'],
            'beds' => ['required', 'numeric', 'min:1', 'max:20'],
            'bed_type_id' => ['required', 'exists:bed_types,id'],
            'amenities' => ['nullable'],
        ])->validateWithBag('saveRoomCU');


        $this->room->fill([
            'RoomName' => $this->state['name'],
            'RoomTypeID' => $this->state['type'],
            'Beds' => $this->state['beds'],
            'bed_type_id' => $this->state['bed_type_id'],
            'HouseID' => $this->user->HouseId,
        ])->save();

        $this->room->amenities()->sync($this->state['amenities'] ?? []);
        $this->emitSelf('toggle', false);
        $this->emit('room-cu-successfully');

        $this->success('Room ' . ($this->isCreating ? 'added' : 'updated') . ' successfully.');

        $addedRooms = Room::where('HouseID', $this->user->HouseId)->count();

        $maxRooms = 0;

        if (is_premium_subscribed()){
            $maxRooms = 1000;
        }elseif(is_standard_subscribed()){
            $maxRooms = 6;
        }else{
            $maxRooms = 0;
        }

        if ($addedRooms >= $maxRooms){
            return redirect()->route('dash.settings.rooms');
        }

    }

    public function getBedTypesProperty()
    {
        return BedType::all();
    }

    public function getAmenitiesProperty()
    {
        return AmenityType::all();
    }

    public function getRoomTypesProperty()
    {
        return RoomType::whereIn('RoomTypeID', ['S', 'M', 'B'])->get();
    }

    public function render()
    {
        return view('dash.settings.rooms.add-or-update-room-form');
    }
}
