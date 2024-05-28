<?php

namespace App\Http\Livewire\Settings\CalendarSettings;

use App\Models\CalendarSetting;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class EnableVacationMaxLength extends Component
{
    public $user;
    public $state = [];

    public $calendarSettings;
    public $enableScheduleWindow = false;


    public function mount(){
        $this->calendarSettings = CalendarSetting::where('house_id', primary_user()->HouseId)->first();
        if ($this->calendarSettings && $this->calendarSettings->enable_max_vacation_length === 1){
            $this->state = [
                'enable_max_vacation_length' => $this->calendarSettings->enable_max_vacation_length,
                'vacation_length' => $this->calendarSettings->vacation_length
            ];
        }
        else{
            $this->state = [
                'enable_max_vacation_length' => 0,
                'vacation_length' => 0
            ];
        }
    }

    public function render()
    {
        return view('dash.settings.calendar-settings.enable-vacation-max-length');
    }
    public function scheduleMaxVacationLength($value){
        $this->state = [
            'enable_max_vacation_length' => $value,
            'vacation_length' => $this->calendarSettings->vacation_length
        ];
    }

    public function enableVacationMaxLength(){
        $this->resetErrorBag();

        if (!$this->state['enable_max_vacation_length']){
            if($this->calendarSettings->id){
                $this->calendarSettings->fill([
                    'enable_max_vacation_length' => 0,
                    'vacation_length' => 0,
                ])->update();
            }
            $this->emit('saved');
            return;
        }

        $rules = [
            'enable_max_vacation_length' => ['nullable', 'boolean'],
        ];
        if ($this->state['enable_max_vacation_length']) {
            $rules['vacation_length'] = ['required', 'numeric', 'min:1'];
        }
        Validator::make($this->state, $rules)->validateWithBag('enableVacationMaxLength');


        if($this->calendarSettings->id){
            $this->calendarSettings->fill([
                'enable_max_vacation_length' => $this->state['enable_max_vacation_length'],
                'vacation_length' => $this->state['vacation_length']
            ])->update();
        }
        else{
            $this->calendarSettings->fill([
                'user_id' => primary_user()->user_id,
                'house_id' => primary_user()->HouseId,
                'enable_max_vacation_length' => $this->state['enable_max_vacation_length'],
                'vacation_length' => $this->state['vacation_length']
            ])->save();

        }
        $this->emit('saved');

    }


}
