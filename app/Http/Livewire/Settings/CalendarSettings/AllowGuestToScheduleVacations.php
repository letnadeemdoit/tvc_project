<?php

namespace App\Http\Livewire\Settings\CalendarSettings;

use App\Models\CalendarSetting;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class AllowGuestToScheduleVacations extends Component
{
    public $user;
    public $state = [];
    public $calendarSettings = null;

    public function mount()
    {
        $this->calendarSettings = CalendarSetting::where('house_id', primary_user()->HouseId)->first();
        if ($this->calendarSettings && $this->calendarSettings->id){
            $this->state['allow_guest_vacations'] = $this->calendarSettings->allow_guest_vacations;
        }
        else{
            $this->state['allow_guest_vacations'] = 0;
        }

    }

    public function render()
    {
        return view('dash.settings.calendar-settings.allow-guest-to-schedule-vacations');
    }

    public function allowGuestToScheduleVacations()
    {
        if($this->calendarSettings && $this->calendarSettings->id){
            $this->calendarSettings->fill([
                'allow_guest_vacations' => $this->state['allow_guest_vacations'],
            ])->update();
        }
        else{
            $this->calendarSettings->fill([
                'user_id' => primary_user()->user_id,
                'house_id' => primary_user()->HouseId,
                'allow_guest_vacations' => $this->state['allow_guest_vacations'] ?? 0,
            ])->save();

        }
        $this->emit('saved');
    }
}
