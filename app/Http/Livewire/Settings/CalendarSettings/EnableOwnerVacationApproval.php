<?php

namespace App\Http\Livewire\Settings\CalendarSettings;

use App\Models\CalendarSetting;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class EnableOwnerVacationApproval extends Component
{

    public $user;
    public $state = [];
    public $calendarSettings;

    public function mount()
    {
        $this->calendarSettings = CalendarSetting::where('house_id', primary_user()->HouseId)->first();
        if ($this->calendarSettings && $this->calendarSettings->id){
            $this->state['owner_vacation_approval'] = $this->calendarSettings->owner_vacation_approval;
        }
        else{
            $this->state['owner_vacation_approval'] = 0;
        }
    }

    public function render()
    {
        return view('dash.settings.calendar-settings.enable-owner-vacation-approval');
    }

    public function enableOwnerVacationApproval()
    {
        $this->resetErrorBag();

        Validator::make($this->state, [
            'owner_vacation_approval' => ['nullable', 'boolean'],
        ])->validateWithBag('enableOwnerVacationApproval');

        if($this->calendarSettings->id){
            $this->calendarSettings->fill([
                'owner_vacation_approval' => $this->state['owner_vacation_approval'] ?? 0,
            ])->update();
        }
        else{
            $this->calendarSettings->fill([
                'user_id' => primary_user()->user_id,
                'house_id' => primary_user()->HouseId,
                'owner_vacation_approval' => $this->state['owner_vacation_approval'] ?? 0,
            ])->save();

        }
        $this->emit('saved');
    }

}
