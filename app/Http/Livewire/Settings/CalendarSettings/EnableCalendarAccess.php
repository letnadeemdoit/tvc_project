<?php

namespace App\Http\Livewire\Settings\CalendarSettings;

use App\Models\CalendarSetting;
use Livewire\Component;

class EnableCalendarAccess extends Component
{
    public $user;
    public $state = [];
    public $calendarSettings = null;

    public function mount()
    {
        $this->calendarSettings = CalendarSetting::where('house_id', primary_user()->HouseId)->first();
        if ($this->calendarSettings && $this->calendarSettings->id){
            $this->state['enable_calendar_access'] = $this->calendarSettings->enable_calendar_access;
        }
        else{
            $this->state['enable_calendar_access'] = 0;
        }

    }

    public function render()
    {
        return view('dash.settings.calendar-settings.enable-calendar-access');
    }

    public function enableCalendarAccessToUsers()
    {
        if($this->calendarSettings && $this->calendarSettings->id){
            $this->calendarSettings->fill([
                'enable_calendar_access' => $this->state['enable_calendar_access'],
            ])->update();
        }
        else{
            $this->calendarSettings->fill([
                'user_id' => primary_user()->user_id,
                'house_id' => primary_user()->HouseId,
                'enable_calendar_access' => $this->state['enable_calendar_access'] ?? 0,
            ])->save();

        }
        $this->emit('saved');
    }
}
