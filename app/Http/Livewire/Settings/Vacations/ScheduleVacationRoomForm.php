<?php

namespace App\Http\Livewire\Settings\Vacations;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\Room\Room;
use App\Models\Vacation;
use App\Models\VacationRoom;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ScheduleVacationRoomForm extends Component
{
    use Destroyable;

    public $user;
    public $vacationRoom;

    public $state = [];
    public ?Vacation $vacation;

    public $house = null;

    public $room = null;

    public $houseRooms = null;

    public $start_datetime = null;
    public $end_datetime = null;

    public $vacationRoomId = null;
    public $selectedVacation = [];
    public $owner = null;

    public $isCreating = false;

    public $vacationId = null;

    protected $queryString = [
        'vacationId' => ['except' => null],
    ];

    protected $destroyableConfirmationContent = [
        'title' => '',
        'description' => ''
    ];

    protected $listeners = [
//        'showVacationRoomScheduleModal',
        'setVacationId' => 'setVacationId',
//        'vacation-schedule-successfully' => 'destroyedSuccessfully',
    ];

    public function setVacationId($VacationId)
    {
        $this->vacationId = $VacationId;
    }

    public function showVacationRoomScheduleModal($roomId, $vacationRoomId = null, $initialDate = null, $owner = null, $house = null)
    {

        $this->room = Room::where('RoomID', $roomId)->first();

        $this->vacationRoom = VacationRoom::firstOrNew(['id' => $vacationRoomId]);
        $this->reset('state');

        $this->house = $house;
        $this->owner = $owner;

        $this->roomId = $this->vacationRoom['room_id'];

        $this->vacationRoomId = $vacationRoomId;

//        if ($this->vacationRoom->OwnerId !== $this->user->user_id) {
//            $this->emit('showRequestToJoinVacationModal', true, $this->vacationRoom->vacation_id);
//            return;
//        }

        if ($this->vacationRoom->VacationName && !$this->user->is_admin) {
            if ($this->vacation->OwnerId !== $this->user->user_id) {
                $this->emit('showRequestToJoinVacationModal', true, $this->vacation_id);
                return;
            } elseif ($this->vacationRoom->parent_id !== null) {
                $this->vacation = Vacation::firstOrNew(['VacationID' => $this->vacationRoom->parent_id]);
            }
        } elseif ($this->vacationRoom->parent_id !== null) {
            $this->vacationRoom = Vacation::firstOrNew(['VacationID' => $this->vacationRoom->parent_id]);
        }

//        $this->emitSelf('toggle', $toggle);

        if ($this->vacationRoom->id) {
            $this->isCreating = false;
            $this->state = [
                'vacation_id' => $this->vacationRoom->vacation_id,
                'room_id' => $this->vacationRoom->room_id,
                'start_date' => $this->vacationRoom->starts_at->format('m/d/Y h:i'),
                'end_date' => $this->vacationRoom->ends_at->format('m/d/Y h:i'),
                'start_end_datetime' => $this->vacationRoom->starts_at->format('m/d/Y h:i') . ' - ' . $this->vacationRoom->ends_at->format('m/d/Y h:i'),
            ];

        } else {
            $this->isCreating = true;
            $this->state = [
                'vacation_id' => $this->vacationId,
                'room_id' => $roomId,
                'book_rooms' => 0,
                'vacation_rooms' => [],
            ];

            if ($initialDate) {
                try {
                    $initialDatetime = Carbon::parse($initialDate);
                    $this->state['start_date'] = $initialDatetime->format('m/d/Y h:i');
                    $this->state['end_date'] = $initialDatetime->format('m/d/Y h:i');
                    $this->state['start_end_datetime'] = $initialDatetime->format('m/d/Y h:i') . ' - ' . $initialDatetime->format('m/d/Y h:i');
                } catch (\Exception $e) {

                }
            }
        }

//        $this->dispatchBrowserEvent('schedule-vacation-room-daterangepicker-update', ['startDatetime' => $this->state['start_datetime'] ?? now()->format('m/d/Y h:i'), 'endDatetime' => $this->state['end_datetime'] ?? now()->addDays(2)->format('m/d/Y h:i')]);
    }

    public function onChangeRoomVacation()
    {
        $selectedVacation = Vacation::where('VacationId', $this->state['vacation_id'] ?? '')->first();
        $this->start_datetime = $selectedVacation->start_datetime->format('d-m-Y H:i');
        $this->end_datetime = $selectedVacation->end_datetime->format('d-m-Y H:i');
        $this->state['start_date'] = $selectedVacation->start_datetime->format('m/d/Y h:i');
        $this->state['end_date'] = $selectedVacation->end_datetime->format('m/d/Y h:i');
        $this->dispatchBrowserEvent('on-vacation-room-change', ['startsAt' => $selectedVacation->startDatetime->format('m/d/Y H:i'), 'endsAt' => $selectedVacation->endDatetime->format('m/d/Y H:i'), 'startDate' => $this->start_datetime, 'endDate' => $this->end_datetime]);
    }

    public function saveVacationRoomSchedule()
    {
        $this->resetErrorBag();

        $startDatetime = Carbon::parse($this->state['start_date'])->format('Y-m-d H:i');
        $endDatetime = Carbon::parse($this->state['end_date'])->format('Y-m-d H:i');

        Validator::make($this->state, [
            'vacation_id' => ['required'],
            'occupant_name' => ['required'],
            'start_date' => ['required'],
        ])->after(function ($validator) use ($startDatetime, $endDatetime) {

            $vacation = Vacation::where('VacationId', $this->state['vacation_id'] ?? '')->first();

            if ($vacation && !($vacation->startDatetime->lte($startDatetime) && $vacation->endDatetime->gte($endDatetime))) {
                $validator->errors()->add('vacation_id', __('You can schedule room  ' . $vacation->startDatetime . ' - ' . $vacation->endDatetime . ' date time against ' . $vacation->VacationName . '  vacation.'));
            }

            $vacationRoom = VacationRoom::where('vacation_id', $this->state['vacation_id'] ?? '')
                ->where('room_id', $this->state['room_id'])
                ->where(function ($query) use ($startDatetime, $endDatetime) {
                    $query
                        ->where(function ($query) use ($startDatetime, $endDatetime) {
                            $query
                                ->where('starts_at', '>=', $startDatetime)
                                ->where('starts_at', '<=', $endDatetime);
                        })
                        ->orWhere(function ($query) use ($startDatetime, $endDatetime) {
                            $query
                                ->where('ends_at', '>=', $startDatetime)
                                ->where('ends_at', '<=', $endDatetime);
                        })
                        ->orWhere(function ($query) use ($startDatetime, $endDatetime) {
                            $query
                                ->where('starts_at', '<=', $startDatetime)
                                ->where('ends_at', '>=', $startDatetime);
                        })
                        ->orWhere(function ($query) use ($startDatetime, $endDatetime) {
                            $query
                                ->where('starts_at', '<=', $endDatetime)
                                ->where('ends_at', '>=', $endDatetime);
                        });
                })
                ->when(!$this->isCreating, function ($query) {
                    $query->whereNot('id', $this->vacationRoom->id);
                })
                ->first();

            if ($vacationRoom) {
                $validator->errors()->add('starts_at', __('Room already reserved in this vacation at given datetime'));
            }
        })->validateWithBag('saveVacationRoomSchedule');

//        if ($this->isCreating) {
//            $this->vacationRoom->room_id = $this->state['room_id'];
//        }

        $this->vacationRoom->fill([
            'vacation_id' => $this->state['vacation_id'],
            'room_id' => $this->state['room_id'],
            'occupant_name' => $this->state['occupant_name'],
            'starts_at' => $startDatetime,
            'ends_at' => $endDatetime,
        ])->save();

        session()->forget('startDatetime');
        Session::put('startRoomDatetime', $startDatetime);


        if($this->isCreating) {
            return redirect()->route('dash.calendar')->with('successMessage', 'Your vacation room has been scheduled successfully.');
        }
        else{
            return redirect()->route('dash.calendar')->with('successMessage', 'Scheduled vacation room has been updated successfully.');
        }
//        $this->emitSelf('toggle', false);
//        $this->emit('vacation-schedule-successfully');
    }


    public function render()
    {
        $vacations = Vacation::where('HouseId', current_house()->HouseID)->get();
        $this->houseRooms = Room::where('HouseID', current_house()->HouseID)->get();
        return view('dash.settings.vacations.schedule-vacation-room-form', compact('vacations'));
    }


    public function mount($roomId, $vacationRoomId = null, $initialDate = null, $owner = null, $house = null)
    {
        $start_time = null;
        $end_time = null;
        if (session()->has('setVacationIdForRoom')){
            $this->vacationId = session()->get('setVacationIdForRoom');
            session()->forget('setVacationIdForRoom');
        }

        $this->model = VacationRoom::class;
        $this->room = Room::where('RoomID', $roomId)->first();

        $this->vacationRoom = VacationRoom::firstOrNew(['id' => $vacationRoomId]);
        $this->reset('state');

        $this->house = $house;
        $this->owner = $owner;

        $this->roomId = $this->vacationRoom['room_id'];

        $this->vacationRoomId = $vacationRoomId;

        if (!is_null($this->vacationId)){
            $currentVacation = Vacation::where('VacationId' ,$this->vacationId)->first();
            $this->start_datetime = $currentVacation->start_datetime->format('d-m-Y H:i');
            $start_time = $currentVacation->start_datetime->addHour(1)->format('H:i');
            $this->end_datetime = $currentVacation->end_datetime->format('d-m-Y H:i');
            $end_time = $currentVacation->end_datetime->format('H:i');
        }
        if($this->vacationRoom->vacation_id){
            $currentVacation = Vacation::where('VacationId' , $this->vacationRoom->vacation_id)->first();
            $this->start_datetime = $currentVacation->start_datetime->format('d-m-Y H:i');
            $start_time = $currentVacation->start_datetime->addHour(1)->format('H:i');
            $this->end_datetime = $currentVacation->end_datetime->format('d-m-Y H:i');
            $end_time = $currentVacation->end_datetime->format('H:i');
        }

//        if ($this->vacationRoom->OwnerId !== $this->user->user_id) {
//            $this->emit('showRequestToJoinVacationModal', true, $this->vacationRoom->vacation_id);
//            return;
//        }

        if ($this->vacationRoom->VacationName && !$this->user->is_admin) {
            if ($this->vacation->OwnerId !== $this->user->user_id) {
                $this->emit('showRequestToJoinVacationModal', true, $this->vacation_id);
                return;
            } elseif ($this->vacationRoom->parent_id !== null) {
                $this->vacation = Vacation::firstOrNew(['VacationID' => $this->vacationRoom->parent_id]);
            }
        } elseif ($this->vacationRoom->parent_id !== null) {
            $this->vacationRoom = Vacation::firstOrNew(['VacationID' => $this->vacationRoom->parent_id]);
        }
//        $this->emitSelf('toggle', $toggle);

        if ($this->vacationRoom->id) {
            $this->isCreating = false;
            $this->state = [
                'room_name' => $this->room->RoomName,
                'vacation_id' => $this->vacationRoom->vacation_id,
                'occupant_name' => $this->vacationRoom->occupant_name,
                'room_id' => $this->vacationRoom->room_id,
                'start_date' => $this->vacationRoom->starts_at->format('m/d/Y H:i'),
                'end_date' => $this->vacationRoom->ends_at->format('m/d/Y H:i'),
                'start_end_datetime' => $this->vacationRoom->starts_at->format('m/d/Y H:i') . ' - ' . $this->vacationRoom->ends_at->format('m/d/Y H:i'),
            ];

        } else {
            $this->isCreating = true;
            $this->state = [
                'room_id' => $roomId,
                'book_rooms' => 0,
                'vacation_rooms' => [],
            ];

            if ($initialDate) {
                try {
                    $initialDatetime = Carbon::parse($initialDate);
                    $this->state['start_date'] = $initialDatetime->addHour(12)->format('m/d/Y H:i');
                    $this->state['end_date'] = $initialDatetime->format('m/d/Y H:i');
                    $this->state['start_end_datetime'] = $this->state['start_date'] . ' - ' . $this->state['end_date'];

                    $vacations = Vacation::where('HouseId', current_house()->HouseID)->get();
                    $currentDate = date('Y-m-d H:i', strtotime($initialDatetime));
                    foreach ($vacations as $vacation) {
                        $start_date = date('Y-m-d H:i', strtotime($vacation->start_datetime));
                        $end_date = date('Y-m-d H:i', strtotime($vacation->end_datetime));
                        if (($currentDate >= $start_date) && ($currentDate <= $end_date)){
                            $this->state['vacation_id'] = $vacation->VacationId;
                        }
                    }
                } catch (\Exception $e) {

                }
            }
        }

//        $this->dispatchBrowserEvent('schedule-vacation-room-daterangepicker-update', ['startDatetime' => $this->state['start_datetime'] ?? now()->format('m/d/Y h:i'), 'endDatetime' => $this->state['end_datetime'] ?? now()->addDays(2)->format('m/d/Y h:i')]);

    }

//    public function destroyedSuccessfully($data)
//    {
//        $this->emit('vacation-room-destroyed-successfully');
//
//    }

    public function destroy($id)
    {
        $this->emitSelf('toggle', false);

        if ($this->model) {
            $deletableModel = app($this->model)->findOrFail($id);
            $this->emit(
                'destroyable-confirmation-modal',
                $this->model,
                $id,
                $this->destroyableConfirmationContent,
            );
        }
    }
    public function cancelRoomVacation(){
        return redirect()->route('dash.calendar');
    }
}
