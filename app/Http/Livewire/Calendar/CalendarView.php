<?php

namespace App\Http\Livewire\Calendar;

use App\Models\Vacation;
use Livewire\Component;

class CalendarView extends Component
{
    public $user;

    public function render()
    {
        $vacations = Vacation::where('HouseId', $this->user->HouseId)->get();

        $events = [];
        foreach ($vacations as $vacation) {
            $events[] = $vacation->toCalendar();
        }
        return view('dash.calendar.calendar-view', compact('events'));
    }
}
