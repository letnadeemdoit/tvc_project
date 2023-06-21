<?php

namespace App\Http\Livewire\Settings\AdditionalHouses;

use App\Models\Board;
use App\Models\House;
use App\Models\User;
use App\Models\World\City;
use App\Models\World\Country;
use App\Models\World\State;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use App\Http\Livewire\Traits\Toastr;
use Livewire\WithFileUploads;

class CreateOrUpdateHouseForm extends Component
{
    use WithFileUploads;
    use Toastr;

    public $user;

    public $state = [];
    public $file;

    public ?House $house;

    protected $listeners = [
        'showAdditionalHouseCUModal'
    ];

    public function render()
    {
        $countries = Country::orderBy('name', 'ASC')->get();

        $states = State::where('country_id', $this->state['country_id'] ?? '')->when( ($this->state['country_id'] ?? '') == 233, function ($query) {
            $query->where('type', 'state');
        })->orderBy('name', 'ASC')->get();
//        $cities = City::where('state_id', $this->state['state_id'] ?? '')->where('state_id', $this->state['state_id'] ?? '')->orderBy('name', 'ASC')->get();

        return view('dash.settings.additional-houses.create-or-update-house-form', compact('countries', 'states'));
    }


    public function onChangeCountry()
    {
        $this->state['state_id'] = null;
        $this->state['city_id'] = null;
    }


    public function showAdditionalHouseCUModal($toggle, ?House $house)
    {
        $this->emitSelf('toggle', $toggle);
        $this->house = $house;
        $this->reset(['state', 'file']);

//        dd($this->house);

        $country_id = Country::where('name', $this->house['country'])->first();
        $state_id = State::where('name', $this->house['State'])->first();
//        $city_id = City::where('name', $this->house['City'])->first();

        if ($house->HouseID) {
            $this->state = [
                'name' => $house->HouseName,
                'address_1' => $house->Address1,
                'address_2' => $house->Address2,
                'country_id' => $country_id['id'] ?? null,
                'state_id' => $state_id['id'] ?? null,
                'city_id' => $house->City ?? null,
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
            'country' => ['nullable', 'string', 'max:40'],
            'city' => ['nullable', 'string', 'max:40'],
            'state' => ['nullable', 'string', 'max:20'],
            'zipcode' => ['nullable', 'string', 'max:10'],

        ])->validateWithBag('saveAdditionalHouseCU');


        if ($this->user->primary_account == 1) {
            $this->house->parent_id = $this->user->HouseId;
        } else {

        }

        $country_name = Country::where('id', $inputs['country_id'] ?? '')->first();
        $state_name = State::where('id', $inputs['state_id'] ?? '')->first();
//        $city_name = City::where('id', $inputs['city_id'])->first();

        $this->house->fill([
            'HouseName' => $this->state['name'],
//            'parent_id' => $this->user->primary_account == 1 ? $this->user->HouseId : null,
            'Address1' => $this->state['address_1'] ?? null,
            'Address2' => $this->state['address_2'] ?? null,
            'country' => $country_name ? $country_name->name : null,
            'State' => $state_name ? $state_name->name : null,
            'City' => $this->state['city_id']  ?? null,
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
                'user_id' => null,
                'HouseId' => $this->house->HouseID,
                'password' => $this->user->password,
                'parent_id' => $this->user->primary_account ? $this->user->user_id : $this->user->parent_id,
                'primary_account' => 0,
            ])->save();
        }

        $this->emitSelf('toggle', false);
//        $this->emit('additional-cu-successfully');


        $maxAdditionalHouse = \App\Models\House::whereHas('users', function ($query) {
            $query->where('email', $this->user->email)
                ->where('HouseId', '<>', $this->user->HouseId);
        })->count();

        if ($maxAdditionalHouse == 9) {
            return redirect()->route('dash.settings.additional-houses');
        }

        return redirect()->route('dash.settings.additional-houses');

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
