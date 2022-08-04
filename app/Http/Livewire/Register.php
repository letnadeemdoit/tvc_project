<?php

namespace App\Http\Livewire;

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
        return view('livewire.register');
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
