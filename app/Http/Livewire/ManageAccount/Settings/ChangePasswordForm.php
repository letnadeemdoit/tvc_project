<?php

namespace App\Http\Livewire\ManageAccount\Settings;

use App\Actions\Fortify\PasswordValidationRules;
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
        return view('dash.manage-account.partials.settings.change-password-form');
    }

    public function changePassword() {
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

        $this->user->fill([
            'password' => \Hash::make($this->state['new_password']),
        ])->save();

        $this->emit('saved');
        $this->reset('state');
    }
}
