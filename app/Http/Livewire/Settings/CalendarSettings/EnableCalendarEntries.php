<?php

namespace App\Http\Livewire\Settings\CalendarSettings;

use App\Models\CalendarSetting;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class EnableCalendarEntries extends Component
{

    public $user;
    public $state = [];
    public $calendarSettings;

    public function mount()
    {
        $this->calendarSettings = CalendarSetting::where('house_id', primary_user()->HouseId)->first();
        if ($this->calendarSettings && $this->calendarSettings->id){
            $this->state['allow_informational_entries'] = $this->calendarSettings->allow_informational_entries;
        }
        else{
            $this->state['allow_informational_entries'] = 0;
        }
    }

    public function render()
    {
        return view('dash.settings.calendar-settings.enable-calendar-entries');
    }

    public function allowInformationalEntries()
    {
        $this->resetErrorBag();

        Validator::make($this->state, [
            'allow_informational_entries' => ['nullable', 'boolean'],
        ])->validateWithBag('allowInformationalEntries');

        if($this->calendarSettings->id){
            $this->calendarSettings->fill([
                'allow_informational_entries' => $this->state['allow_informational_entries'] ?? 0,
            ])->update();
        }
        else{
            $this->calendarSettings->fill([
                'user_id' => primary_user()->user_id,
                'house_id' => primary_user()->HouseId,
                'allow_informational_entries' => $this->state['allow_informational_entries'] ?? 0,
            ])->save();

        }
        $this->emit('saved');
    }
}
