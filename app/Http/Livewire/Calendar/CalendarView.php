<?php

namespace App\Http\Livewire\Calendar;

use App\Models\House;
use App\Models\Room\Room;
use App\Models\User;
use App\Models\Vacation;
use App\Notifications\DeleteNotification;
use Exception;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class CalendarView extends Component
{
    public $user;

    public $selectedHouses = [];
    public $properties = null;

    public $owner = null;
    protected $queryString = [
        'properties' => ['except' => null],
        'owner' => ['except' => null],
    ];

    protected $listeners = [
        'vacation-schedule-successfully' => 'renderCalendar',
        'destroyed-scheduled-successfully' => 'destroyedSuccessfully',
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
        return view('dash.calendar.calendar-view');
    }

    public function setProperty($property = null) {
        if ($property) {
            $this->properties = implode(',', $this->selectedHouses);
        } else {
            $this->properties = null;
        }

        $this->renderCalendar();
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

    public function updatedOwner()
    {
        $this->renderCalendar();
    }

    public function getEventsProperty() {
        if ($this->user->is_admin) {
            $vacations = Vacation::whereIn('HouseId', $this->properties ? $this->selectedHouses : $this->houses->pluck('HouseID')->toArray())
                    ->when($this->user->user_id !== $this->owner && $this->owner !== null, function ($query) {
                        $query->where('OwnerId', $this->owner);
                    })
                    ->get();
        } else {
            $vacations = Vacation::where('HouseId', $this->user->HouseId)->get();
        }

        $events = [];
        foreach ($vacations as $vacation) {
            $events[] = $vacation->toCalendar();
        }

        return $events;
    }

    public function getResourceTimelineProperty() {

        if ($this->user->is_admin) {
            $rooms = Room::whereIn('HouseId', $this->properties ? $this->selectedHouses : User::where('email', $this->user->email)->pluck('HouseId')->toArray())->get();
        } else {
            $rooms = Room::where('HouseId', $this->user->HouseId)->get();
        }



        $resourceTimeline = [];
        foreach ($rooms as $room) {
            $resourceTimeline[] = $room->toCalendarResource();
        }

        return $resourceTimeline;
    }

    public function renderCalendar() {
        $this->emit('rerender-calendar', $this->events, $this->resourceTimeline);
    }
    public function getOwnersProperty()
    {
        return User::where('HouseId', $this->user->HouseId)->where('role', '<>', User::ROLE_GUEST)->where('user_id', '<>', $this->user->user_id)->get();
    }

    public function destroyedSuccessfully($data)
    {

        $this->emitSelf('vacation-schedule-successfully');

        $this->emitSelf('toggle', false);

        $name = $data['VacationName'];

        $deleteType = 'Vacation';

        try {

            if (!is_null($this->user->house->CalEmailList) && !empty($this->user->house->CalEmailList)) {

                $CalEmailList = explode(',', $this->user->house->CalEmailList);

                if (count($CalEmailList) > 0 && !empty($CalEmailList)) {

                    $users = User::whereIn('email', $CalEmailList)->where('HouseId', $this->user->HouseId)->get();

                    foreach ($users as $user) {
                        $user->notify(new DeleteNotification($name, $deleteType));
                    }

                    $CalEmailList = array_diff($CalEmailList, $users->pluck('email')->toArray());

                    if (count($CalEmailList) > 0) {

                        Notification::route('mail', $CalEmailList)
                            ->notify(new DeleteNotification($name, $deleteType));

                    }
                }
            }
        } catch (Exception $e) {

        }
    }
}
