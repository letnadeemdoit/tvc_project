<?php

namespace App\Http\Livewire\Calendar;

use App\Models\House;
use App\Models\Room\Room;
use App\Models\User;
use App\Models\Vacation;
use Livewire\Component;

class CalendarView extends Component
{
    public $user;

    public $selectedHouses = [];
    public $properties = null;
    protected $queryString = [
        'properties' => ['except' => null],
    ];

    protected $listeners = [
        'vacation-schedule-successfully' => '$refresh'
    ];

    public function mount() {
        if ($this->user->is_admin) {
            if ($this->properties) {
                $this->selectedHouses = explode(',', $this->properties);
            }
        }
    }

    public function render()
    {
        if ($this->user->is_admin) {
            $vacations = Vacation::whereIn('HouseId', $this->properties ? $this->selectedHouses : $this->houses->pluck('HouseID')->toArray())->get();
        } else {
            $vacations = Vacation::where('HouseId', $this->user->HouseId)->get();
        }

        $rooms = Room::where('HouseId', $this->user->HouseId)->get();

        $events = [];
        foreach ($vacations as $vacation) {
            $events[] = $vacation->toCalendar();
        }

        $resourceTimeline = [];
        foreach ($rooms as $room) {
            $resourceTimeline[] = $room->toCalendarResource();
        }

        return view('dash.calendar.calendar-view', compact('events', 'resourceTimeline'));
    }

    public function setProperty($property = null) {
        if ($property) {
            $this->redirect(route('dash.calendar', ['properties' => implode(',', $this->selectedHouses)]));
        } else {
            $this->redirect(route('dash.calendar'));
        }
    }

    public function getHousesProperty()
    {
        return House::whereHas('users', function ($query) {
            $query->where([
                'email' => $this->user->email,
                'role' => User::ROLE_ADMINISTRATOR,
            ]);
        })->get();
    }
}
