<?php

namespace App\Http\Livewire\Settings\AdditionalHouses;

use App\Models\Board;
use App\Models\House;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateOrUpdateHouseForm extends Component
{
    use WithFileUploads;

    public $user;

    public $state = [];
    public $file;

    public ?House $house;

    protected $listeners = [
        'showAdditionalHouseCUModal'
    ];

    public function render()
    {
        return view('dash.settings.additional-houses.create-or-update-house-form');
    }

    public function showAdditionalHouseCUModal($toggle, ?House $house)
    {
        $this->emitSelf('toggle', $toggle);
        $this->house = $house;
        $this->reset(['state', 'file']);

        if ($house->HouseID) {
            $this->state = [
                'name' => $house->HouseName,
                'address_1' => $house->Address1,
                'address_2' => $house->Address2,
                'city' => $house->City,
                'state' => $house->state,
                'zipcode' => $house->ZipCode,
                'home_phone' => $house->HousePhone,
                'fax' => $house->Fax,
                'emergency_phone' => $house->EmergencyPhone,
            ];
        }
    }

    public function saveAdditionalHouseCU()
    {
        $this->resetErrorBag();

        $inputs = $this->state;

        if ($this->file) {
            $inputs['image'] = $this->file;
        } else {
            unset($inputs['image']);
        }

        Validator::make($inputs, [
            'image' => 'nullable|mimes:png,jpg,gif,tiff',
            'name' => [
                'required',
                'string',
                'max:40',
                $this->house->HouseID ? 'unique:House,HouseName,' . $this->house->HouseID . ',HouseID' : 'unique:House,HouseName'
            ],
            'address_1' => ['nullable', 'string', 'max:40'],
            'address_2' => ['nullable', 'string', 'max:40'],
            'city' => ['nullable', 'string', 'max:40'],
            'state' => ['nullable', 'string', 'max:20'],
            'zipcode' => ['nullable', 'string', 'max:10'],
        ])->validateWithBag('saveAdditionalHouseCU');

        $this->house->fill([
            'HouseName' => $this->state['name'],
            'Address1' => $this->state['address_1'] ?? null,
            'Address2' => $this->state['address_2'] ?? null,
            'City' => $this->state['city'] ?? null,
            'State' => $this->state['state'] ?? null,
            'ZipCode' => $this->state['zipcode'] ?? null,
        ])->save();

        $this->house->updateFile($this->file);

        $user = User::firstOrNew([
            'user_id' => $this->user->user_id,
            'HouseId' => $this->house->HouseID,
        ]);

        if (!$user->exists) {
            $user->fill([
                ...$this->user->toArray(),
                'user_id'  => null,
                'HouseId' => $this->house->HouseID,
            ])->save();
        }

        $this->emitSelf('toggle', false);
        $this->emit('additional-house-cu-successfully');
    }

    public function updatedFile()
    {
        $this->validateOnly('file', ['file' => 'required|mimes:png,jpg,gif,tiff']);
    }

    public function deleteFile()
    {
        if ($this->house->id) {
            $this->house->deleteFile();
            $this->emit('user-cu-successfully');
        }
    }
}
