<?php

namespace App\Http\Livewire\Settings\CalendarSettings;

use App\Models\Calendar;
use App\Models\CalendarSetting;
use App\Models\Time;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class UpdateStartEndTimeOfVacation extends Component
{
    public $user;
    public $state = [];

    public $vacationDefaultStartEndTime;

    public function mount(){
        $this->vacationDefaultStartEndTime = CalendarSetting::where('house_id', primary_user()->HouseId)->first();
        if ($this->vacationDefaultStartEndTime && $this->vacationDefaultStartEndTime->id){
            $this->state = [
                'update_start_time' => $this->vacationDefaultStartEndTime->start_datetime->format('H:i'),
                'update_end_time' => $this->vacationDefaultStartEndTime->end_datetime->format('H:i'),
            ];
        }
    }

    public function render()
    {
        return view('dash.settings.calendar-settings.update-start-end-time-of-vacation');
    }


    public function UpdateStartEndTimeOfVacation()
    {
        $this->resetErrorBag();

        $vacationStartTime = Carbon::parse($this->state['update_start_time']);
        $vacationEndTime = Carbon::parse($this->state['update_end_time']);

        $this->vacationDefaultStartEndTime = CalendarSetting::firstOrNew(['house_id' => primary_user()->HouseId]);

        $this->syncCalendar($vacationStartTime, $vacationEndTime, $startTime, $endTime);

        if($this->vacationDefaultStartEndTime && $this->vacationDefaultStartEndTime->id){
            $this->vacationDefaultStartEndTime->fill([
                'StartTimeId' => $startTime->timeid,
                'EndTimeId' => $endTime->timeid,
            ])->update();
        }
        else{
            $this->vacationDefaultStartEndTime->fill([
                'user_id' => primary_user()->user_id,
                'house_id' => primary_user()->HouseId,
                'StartTimeId' => $startTime->timeid,
                'EndTimeId' => $endTime->timeid,
            ])->save();

        }
        $this->emit('saved');

    }

    public function syncCalendar($vacationStartTime, $vacationEndTime, &$startTime, &$endTime)
    {
        // Start Datetime
        $stTime = $vacationStartTime->format('H:i');
        $startTime = Time::firstOrNew([
            'time' => $stTime,
        ]);
        if (!$startTime->exists) $startTime->save();


        // End Datetime
        $enTime = $vacationEndTime->format('H:i');
        $endTime = Time::firstOrNew([
            'time' => $enTime,
        ]);
        if (!$endTime->exists) $endTime->save();
    }




}
