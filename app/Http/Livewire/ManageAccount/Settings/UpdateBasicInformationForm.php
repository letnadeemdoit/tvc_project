<?php

namespace App\Http\Livewire\ManageAccount\Settings;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class UpdateBasicInformationForm extends Component
{
    public $user;
    public $state = [];

    public function mount()
    {
        $this->state = \Arr::only($this->user->toArray(), ['first_name', 'last_name']);
    }

    public function render()
    {
        return view('dash.manage-account.partials.settings.update-basic-information-form');
    }

    public function updateBasicInformation()
    {
        $this->resetErrorBag();

        Validator::make($this->state, [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
        ])->validateWithBag('updateBasicInformation');

        $this->user->fill([
            'first_name' => $this->state['first_name'] ?? '',
            'last_name' => $this->state['last_name'] ?? ''
        ])->save();

        $this->emit('saved');
    }
}
