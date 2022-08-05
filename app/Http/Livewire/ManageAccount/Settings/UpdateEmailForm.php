<?php

namespace App\Http\Livewire\ManageAccount\Settings;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class UpdateEmailForm extends Component
{
    public $user;
    public $email;

    public function render()
    {
        return view('dash.manage-account.partials.settings.update-email-form');
    }

    public function changeEmail()
    {
        $this->resetErrorBag();

        Validator::make(['email' => $this->email], [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ])->validateWithBag('changeEmail');

        $this->user->forceFill([
            'email' => $this->email,
            'email_verified_at' => null,
        ])->save();

        $this->user->sendEmailVerificationNotification();

        $this->emit('saved');
        $this->reset('email');
    }
}
