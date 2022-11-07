<?php

namespace App\Http\Livewire\Settings\AccountInformation;

use App\Models\Audit\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class UpdatePreferencesForm extends Component
{
    public $user;
    public $state = [];

    public function mount()
    {
        $this->state['show_additional_schedule_vacations_screen'] = $this->user->ShowOldSave;
        $this->state['allow_administrator_to_have_owner_permissions'] = $this->user->AdminOwner;
    }

    public function render()
    {
        return view('dash.settings.account-information.update-preferences-form');
    }

    public function updatePreferences()
    {
        $this->resetErrorBag();

        Validator::make($this->state, [
            'show_additional_schedule_vacations_screen' => ['nullable', 'boolean'],
            'allow_administrator_to_have_owner_permissions' => ['nullable', 'boolean'],
        ])->validateWithBag('updatePreferences');

        if ($this->user->primary_account == 1) {
            $otherUser = \App\Models\User::where('parent_id', $this->user->user_id)->where('role', 'Administrator')->get();
            foreach ($otherUser as $user) {
                $user->ShowOldSave = $this->state['show_additional_schedule_vacations_screen'] ?? null;
                $user->AdminOwner = $this->state['allow_administrator_to_have_owner_permissions'] ?? null;
                $user->save();
            }
        } else {
            $this->user->ShowOldSave = $this->state['show_additional_schedule_vacations_screen'] ?? null;
            $this->user->AdminOwner = $this->state['allow_administrator_to_have_owner_permissions'] ?? null;
            $this->user->save();
        }

        $this->emit('saved');
    }
}
