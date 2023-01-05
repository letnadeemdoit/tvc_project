<?php

namespace App\Http\Livewire\Settings\Vacations;

use App\Models\User;
use App\Models\Vacation;
use App\Models\VacationRoom;
use App\Notifications\CalendarEmailNotification;
use App\Rules\VacationSchedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ScheduleVacationRoomForm extends Component
{
    public $user;
    public $vacationRoom;

    public $state = [];
    public ?Vacation $vacation;

    public $house = null;
    public $selectedVacation = [];
    public $owner = null;

    public $isCreating = false;

    protected $listeners = [
        'showVacationRoomScheduleModal',
    ];


    public function showVacationRoomScheduleModal($toggle, $roomId, $vacationRoomId = null, $initialDate = null, $owner = null, $house = null)
    {
        $this->vacationRoom = VacationRoom::firstOrNew(['id' => $vacationRoomId]);
        $this->reset('state');

        $this->house = $house;
        $this->owner = $owner;

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
            $vacationRooms = [];

            $this->state = [
                'vacation_id' => $this->vacationRoom->vacation_id,
                'start_datetime' => $this->vacationRoom->starts_at->format('m/d/Y h:i'),
                'end_datetime' => $this->vacationRoom->ends_at->format('m/d/Y h:i'),
                'start_end_datetime' => $this->vacationRoom->starts_at->format('m/d/Y h:i') . ' - ' . $this->vacationRoom->ends_at->format('m/d/Y h:i'),

            ];
        } else {
            $this->isCreating = true;
            $this->state = [
                'book_rooms' => 0,
                'vacation_rooms' => [],
            ];

            if ($initialDate) {
                try {
                    $initialDatetime = Carbon::parse($initialDate);
                    $this->state['start_datetime'] = $initialDatetime->format('m/d/Y h:i');
                    $this->state['end_datetime'] = $initialDatetime->format('m/d/Y h:i');
                    $this->state['start_end_datetime'] = $initialDatetime->format('m/d/Y h:i') . ' - ' . $initialDatetime->format('m/d/Y h:i');
                } catch (\Exception $e) {

                }
            }
        }

        $this->dispatchBrowserEvent('schedule-vacation-daterangepicker-update', ['startDatetime' => $this->state['start_datetime'] ?? now()->format('m/d/Y h:i'), 'endDatetime' => $this->state['end_datetime'] ?? now()->addDays(2)->format('m/d/Y h:i')]);
    }

    public function onChangeVacation()
    {
        $this->selectedVacation = Vacation::where('VacationId', $this->state['vacation_id'])->first();

//        dd($this->selectedVacation);

        $this->dispatchBrowserEvent('onChangeVacation', ['startsAt' => $this->selectedVacation->startDatetime->format('m/d/Y h:i'), 'endsAt' => $this->selectedVacation->endDatetime->format('m/d/Y h:i')]);
    }

    public function saveVacationRoomSchedule()
    {
        $this->resetErrorBag();

        Validator::make($this->state, [
            'vacation_id' => ['required', 'string', 'max:100'],
            'room_id' => ['required', 'string', 'max:100'],
            'start_datetime' => ['required'],

            ])->validateWithBag('saveVacationRoomSchedule');

        $startDatetime = Carbon::parse($this->state['start_datetime']);
        $endDatetime = Carbon::parse($this->state['end_datetime']);

        $this->vacationRoom->fill([
            'vacation_id' => $this->state['vacation_id'],
            'room_id' => $this->roomId,
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
}
