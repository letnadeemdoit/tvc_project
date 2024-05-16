<?php

namespace App\Http\Livewire\Settings\CalendarSettings;

use App\Models\CalendarSetting;
use Livewire\Component;

class AllowOverlappingVacations extends Component
{
    public $user;
    public $state = [];
    public $calendarSettings;


    public function mount()
    {
        $this->calendarSettings = CalendarSetting::where('house_id', primary_user()->HouseId)->first();
        if ($this->calendarSettings && $this->calendarSettings->id){
            $this->state['overlap_vacation'] = $this->calendarSettings->overlap_vacation;
        }
        else{
            $this->state['overlap_vacation'] = 'no';
        }
    }

    public function render()
    {
        return view('dash.settings.calendar-settings.allow-overlapping-vacations');
    }

    public function allowOverlapVacation($value)
    {
        $this->state['overlap_vacation'] = $value;
    }

    public function enableOverlappingVacations(){

        if($this->calendarSettings && $this->calendarSettings->id){
            $this->calendarSettings->fill([
                'overlap_vacation' => $this->state['overlap_vacation'],
            ])->update();
        }
        else{
            $this->calendarSettings->fill([
                'user_id' => primary_user()->user_id,
                'house_id' => primary_user()->HouseId,
                'overlap_vacation' => $this->state['overlap_vacation'],
            ])->save();

        }
        $this->emit('saved');
    }

}
