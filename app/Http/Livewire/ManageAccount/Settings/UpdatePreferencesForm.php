<?php

namespace App\Http\Livewire\ManageAccount\Settings;

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
        return view('dash.manage-account.partials.settings.update-preferences-form');
    }

    public function updatePreferences()
    {
        $this->resetErrorBag();

        Validator::make($this->state, [
            'show_additional_schedule_vacations_screen' => ['nullable', 'boolean'],
            'allow_administrator_to_have_owner_permissions' => ['nullable', 'boolean'],
        ])->validateWithBag('updatePreferences');

        $this->user->ShowOldSave = $this->state['show_additional_schedule_vacations_screen'] ?? null;
        $this->user->AdminOwner = $this->state['allow_administrator_to_have_owner_permissions'] ?? null;
        $this->user->save();

        $this->emit('saved');
    }
}
