<?php

namespace App\Http\Livewire\Settings\CalendarSettings;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class EnableOrDisableRooms extends Component
{
    public $user;
    public $state = [];


    public function mount()
    {
        $this->state['enable_or_disable_rooms'] = $this->user->enable_rooms;
    }

    public function render()
    {
        return view('dash.settings.calendar-settings.enable-or-disable-rooms');
    }

    public function enableOrDisableRooms()
    {
        $this->resetErrorBag();

        Validator::make($this->state, [
            'enable_or_disable_rooms' => ['nullable', 'boolean'],
        ])->validateWithBag('enableOrDisableRooms');

        $this->user->enable_rooms = $this->state['enable_or_disable_rooms'] ?? 0;
        $this->user->save();

        $this->emit('saved');

//        return redirect()->route('dash.settings.account-information');
    }

}
