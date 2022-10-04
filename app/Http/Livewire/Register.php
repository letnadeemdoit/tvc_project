<?php

namespace App\Http\Livewire;

use App\Models\World\City;
use App\Models\World\Country;
use App\Models\World\State;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\StatefulGuard;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Fortify;
use Livewire\Component;
use Livewire\WithFileUploads;

class Register extends Component
{
    use  WithFileUploads;
    public $file;

    public $state = [];


    public function render()
    {
        $countries = Country::orderBy('name', 'ASC')->get();

        $states = State::where('country_id', $this->state['country_id'] ?? '')->orderBy('name', 'ASC')->get();

        $cities = City::where('state_id', $this->state['state_id'] ?? '')->where('state_id', $this->state['state_id'] ?? '')->orderBy('name', 'ASC')->get();

        return view('livewire.register',compact('countries','states','cities'));
    }


    public function onChangeCountry()
    {
        $this->state['state_id'] = null;
        $this->state['city_id'] = null;
    }

    public function register(CreatesNewUsers $creator, StatefulGuard $guard) {

        $inputs = $this->state;

        $inputs['role'] = 'Administrator';
        if ($this->file)  {
            $inputs['image']  = $this->file;
        }

        event(new Registered($user = $creator->create($inputs)));

        $guard->login($user);

        $this->redirect(Fortify::redirects('register'));
    }
}
