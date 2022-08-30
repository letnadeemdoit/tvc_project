<?php

namespace App\Http\Livewire\Settings\HouseSettings;

use App\Models\House;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class HouseDetails extends Component
{

    use WithFileUploads;

    public $user;

    public $state = [];

    public $file;

    public ?House $house;

    protected $listeners = [
        'destroyed-successfully' => '$refresh',
        'house-details-cu-successfully' => '$refresh',
    ];

    public function render()
    {
        return view('dash.settings.house-settings.house-details');
    }

    public function mount(){

        $this->house = $this->user->house;

        $this->state = [
            'name' => $this->house->HouseName,
            'address_1' => $this->house->Address1,
            'address_2' => $this->house->Address2,
            'city' => $this->house->City,
            'state' => $this->house->state,
            'zipcode' => $this->house->ZipCode,
            'home_phone' => $this->house->HousePhone,
            'fax' => $this->house->Fax,
            'emergency_phone' => $this->house->EmergencyPhone,
        ];

    }

    public function saveHouseDetails()
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
                'unique:House,HouseName,' . $this->house->HouseID . ',HouseID'
            ],
            'address_1' => ['nullable', 'string', 'max:40'],
            'address_2' => ['nullable', 'string', 'max:40'],
            'city' => ['nullable', 'string', 'max:40'],
            'state' => ['nullable', 'string', 'max:20'],
            'zipcode' => ['nullable', 'string', 'max:10'],
        ])->validateWithBag('saveHouseDetails');

        $this->house->fill([
            'HouseName' => $this->state['name'],
            'Address1' => $this->state['address_1'] ?? null,
            'Address2' => $this->state['address_2'] ?? null,
            'City' => $this->state['city'] ?? null,
            'State' => $this->state['state'] ?? null,
            'ZipCode' => $this->state['zipcode'] ?? null,
        ])->save();

        $this->house->updateFile($this->file);

        $this->emitSelf('toggle', false);

        $this->emit('house-details-cu-successfully');
    }

    public function updatedFile()
    {
        $this->validateOnly('file', ['file' => 'required|mimes:png,jpg,gif,tiff']);
    }

    public function deleteFile()
    {
        if ($this->house->HouseID) {
            $this->house->deleteFile();
            $this->emit('house-details-successfully');
        }
    }


}
