<?php

namespace App\Http\Livewire\Settings\HouseSettings;

use App\Models\House;
use App\Models\User;
use App\Models\World\City;
use App\Models\World\Country;
use App\Models\World\State;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Rules\PortraitImage;

class HouseDetails extends Component
{

    use WithFileUploads;

    public $user;

//    public $country;

    public $state = [];

    public $file;

    public $login_file;

    public ?House $house;

    protected $listeners = [
        'destroyed-successfully' => '$refresh',
        'house-details-cu-successfully' => '$refresh',
    ];

    public function render()
    {
        $countries = Country::orderBy('name', 'ASC')->get();

        $states = State::where('country_id', $this->state['country_id'] ?? '')->when( ($this->state['country_id'] ?? '') == 233, function ($query) {
            $query->where('type', 'state');
        })->orderBy('name', 'ASC')->get();

//        $cities = City::where('state_id', $this->state['state_id'] ?? '')->where('state_id', $this->state['state_id'] ?? '')->orderBy('name', 'ASC')->get();

        return view('dash.settings.house-settings.house-details',compact('countries','states'));
    }

    public function onChangeCountry()
    {
        $this->state['state_id'] = null;
        $this->state['city_id'] = null;
    }


    public function mount(){

        $this->house = $this->user->house;

        $country_id = Country::where('name',$this->house['country'])->first();
        $state_id = State::where('name',$this->house['State'])->first();
//        $city_id = City::where('name',$this->house['City'])->first();

        $this->state = [
            'name' => $this->house->HouseName,
            'primary_house_name' => $this->house->primary_house_name,
            'address_1' => $this->house->Address1,
            'address_2' => $this->house->Address2,
            'country_id' => $country_id['id'] ?? null,
            'state_id' => $state_id['id'] ?? null,
            'city_id' => $this->house->City ?? null,
            'zipcode' => $this->house->ZipCode,
            'home_phone' => $this->house->HousePhone,
            'fax' => $this->house->Fax,
            'is_default_image' => $this->house->is_default_image,
            'emergency_phone' => $this->house->EmergencyPhone,
        ];

    }

    public function saveHouseDetails()
    {
        $this->resetErrorBag();

        $inputs = $this->state;

//        dd($inputs);

        if ($this->file) {
            $inputs['image'] = $this->file;
        } else {
            unset($inputs['image']);
        }
        if ($this->login_file) {
            $inputs['login_image'] = $this->login_file;
        } else {
            unset($inputs['login_image']);
        }

        Validator::make($inputs, [
            'image' => 'nullable|mimes:png,jpg,gif,tiff',
            'login_image' => ['nullable', 'mimes:png,jpg,gif,tiff', new PortraitImage],
            'primary_house_name' => ['nullable', 'string', 'max:100'],

            'name' => [
                'required',
                'string',
                'max:40',
                'unique:House,HouseName,' . $this->house->HouseID . ',HouseID'
            ],
            'address_1' => ['nullable', 'string', 'max:40'],
            'address_2' => ['nullable', 'string', 'max:40'],
            'country' => ['nullable', 'string', 'max:40'],
            'city' => ['nullable', 'string', 'max:40'],
            'state' => ['nullable', 'string', 'max:20'],
            'zipcode' => ['nullable', 'string', 'max:10'],
        ])->validateWithBag('saveHouseDetails');

        $country_name = Country::where('id',$inputs['country_id'])->first();
        $state_name = State::where('id',$inputs['state_id'])->first();
//        $city_name = City::where('id',$inputs['city_id'])->first();

        $this->house->fill([
            'HouseName' => $this->state['name'],
            'is_default_image' => $this->state['is_default_image'] ?? 0,
            'primary_house_name' => $this->state['primary_house_name'],
            'Address1' => $this->state['address_1'] ?? null,
            'Address2' => $this->state['address_2'] ?? null,
            'country' => $country_name['name'] ?? null,
            'State' => $state_name['name'] ?? null,
            'City' => $this->state['city_id'] ?? null,
            'ZipCode' => $this->state['zipcode'] ?? null,
        ])->save();

        $this->house->updateFile($this->file, 'image');
        $this->house->updateFile($this->login_file,'login_image');

        $this->emitSelf('toggle', false);

        $this->emit('house-details-cu-successfully');
    }

    public function updatedFile()
    {
        $this->validateOnly('file', ['file' => 'required|mimes:png,jpg,gif,tiff']);
        if ($this->login_file){
            $this->validateOnly('login_file', ['login_file', 'required|mimes:png,jpg,gif,tiff', new PortraitImage]);
        }
    }

    public function deleteFile()
    {
        if ($this->house->HouseID) {
            $this->house->deleteFile();
            $this->emit('house-details-successfully');
        }
    }


}
