<?php

namespace App\Http\Livewire\Calendar;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\House;
use App\Models\Room\Room;
use App\Models\User;
use App\Models\Vacation;
use App\Notifications\DeleteNotification;
use Exception;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class CalendarView extends Component
{
    use Destroyable;

    public $user;

    public $startVacationDataTime;

    public $startRoomDatetime;

    public $setVacationId;

    public $start_vac;
    public $end_vac;
    public $name_vac;

    public $vacationId = null;
    public $selectedHouses = [];
    public $properties = null;

    public $owner = null;
    protected $queryString = [
        'properties' => ['except' => null],
        'owner' => ['except' => null],
        'vacationId' => ['except' => null],
    ];

    protected $listeners = [
        'setVacationId' => 'setVacationId',
        'vacation-schedule-successfully' => 'renderCalendar',
        'destroyed-scheduled-successfully' => 'destroyedSuccessfully',
        'destroy-vacation' => 'destroy',
        'vacation-room-destroyed-successfully' => 'renderCalendar'
    ];

    public function mount()
    {
        $this->model = Vacation::class;
        if ($this->user->is_admin) {
            if ($this->properties) {
                $this->selectedHouses = explode(',', $this->properties);
            }
        }
        if (session()->has('startDatetimeForDeleteRoom')) {
            $this->startRoomDatetime = session()->get('startDatetimeForDeleteRoom');
            session()->forget('startDatetimeForDeleteRoom');
        }
        if (session()->has('startDatetimeForDeleteVacation')) {
            $this->startVacationDataTime = session()->get('startDatetimeForDeleteVacation');
            session()->forget('startDatetimeForDeleteVacation');
        }
        if (session()->has('setVacationId')){
            $this->setVacationId = session()->get('setVacationId');
            Session::put('setVacationIdForRoom', $this->setVacationId);
            session()->forget('setVacationId');
            $currentVacation = Vacation::where('VacationID' ,$this->setVacationId)->first();
            $this->start_vac = $currentVacation->start_datetime->format('Y-m-d H:i');
            $this->end_vac = $currentVacation->end_datetime->format('Y-m-d H:i');
            $this->name_vac = $currentVacation->VacationName;
        }
        if (session()->has('startDatetimeVacation')){
            $this->startVacationDataTime = session()->get('startDatetimeVacation');
            session()->forget('startDatetimeVacation');
        }
        if (session()->has('startRoomDatetime')) {
            $this->startRoomDatetime = session()->get('startRoomDatetime');
            session()->forget('startRoomDatetime');
        }
    }

    public function render()
    {
        return view('dash.calendar.calendar-view');
    }

    public function setProperty($property = null)
    {
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
                'role' => User::ROLE_ADMINISTRATOR,
            ])->where(function ($query) {
                $query->where('email', $this->user->email)
                    ->when($this->user->primary_account, function ($query) {
                        $query->orWhere('parent_id', $this->user->user_id);
                    })
                    ->when(!$this->user->primary_account, function ($query) {
                        $query->orWhere(function ($query) {
                            $query->where('parent_id', $this->user->user_id)
                                ->orWhere('user_id', $this->user->user_id);
                        });
                    });
            });
        })->get();
    }

    public function updatedOwner()
    {
        $this->renderCalendar();
    }

    public function setVacationId($VacationId){
        $this->vacationId = $VacationId;
    }

    public function getEventsProperty()
    {
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
            foreach ($vacation->rooms as $room){
                $events[] = $room->toCalendar();
            }
        }
        return $events;
    }

    public function getResourceTimelineProperty()
    {
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

    public function renderCalendar()
    {
        $this->emit('rerender-calendar', $this->events, $this->resourceTimeline);
        session()->forget('setVacationId');
//        $this->emit('vacation-schedule-successfully');
    }

    public function getOwnersProperty()
    {
        return User::where('HouseId', $this->user->HouseId)->where('role', '<>', User::ROLE_GUEST)->where('user_id', '<>', $this->user->user_id)->get();
    }

    public function destroy($id)
    {
        if ($this->model) {
            $deletableModel = app($this->model)->findOrFail($id);
            $this->emit(
                'destroyable-confirmation-modal',
                $this->model,
                $id,
                $this->destroyableConfirmationContent,
                'destroyed-scheduled-successfully'
            );

            $this->emitSelf('toggle', false);
        }
    }

    public function destroyedSuccessfully($data)
    {

        $this->emitSelf('vacation-schedule-successfully');

        $this->emitSelf('toggle', false);

        Vacation::where('parent_id', $data['VacationId'])->delete();

        $name = $data['VacationName'];


        try {
            $createdHouseName = $this->user->house->HouseName;
            $isAction = 'Deleted';
            $isModal = 'Vacation';


            if (!is_null($this->user->house->CalEmailList) && !empty($this->user->house->CalEmailList)) {

                $CalEmailList = explode(',', $this->user->house->CalEmailList);

                if (count($CalEmailList) > 0 && !empty($CalEmailList)) {

                    $users = User::whereIn('email', $CalEmailList)->where('HouseId', $this->user->HouseId)->get();

                    foreach ($users as $user) {
                        $user->notify(new DeleteNotification($name, $isAction,$createdHouseName,$isModal));
                    }

                    $CalEmailList = array_diff($CalEmailList, $users->pluck('email')->toArray());

                    if (count($CalEmailList) > 0) {

                        Notification::route('mail', $CalEmailList)
                            ->notify(new DeleteNotification($name, $isAction,$createdHouseName,$isModal));

                    }
                }
            }
        } catch (Exception $e) {

        }
    }
}
