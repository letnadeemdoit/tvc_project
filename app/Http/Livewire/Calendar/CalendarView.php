<?php

namespace App\Http\Livewire\Calendar;

use Livewire\Component;

class CalendarView extends Component
{
    public $user;

    public function render()
    {
        return view('dash.calendar.calendar-view');
    }
}
