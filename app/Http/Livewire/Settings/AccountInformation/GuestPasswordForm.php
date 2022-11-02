<?php

namespace App\Http\Livewire\Settings\AccountInformation;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Rules\Password;
use Livewire\Component;

class GuestPasswordForm extends Component
{
    public $user;
    public $guestUser;
    public $state = [];

    public function mount()
    {
        $this->guestUser = User::where([
            'HouseId' => $this->user->HouseId,
            'role' => 'Guest',
        ])->first();
    }

    public function render()
    {
        return view('dash.settings.account-information.guest-password-form');
    }

    public function changeGuestPassword()
    {
        $this->resetErrorBag();

        Validator::make($this->state, [
            'new_password' => [
                'required',
                'string',
                (new Password)->requireNumeric()->requireUppercase()->requireSpecialCharacter(),
                'confirmed'
            ]
        ])->validateWithBag('changePassword');

        $this->guestUser->fill([
            'password' => \Hash::make($this->state['new_password']),
        ])->save();

        $this->emit('saved');
        $this->reset('state');
    }
}
