<?php

namespace App\Http\Livewire\Settings\AccountInformation;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Rules\Password;
use Livewire\Component;

class ChangePasswordForm extends Component
{
    use PasswordValidationRules;

    public $user;
    public $state = [];

    public function render()
    {
        return view('dash.settings.account-information.change-password-form');
    }

    public function changePassword()
    {
        $this->resetErrorBag();

        Validator::make($this->state, [
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if (!\Hash::check($value, $this->user->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
            'new_password' => [
                'required',
                'string',
                (new Password)->requireNumeric()->requireUppercase()->requireSpecialCharacter(),
                'confirmed'
            ]
        ])->validateWithBag('changePassword');

        if ($this->user->role === 'Owner') {
            $houseIds = User::where('email', $this->user->email)->where('role', 'Owner')->get()->pluck('HouseId');
            User::whereIn('HouseId', $houseIds)->where('email', $this->user->email)->update([
                'password' => \Hash::make($this->state['new_password']),
            ]);
        } else {
            $this->user->fill([
                'password' => \Hash::make($this->state['new_password']),
            ])->save();
        }


        $this->emit('saved');
        $this->reset('state');
    }
}
