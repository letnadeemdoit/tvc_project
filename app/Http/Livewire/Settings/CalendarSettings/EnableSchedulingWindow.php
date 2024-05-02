<?php

namespace App\Http\Livewire\Settings\CalendarSettings;

use App\Models\Calendar;
use App\Models\CalendarSetting;
use App\Models\Time;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class EnableSchedulingWindow extends Component
{

    public $user;
    public $state = [];

    public $calendarSettings;
    public $enableScheduleWindow = false;

    protected $listeners = [
        'checkScheduleWindowProperty' => 'checkScheduleWindowProperty',
    ];

    public function mount(){
        $this->calendarSettings = CalendarSetting::where('house_id', $this->user->HouseId)->first();
        if ($this->calendarSettings && $this->calendarSettings->id && $this->calendarSettings->enable_schedule_window === 1){
            $this->state = [
                'enable_scheduling_window' => $this->calendarSettings->enable_schedule_window,
                'vacation_start_date' => $this->calendarSettings->start_datetime->format('m/d/Y'),
                'vacation_end_date' => $this->calendarSettings->end_datetime->format('m/d/Y'),
            ];
        }
    }

    public function render()
    {
        return view('dash.settings.calendar-settings.enable-scheduling-window');
    }

    public function checkScheduleWindowProperty(){
        if ($this->calendarSettings && $this->calendarSettings->enable_schedule_window === 1){
            $this->emit('enableScheduleWindowChanged', $this->enableScheduleWindow = true);
        }
        else{
            $this->emit('enableScheduleWindowChanged', $this->enableScheduleWindow = false);
        }

    }
    public function scheduleWindow(){
        if (!$this->enableScheduleWindow){
            $this->emit('enableScheduleWindowChanged', $this->enableScheduleWindow = true);
        }
        else{
            $this->emit('enableScheduleWindowChanged', $this->enableScheduleWindow = false);
        }
    }


    public function enableSchedulingWindow()
    {
        $this->resetErrorBag();

        if (!$this->state['enable_scheduling_window']){
            if($this->calendarSettings->id){
                $this->calendarSettings->fill([
                    'enable_schedule_window' => 0,
                    'StartDateId' => 0,
                    'EndDateId' => 0,
                ])->update();
            }
            $this->emit('enableScheduleWindowChanged', $this->enableScheduleWindow = false);
            $this->emit('saved');
            return;
        }

        // Define validation rules dynamically based on checkbox state
        $rules = [
            'enable_scheduling_window' => ['nullable', 'boolean'],
        ];
        if ($this->state['enable_scheduling_window']) {
            $rules['vacation_start_date'] = ['required', 'date'];
            $rules['vacation_end_date'] = ['required', 'date', 'after:vacation_start_date'];
        }
        Validator::make($this->state, $rules)->validateWithBag('enableSchedulingWindow');


        $vacationStartDate = Carbon::parse($this->state['vacation_start_date']);
        $vacationEndDate = Carbon::parse($this->state['vacation_end_date']);

        $this->calendarSettings = CalendarSetting::firstOrNew(['house_id' => $this->user->HouseId]);

        $this->syncCalendar($vacationStartDate, $vacationEndDate, $startDate, $endDate);

        if($this->calendarSettings->id){
            $this->calendarSettings->fill([
                'enable_schedule_window' => $this->state['enable_scheduling_window'] ?? 0,
                'StartDateId' => $startDate->DateId,
                'EndDateId' => $endDate->DateId,
            ])->update();
        }
        else{
            $this->calendarSettings->fill([
                'user_id' => $this->user->user_id,
                'house_id' => $this->user->HouseId,
                'enable_schedule_window' => $this->state['enable_scheduling_window'] ?? 0,
                'StartDateId' => $startDate->DateId,
                'EndDateId' => $endDate->DateId,
            ])->save();

        }
        $this->emit('saved');

    }


    public function syncCalendar($startDatetime, $endDatetime, &$startDate, &$endDate)
    {
        // Start Datetime
        $startDay = $startDatetime->day;
        $startMonth = $startDatetime->month;
        $startYear = $startDatetime->year;
        $stDate = $startDatetime->format('Y-m-d');
        $stTime = $startDatetime->format('H:i');

        $startDate = Calendar::firstOrNew([
            'Day' => $startDay,
            'Month' => $startMonth,
            'Year' => $startYear,
            'RealDate' => $stDate,
        ]);

        $startTime = Time::firstOrNew([
            'time' => $stTime,
        ]);

        if (!$startDate->exists) $startDate->save();
        if (!$startTime->exists) $startTime->save();


        $endDay = $endDatetime->day;
        $endMonth = $endDatetime->month;
        $endYear = $endDatetime->year;
        $enDate = $endDatetime->format('Y-m-d');
        $enTime = $endDatetime->format('H:i');

        $endDate = Calendar::firstOrNew([
            'Day' => $endDay,
            'Month' => $endMonth,
            'Year' => $endYear,
            'RealDate' => $enDate,
        ]);

        $endTime = Time::firstOrNew([
            'time' => $enTime,
        ]);

        if (!$endDate->exists) $endDate->save();
        if (!$endTime->exists) $endTime->save();
    }


}
