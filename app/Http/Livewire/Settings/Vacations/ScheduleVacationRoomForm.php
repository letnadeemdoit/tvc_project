<?php

namespace App\Http\Livewire\Settings\Vacations;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\Room\Room;
use App\Models\Vacation;
use App\Models\VacationRoom;
use Carbon\Carbon;
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

    public $vacationRoomId = null;
    public $selectedVacation = [];
    public $owner = null;

    public $isCreating = false;

    public $vacationId = null;

    protected $queryString = [
        'vacationId' => ['except' => null],
    ];

    protected $listeners = [
        'showVacationRoomScheduleModal',
        'setVacationId' => 'setVacationId',
        'vacation-room-destroyed-successfully' => 'destroyedSuccessfully',
    ];

    public function setVacationId($VacationId)
    {
        $this->vacationId = $VacationId;
    }

    public function showVacationRoomScheduleModal($toggle, $roomId, $vacationRoomId = null, $initialDate = null, $owner = null, $house = null)
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

        $this->emitSelf('toggle', $toggle);

        if ($this->vacationRoom->id) {
            $this->isCreating = false;
            $this->state = [
                'vacation_id' => $this->vacationRoom->vacation_id,
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

        $this->dispatchBrowserEvent('on-vacation-room-change', ['startsAt' => $selectedVacation->startDatetime->format('m/d/Y h:i'), 'endsAt' => $selectedVacation->endDatetime->format('m/d/Y h:i')]);
    }

    public function saveVacationRoomSchedule()
    {
        $this->resetErrorBag();

        $startDatetime = Carbon::parse($this->state['start_date'])->format('Y-m-d H:i:s');
        $endDatetime = Carbon::parse($this->state['end_date'])->format('Y-m-d H:i:s');

        Validator::make($this->state, [
            'vacation_id' => ['required'],
            'start_date' => ['required'],
        ])->after(function ($validator) use ($startDatetime, $endDatetime) {

            $vacation = Vacation::where('VacationId', $this->state['vacation_id'] ?? '')->first();


            if ($vacation && !($vacation->startDatetime->lte($startDatetime) && $vacation->endDatetime->gte($endDatetime))) {
                $validator->errors()->add('vacation_id', __('Room date time should between/equal to  '. $vacation->startDatetime .' - '. $vacation->endDatetime  .' date.'));
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

//            dd($vacationRoom);

            if ($vacationRoom) {
                $validator->errors()->add('starts_at', __('Room already reserved in this vacation at given datetime'));
            }
        })->validateWithBag('saveVacationRoomSchedule');

        if ($this->isCreating) {
            $this->vacationRoom->room_id = $this->state['room_id'];
        }

        $this->vacationRoom->fill([
            'vacation_id' => $this->state['vacation_id'],
            'starts_at' => $startDatetime,
            'ends_at' => $endDatetime,
        ])->save();

        $this->emitSelf('toggle', false);
        $this->emit('vacation-schedule-successfully');
    }


    public function render()
    {
        $vacations = Vacation::where('HouseId', current_house()->HouseID)->get();
        return view('dash.settings.vacations.schedule-vacation-room-form', compact('vacations'));
    }


    public function mount()
    {
        $this->model = VacationRoom::class;
    }

//    public function destroyedSuccessfully($data)
//    {
//        dd('ds');
//
//        $this->emit('vacation-room-destroyed-successfully');
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
                "vacation-schedule-successfully"
            );
        }
    }
}
