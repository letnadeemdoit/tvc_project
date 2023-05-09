<?php

namespace App\Http\Livewire\Settings\Vacations;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\Calendar;
use App\Models\Schedule;
use App\Models\Time;
use App\Models\User;
use App\Models\Vacation;
use App\Models\VacationRoom;
use App\Notifications\BlogNotification;
use App\Notifications\CalendarEmailNotification;
use App\Notifications\DeleteNotification;
use App\Rules\VacationSchedule;
use Carbon\Carbon;
use Cookie;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ScheduleVacationForm extends Component
{
    use Destroyable;
    public $user;

    public $state = [];
    public ?Vacation $vacation;

    public $vacationListRoute = null;

    public $house = null;
    public $owner = null;

    public $updateVac = false;
    public $manageVac = false;

    public $isCreating = false;
    protected $destroyableConfirmationContent = [
        'title' => '',
        'description' => ''
    ];
    protected $listeners = [
        'vacation-deleted-successfully' => 'destroyedSuccessfully'
    ];

    public function mount($vacationId = null, $initialDate = null, $owner = null, $house = null, $vacationListRoute = null)
    {
        $this->model = Vacation::class;

        $this->vacationListRoute = $vacationListRoute;

        Cookie::queue('vbc', '#E8604C', 10000);
        Cookie::queue('vfc', '#ffffff', 10000);

        $this->vacation = Vacation::firstOrNew(['VacationID' => $vacationId]);
        $this->reset('state');

        $this->house = $house;
        $this->owner = $owner;

        if ($this->vacation->VacationName && !$this->user->is_admin) {
            if ($this->vacation->OwnerId !== $this->user->user_id) {
//                $this->emit('showRequestToJoinVacationModal', true, $vacationId);
            } elseif ($this->vacation->parent_id !== null) {
                $this->vacation = Vacation::firstOrNew(['VacationID' => $this->vacation->parent_id]);
            }
        } elseif ($this->vacation->parent_id !== null) {
            $this->vacation = Vacation::firstOrNew(['VacationID' => $this->vacation->parent_id]);
        }

//        $this->emitSelf('toggle', $toggle);

        if ($this->vacation->VacationName) {
            $this->isCreating = false;
            $vacationRooms = [];

            foreach ($this->vacation->rooms as $rooms) {
                if (!isset($vacationRooms[$rooms->room_id])) {
                    $vacationRooms[$rooms->room_id] = [];
                }

                $vacationRooms[$rooms->room_id][] = [
                    'starts_at' => $rooms->starts_at->format('Y-m-d H:i'),
                    'ends_at' => $rooms->ends_at->format('Y-m-d H:i'),
                    'occupant_name' => $rooms->occupant_name,
                ];
            }

//            dd($this->vacation->start_datetime . ' ' . $this->vacation->end_datetime);

            $this->state = [
                'vacation_name' => $this->vacation->VacationName,
                'start_datetime' => $this->vacation->start_datetime->format('m/d/Y H:i'),
                'end_datetime' => $this->vacation->end_datetime->format('m/d/Y H:i'),
                'background_color' => $this->vacation->BackGrndColor,
                'font_color' => $this->vacation->FontColor,
                'start_end_datetime' => $this->vacation->start_datetime->format('m/d/Y H:i') . ' - ' . $this->vacation->end_datetime->format('m/d/Y H:i'),
                'recurrence' => $this->vacation->recurrence ?? 'once',
                'repeat_interval' => $this->vacation->repeat_interval ?? 0,
                'book_rooms' => $this->vacation->book_rooms,
                'vacation_rooms' => $vacationRooms,
                'rooms' => collect(array_unique($this->vacation->rooms->pluck('room_id')->toArray()))->map(function ($item) { return ['room_id' => $item]; }),

            ];
        } else {
            $this->isCreating = true;
            $this->state = [
                'background_color' => Cookie::get('vbc', '#E8604C'),
                'font_color' => Cookie::get('vfc', '#ffffff'),
                'recurrence' => 'once',
                'book_rooms' => 0,
                'vacation_rooms' => [],
            ];

            if ($initialDate) {
                try {
                    $initialDatetime = Carbon::parse($initialDate);
                    $this->state['start_datetime'] = $initialDatetime->addHour(12)->format('m/d/Y H:i');
                    $this->state['end_datetime'] = $initialDatetime->format('m/d/Y H:i');
                    $this->state['start_end_datetime'] = $initialDatetime->addHour(12)->format('m/d/Y H:i') . ' - ' . $initialDatetime->format('m/d/Y H:i');
                } catch (\Exception $e) {

                }
            }
        }

        $this->dispatchBrowserEvent('schedule-vacation-daterangepicker-update', ['startDatetime' => $this->state['start_datetime'] ?? now()->format('m/d/Y ::i'), 'endDatetime' => $this->state['end_datetime'] ?? now()->addDays(2)->format('m/d/Y H:i')]);

    }

//    public function hydrate(){
//        return redirect()->route('dash.request-to-join-vacation');
//    }

    public function showVacationScheduleModal($toggle, $vacationId = null, $initialDate = null, $owner = null, $house = null)
    {
        $this->vacation = Vacation::firstOrNew(['VacationID' => $vacationId]);
        $this->reset('state');

        $this->house = $house;
        $this->owner = $owner;

        if ($this->vacation->VacationName && !$this->user->is_admin) {
            if ($this->vacation->OwnerId !== $this->user->user_id) {
                return redirect()->route('dash.request-to-join-vacation' , ['vacationId' => $vacationId , 'initialDate' => null]);
//                $this->emit('showRequestToJoinVacationModal', true, $vacationId);
//                return;
            } elseif ($this->vacation->parent_id !== null) {
                $this->vacation = Vacation::firstOrNew(['VacationID' => $this->vacation->parent_id]);
            }
        } elseif ($this->vacation->parent_id !== null) {
            $this->vacation = Vacation::firstOrNew(['VacationID' => $this->vacation->parent_id]);
        }

//        $this->emitSelf('toggle', $toggle);

        if ($this->vacation->VacationName) {
            $this->isCreating = false;
            $vacationRooms = [];

            foreach ($this->vacation->rooms as $rooms) {
                if (!isset($vacationRooms[$rooms->room_id])) {
                    $vacationRooms[$rooms->room_id] = [];
                }

                $vacationRooms[$rooms->room_id][] = [
                    'starts_at' => $rooms->starts_at->format('Y-m-d'),
                    'ends_at' => $rooms->ends_at->format('Y-m-d'),
                ];
            }


            $this->state = [
                'vacation_name' => $this->vacation->VacationName,
                'start_datetime' => $this->vacation->start_datetime->format('m/d/Y h:i'),
                'end_datetime' => $this->vacation->end_datetime->format('m/d/Y h:i'),
                'background_color' => $this->vacation->BackGrndColor,
                'font_color' => $this->vacation->FontColor,
                'start_end_datetime' => $this->vacation->start_datetime->format('m/d/Y h:i') . ' - ' . $this->vacation->end_datetime->format('m/d/Y h:i'),
                'recurrence' => $this->vacation->recurrence ?? 'once',
                'repeat_interval' => $this->vacation->repeat_interval ?? 0,
                'book_rooms' => $this->vacation->book_rooms,
                'vacation_rooms' => $vacationRooms,
                'rooms' => collect(array_unique($this->vacation->rooms->pluck('room_id')->toArray()))->map(function ($item) { return ['room_id' => $item]; }),

            ];
        } else {
            $this->isCreating = true;
            $this->state = [
                'background_color' => Cookie::get('vbc', '#E8604C'),
                'font_color' => Cookie::get('vfc', '#ffffff'),
                'recurrence' => 'once',
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

    public function addRoomSchedule($roomId) {
        if (!isset($this->state['vacation_rooms'][$roomId])) {
            $this->state['vacation_rooms'][$roomId] = [
                ['starts_at' => Carbon::now()->format('Y/m/d'), 'ends_at' => Carbon::now()->format('Y/m/d')],
                ['starts_at' => Carbon::now()->format('Y/m/d'), 'ends_at' => Carbon::now()->format('Y/m/d')]
            ];
        } else {

            $this->state['vacation_rooms'][$roomId][] = ['starts_at' => Carbon::now()->format('Y/m/d'), 'ends_at' => Carbon::now()->format('Y/m/d')];
        }

    }

    public function removeRoomSchedule($roomId, $index) {

        unset($this->state['vacation_rooms'][$roomId][$index]);

        $this->state['vacation_rooms'][$roomId] = array_values($this->state['vacation_rooms'][$roomId]);
    }

    public function checkVacationSchedule($data){
        if ($this->isCreating) {
            $this->saveVacationSchedule();
        }
        else{
            $this->updateVac = false;
            $this->manageVac = false;
            $startDatetime = Carbon::parse($this->state['start_datetime']);
            $endDatetime = Carbon::parse($this->state['end_datetime']);

            $rooms = VacationRoom::where('vacation_id', $this->vacation->VacationId)->get();
            if((count($rooms) > 0) && ($this->vacation->start_datetime->format('m/d/Y') !== $startDatetime->format('m/d/Y') || $this->vacation->end_datetime->format('m/d/Y') !== $endDatetime->format('m/d/Y'))){
                if ($data === 'updateVac'){
                    $this->updateVac = true;
                }
                elseif ($data === 'manageVac'){
                    $this->manageVac = true;
                }
                $data = 'Are You Sure to update Vacation';
                $this->dispatchBrowserEvent('sure-to-update-vacation',['data' => $data]);
            }
            else{
                if ($data === 'updateVac'){
                    $this->saveVacationSchedule();
                }
                elseif ($data === 'manageVac'){
                    $this->manageRooms();
                }
            }
        }
    }
    public function saveVacationSchedule()
    {
        $this->resetErrorBag();

        Validator::make($this->state, [
            'vacation_name' => ['required', 'string', 'max:100'],
            'start_datetime' => ['required', new VacationSchedule($this->state['end_datetime'] ?? null, $this->user, $this->vacation)],
            'background_color' => ['required'],
            'font_color' => ['required'],
            'recurrence' => ['required', 'in:once,monthly,yearly'],
            'repeat_interval' => ($this->state['recurrence'] ?? 'once') !== 'once' ? ['required', 'numeric', 'min:1', 'max:30'] : ['nullable'],
        ], [
            'start_datetime.required' => 'The start & end datetime field is required'
        ])->validateWithBag('saveVacationSchedule');

        $startDatetime = Carbon::parse($this->state['start_datetime']);
        $endDatetime = Carbon::parse($this->state['end_datetime']);



        $this->syncCalendar($startDatetime, $endDatetime, $startDate, $startTime, $endDate, $endTime);

        if (!$this->isCreating){
            if($this->vacation->start_datetime->format('m/d/Y') !== $startDatetime->format('m/d/Y') || $this->vacation->end_datetime->format('m/d/Y') !== $endDatetime->format('m/d/Y')){
                $this->vacation->rooms()->delete();
                unset($this->state['vacation_rooms']);
            }
        }

        if ($this->isCreating) {
            $this->vacation->HouseId = $this->user->is_admin ? ($this->house ?? $this->user->HouseId) : $this->user->HouseId;
            $this->vacation->OwnerId = $this->user->is_admin ? ($this->owner ?? $this->user->user_id) : $this->user->user_id;
        }

        $this->vacation->BackGrndColor = $this->state['background_color'];
        $this->vacation->FontColor = $this->state['font_color'];

        $this->vacation->fill([
            'VacationName' => $this->state['vacation_name'],
            'recurrence' => $this->state['recurrence'] === 'none' ? null : $this->state['recurrence'],
            'StartDateId' => $startDate->DateId,
            'StartTimeId' => $startTime->timeid,
            'EndDateId' => $endDate->DateId,
            'EndTimeId' => $endTime->timeid,
            'repeat_interval' => $this->state['repeat_interval'] ?? 0,
            'book_rooms' => $this->state['book_rooms'] ?? 0,
        ])->save();

        if (
            isset($this->state['book_rooms']) &&
            $this->state['book_rooms'] == 1 &&
            isset($this->state['vacation_rooms']) &&
            is_array($this->state['vacation_rooms']) &&
            count($this->state['vacation_rooms']) > 0
        ) {
            $this->vacation->rooms()->delete();

            foreach ($this->state['vacation_rooms'] as $key => $schedules) {
                foreach ($schedules as $schedule) {
                    $this->vacation->rooms()->save(new VacationRoom([
                        'room_id' => $key,
                        'starts_at' => $schedule['starts_at'],
                        'ends_at' => $schedule['ends_at'],
                        'occupant_name' => $schedule['occupant_name'],
//                                'OwnerId' => $model->OwnerId,
//                                'DateId' => $model->StartDateId
                    ]));
                }
            }

        }

        if ($this->state['recurrence'] !== 'once') {
            if ($this->isCreating) {
                $recurring = [];
                foreach (range(1, intval($this->state['repeat_interval'] ?? 0)) as $interval) {
                    if ($this->state['recurrence'] === 'monthly') {
                        $startDatetime->addMonth();
                        $endDatetime->addMonth();
                    } else {
                        $startDatetime->addYear();
                        $endDatetime->addYear();
                    }
                    $this->syncCalendar($startDatetime, $endDatetime, $startDate, $startTime, $endDate, $endTime);

                    $recurring[] = new Vacation([
                        'VacationName' => $this->state['vacation_name'],
                        'BackGrndColor' => ltrim($this->state['background_color'], '#'),
                        'FontColor' => ltrim($this->state['font_color'], '#'),
                        'recurrence' => $this->state['recurrence'] === 'none' ? null : $this->state['recurrence'],
                        'StartDateId' => $startDate->DateId,
                        'StartTimeId' => $startTime->timeid,
                        'EndDateId' => $endDate->DateId,
                        'EndTimeId' => $endTime->timeid,
                        'HouseId' => $this->user->is_admin ? ($this->house ?? $this->user->HouseId) : $this->user->HouseId,
                        'OwnerId' => $this->user->is_admin ? ($this->owner ?? $this->user->user_id) : $this->user->user_id,
                    ]);
                }

                $models = $this->vacation->recurrings()->saveMany($recurring);
                if (
                    isset($this->state['book_rooms']) &&
                    $this->state['book_rooms'] == 1 &&
                    isset($this->state['vacation_rooms']) &&
                    is_array($this->state['vacation_rooms']) &&
                    count($this->state['vacation_rooms']) > 0
                ) {
                    foreach ($this->state['vacation_rooms'] as $key => $schedules) {
                        foreach ($schedules as $schedule) {
                            foreach ($models as $model) {
                                $model->rooms()->save(new VacationRoom([
                                    'room_id' => $key,
                                    'starts_at' => $schedule['starts_at'],
                                    'ends_at' => $schedule['ends_at'],
//                                'OwnerId' => $model->OwnerId,
//                                'DateId' => $model->StartDateId
                                ]));
                            }
                        }
                    }

                }
            } else {
                $repeatInterval = intval($this->state['repeat_interval'] ?? 0);

                $recurringVacations = $this->vacation->recurrings;

                if (count($recurringVacations) >= $repeatInterval) {
                    $i = 0;
                    foreach ($recurringVacations as $recurringVacation) {
                        if ($i < $repeatInterval) {
                            if ($this->state['recurrence'] === 'monthly') {
                                $startDatetime->addMonth();
                                $endDatetime->addMonth();
                            } else {
                                $startDatetime->addYear();
                                $endDatetime->addYear();
                            }
                            $this->syncCalendar($startDatetime, $endDatetime, $startDate, $startTime, $endDate, $endTime);

                            $recurringVacation->update([
                                'VacationName' => $this->state['vacation_name'],
                                'BackGrndColor' => ltrim($this->state['background_color'], '#'),
                                'FontColor' => ltrim($this->state['font_color'], '#'),
                                'recurrence' => $this->state['recurrence'] === 'none' ? null : $this->state['recurrence'],
                                'StartDateId' => $startDate->DateId,
                                'StartTimeId' => $startTime->timeid,
                                'EndDateId' => $endDate->DateId,
                                'EndTimeId' => $endTime->timeid,
                            ]);
                        } else {
                            $recurringVacation->rooms()->delete();
                            $recurringVacation->delete();
                        }

                        $i++;
                    }
                } elseif (count($recurringVacations) < $repeatInterval) {
                    $i = 0;
                    foreach ($recurringVacations as $recurringVacation) {
                        if ($i < $repeatInterval) {
                            if ($this->state['recurrence'] === 'monthly') {
                                $startDatetime->addMonth();
                                $endDatetime->addMonth();
                            } else {
                                $startDatetime->addYear();
                                $endDatetime->addYear();
                            }
                            $this->syncCalendar($startDatetime, $endDatetime, $startDate, $startTime, $endDate, $endTime);

                            $recurringVacation->update([
                                'VacationName' => $this->state['vacation_name'],
                                'BackGrndColor' => ltrim($this->state['background_color'], '#'),
                                'FontColor' => ltrim($this->state['font_color'], '#'),
                                'recurrence' => $this->state['recurrence'] === 'none' ? null : $this->state['recurrence'],
                                'StartDateId' => $startDate->DateId,
                                'StartTimeId' => $startTime->timeid,
                                'EndDateId' => $endDate->DateId,
                                'EndTimeId' => $endTime->timeid,
                            ]);

                            if (
                                isset($this->state['book_rooms']) &&
                                $this->state['book_rooms'] == 1 &&
                                isset($this->state['vacation_rooms']) &&
                                is_array($this->state['vacation_rooms']) &&
                                count($this->state['vacation_rooms']) > 0
                            ) {
                                $recurringVacation->rooms()->delete();
                                foreach ($this->state['vacation_rooms'] as $key => $schedules) {
                                    foreach ($schedules as $schedule) {
                                        $recurringVacation->rooms()->save(new VacationRoom([
                                            'room_id' => $key,
                                            'starts_at' => $schedule['starts_at'],
                                            'ends_at' => $schedule['ends_at'],
                                        ]));
                                    }
                                }
                            }
                        }
                        $i++;
                    }
                    $repeatInterval = $repeatInterval - $i;
                    if ($repeatInterval > 0) {
                        $recurring = [];
                        foreach (range(0, $repeatInterval) as $interval) {
                            if ($this->state['recurrence'] === 'monthly') {
                                $startDatetime->addMonth();
                                $endDatetime->addMonth();
                            } else {
                                $startDatetime->addYear();
                                $endDatetime->addYear();
                            }
                            $this->syncCalendar($startDatetime, $endDatetime, $startDate, $startTime, $endDate, $endTime);

                            $recurring[] = new Vacation([
                                'VacationName' => $this->state['vacation_name'],
                                'BackGrndColor' => ltrim($this->state['background_color'], '#'),
                                'FontColor' => ltrim($this->state['font_color'], '#'),
                                'recurrence' => $this->state['recurrence'] === 'none' ? null : $this->state['recurrence'],
                                'StartDateId' => $startDate->DateId,
                                'StartTimeId' => $startTime->timeid,
                                'EndDateId' => $endDate->DateId,
                                'EndTimeId' => $endTime->timeid,
                                'HouseId' => $this->user->is_admin ? ($this->house ?? $this->user->HouseId) : $this->user->HouseId,
                                'OwnerId' => $this->user->is_admin ? ($this->owner ?? $this->user->user_id) : $this->user->user_id,
                            ]);
                        }

                        $models = $this->vacation->recurrings()->saveMany($recurring);
                        if (
                            isset($this->state['book_rooms']) &&
                            $this->state['book_rooms'] == 1 &&
                            isset($this->state['vacation_rooms']) &&
                            is_array($this->state['vacation_rooms']) &&
                            count($this->state['vacation_rooms']) > 0
                        ) {
                            foreach ($this->state['rooms'] as $key => $schedules) {
                                foreach ($schedules as $schedule) {
                                    foreach ($models as $model) {
                                        $model->rooms()->save(new VacationRoom([
                                            'room_id' => $key,
                                            'starts_at' => $schedule['starts_at'],
                                            'ends_at' => $schedule['ends_at'],
                                        ]));
                                    }
                                }
                            }

                        }
                    }

                }
            }
        } else {
            if (!$this->isCreating) {
                $this->vacation->recurrings()->delete();
            }
        }

//        if (!is_null($this->user->house->CalEmailList)){
//            $CalEmailList = explode(',',$this->user->house->CalEmailList);
//            if (count($CalEmailList) > 0) {
//                $users = User::whereIn('email', $CalEmailList)->where('HouseId', $this->user->HouseId)->get();
//                foreach ($users as $user) {
//                    $user->notify(new CalendarEmailNotification($items,$createdHouseName,$startDate,$endDate));
//                }
////                Notification::send($users, new CalendarEmailNotification($items,$createdHouseName,$startDate,$endDate));
//                $CalEmailList = array_diff($CalEmailList, $users->pluck('email')->toArray());
//                if (count($CalEmailList) > 0) {
//                    Notification::route('mail', $CalEmailList)
//                        ->notify(new CalendarEmailNotification($items,$createdHouseName,$startDate,$endDate));
//                }
//            }
//        }

        if (isset($this->state['book_rooms']) && $this->state['book_rooms'] == 1 && $this->isCreating){
            Session::put('setVacationId', $this->vacation->VacationId);
            Session::put('startDatetimeVacation', $startDatetime);
//            $this->dispatchBrowserEvent('vacationScheduled');
//            $this->emit('setVacationId', $this->vacation->VacationId);
        }else{
            Session::put('startDatetimeVacation', $startDatetime);
        }

        try {

            $items = $this->vacation;
            $createdHouseName = $this->user->house->HouseName;

            if (!is_null($this->user->house->CalEmailList) && !empty($this->user->house->CalEmailList)) {

                $CalEmailList = explode(',', $this->user->house->CalEmailList);

                if (count($CalEmailList) > 0 && !empty($CalEmailList)) {

                    $users = User::whereIn('email', $CalEmailList)->where('HouseId', $this->user->HouseId)->get();
                    foreach ($users as $user) {
                        $user->notify(new CalendarEmailNotification($items, $createdHouseName, $startDate, $endDate));
                    }
                    $CalEmailList = array_diff($CalEmailList, $users->pluck('email')->toArray());
                    if (count($CalEmailList) > 0) {
                        Notification::route('mail', $CalEmailList)
                            ->notify(new CalendarEmailNotification($items, $createdHouseName, $startDate, $endDate));
                    }

                }
            }

        } catch (Exception $e) {

        }

        Cookie::queue('vbc', $this->state['background_color'], 10000);
        Cookie::queue('vfc', $this->state['font_color'], 10000);
//        $this->emitSelf('toggle', false);
        if ($this->isCreating) {
            if($this->vacationListRoute === 'vacationListRoute'){
                return redirect()->route('dash.settings.vacations')->with('successMessage', 'Your vacation has been scheduled successfully.');
            }
            else{
                return redirect()->route('dash.calendar')->with('successMessage' , 'Your vacation has been scheduled successfully.');
            }
        }
        else{
            if($this->vacationListRoute === 'vacationListRoute'){
                return redirect()->route('dash.settings.vacations')->with('successMessage', 'Your vacation has been scheduled successfully.');
            }
            else{
                return redirect()->route('dash.calendar')->with('successMessage' , 'Your vacation has been scheduled successfully.');
            }
        }
//        $this->emit('vacation-schedule-successfully');
    }

    public function manageRooms()
    {
        $this->resetErrorBag();

        Validator::make($this->state, [
            'vacation_name' => ['required', 'string', 'max:100'],
            'start_datetime' => ['required', new VacationSchedule($this->state['end_datetime'] ?? null, $this->user, $this->vacation)],
            'background_color' => ['required'],
            'font_color' => ['required'],
            'recurrence' => ['required', 'in:once,monthly,yearly'],
            'repeat_interval' => ($this->state['recurrence'] ?? 'once') !== 'once' ? ['required', 'numeric', 'min:1', 'max:30'] : ['nullable'],
        ], [
            'start_datetime.required' => 'The start & end datetime field is required'
        ])->validateWithBag('saveVacationSchedule');

        $startDatetime = Carbon::parse($this->state['start_datetime']);
        $endDatetime = Carbon::parse($this->state['end_datetime']);



        $this->syncCalendar($startDatetime, $endDatetime, $startDate, $startTime, $endDate, $endTime);

        if (!$this->isCreating){
            if($this->vacation->start_datetime->format('m/d/Y') !== $startDatetime->format('m/d/Y') || $this->vacation->end_datetime->format('m/d/Y') !== $endDatetime->format('m/d/Y')){
                $this->vacation->rooms()->delete();
                unset($this->state['vacation_rooms']);
            }
        }
        if ($this->isCreating) {
            $this->vacation->HouseId = $this->user->is_admin ? ($this->house ?? $this->user->HouseId) : $this->user->HouseId;
            $this->vacation->OwnerId = $this->user->is_admin ? ($this->owner ?? $this->user->user_id) : $this->user->user_id;
        }

        $this->vacation->BackGrndColor = $this->state['background_color'];
        $this->vacation->FontColor = $this->state['font_color'];

        $this->vacation->fill([
            'VacationName' => $this->state['vacation_name'],
            'recurrence' => $this->state['recurrence'] === 'none' ? null : $this->state['recurrence'],
            'StartDateId' => $startDate->DateId,
            'StartTimeId' => $startTime->timeid,
            'EndDateId' => $endDate->DateId,
            'EndTimeId' => $endTime->timeid,
            'repeat_interval' => $this->state['repeat_interval'] ?? 0,
            'book_rooms' => $this->state['book_rooms'] ?? 0,
        ])->save();

        if (
            isset($this->state['book_rooms']) &&
            $this->state['book_rooms'] == 1 &&
            isset($this->state['vacation_rooms']) &&
            is_array($this->state['vacation_rooms']) &&
            count($this->state['vacation_rooms']) > 0
        ) {
            $this->vacation->rooms()->delete();

            foreach ($this->state['vacation_rooms'] as $key => $schedules) {
                foreach ($schedules as $schedule) {
                    $this->vacation->rooms()->save(new VacationRoom([
                        'room_id' => $key,
                        'starts_at' => $schedule['starts_at'],
                        'ends_at' => $schedule['ends_at'],
                        'occupant_name' => $schedule['occupant_name'],
//                                'OwnerId' => $model->OwnerId,
//                                'DateId' => $model->StartDateId
                    ]));
                }
            }


        }

        if ($this->state['recurrence'] !== 'once') {
            if ($this->isCreating) {
                $recurring = [];
                foreach (range(1, intval($this->state['repeat_interval'] ?? 0)) as $interval) {
                    if ($this->state['recurrence'] === 'monthly') {
                        $startDatetime->addMonth();
                        $endDatetime->addMonth();
                    } else {
                        $startDatetime->addYear();
                        $endDatetime->addYear();
                    }
                    $this->syncCalendar($startDatetime, $endDatetime, $startDate, $startTime, $endDate, $endTime);

                    $recurring[] = new Vacation([
                        'VacationName' => $this->state['vacation_name'],
                        'BackGrndColor' => ltrim($this->state['background_color'], '#'),
                        'FontColor' => ltrim($this->state['font_color'], '#'),
                        'recurrence' => $this->state['recurrence'] === 'none' ? null : $this->state['recurrence'],
                        'StartDateId' => $startDate->DateId,
                        'StartTimeId' => $startTime->timeid,
                        'EndDateId' => $endDate->DateId,
                        'EndTimeId' => $endTime->timeid,
                        'HouseId' => $this->user->is_admin ? ($this->house ?? $this->user->HouseId) : $this->user->HouseId,
                        'OwnerId' => $this->user->is_admin ? ($this->owner ?? $this->user->user_id) : $this->user->user_id,
                    ]);
                }

                $models = $this->vacation->recurrings()->saveMany($recurring);
                if (
                    isset($this->state['book_rooms']) &&
                    $this->state['book_rooms'] == 1 &&
                    isset($this->state['vacation_rooms']) &&
                    is_array($this->state['vacation_rooms']) &&
                    count($this->state['vacation_rooms']) > 0
                ) {
                    foreach ($this->state['vacation_rooms'] as $key => $schedules) {
                        foreach ($schedules as $schedule) {
                            foreach ($models as $model) {
                                $model->rooms()->save(new VacationRoom([
                                    'room_id' => $key,
                                    'starts_at' => $schedule['starts_at'],
                                    'ends_at' => $schedule['ends_at'],
//                                'OwnerId' => $model->OwnerId,
//                                'DateId' => $model->StartDateId
                                ]));
                            }
                        }
                    }

                }
            } else {
                $repeatInterval = intval($this->state['repeat_interval'] ?? 0);

                $recurringVacations = $this->vacation->recurrings;

                if (count($recurringVacations) >= $repeatInterval) {
                    $i = 0;
                    foreach ($recurringVacations as $recurringVacation) {
                        if ($i < $repeatInterval) {
                            if ($this->state['recurrence'] === 'monthly') {
                                $startDatetime->addMonth();
                                $endDatetime->addMonth();
                            } else {
                                $startDatetime->addYear();
                                $endDatetime->addYear();
                            }
                            $this->syncCalendar($startDatetime, $endDatetime, $startDate, $startTime, $endDate, $endTime);

                            $recurringVacation->update([
                                'VacationName' => $this->state['vacation_name'],
                                'BackGrndColor' => ltrim($this->state['background_color'], '#'),
                                'FontColor' => ltrim($this->state['font_color'], '#'),
                                'recurrence' => $this->state['recurrence'] === 'none' ? null : $this->state['recurrence'],
                                'StartDateId' => $startDate->DateId,
                                'StartTimeId' => $startTime->timeid,
                                'EndDateId' => $endDate->DateId,
                                'EndTimeId' => $endTime->timeid,
                            ]);
                        } else {
                            $recurringVacation->rooms()->delete();
                            $recurringVacation->delete();
                        }

                        $i++;
                    }
                } elseif (count($recurringVacations) < $repeatInterval) {
                    $i = 0;
                    foreach ($recurringVacations as $recurringVacation) {
                        if ($i < $repeatInterval) {
                            if ($this->state['recurrence'] === 'monthly') {
                                $startDatetime->addMonth();
                                $endDatetime->addMonth();
                            } else {
                                $startDatetime->addYear();
                                $endDatetime->addYear();
                            }
                            $this->syncCalendar($startDatetime, $endDatetime, $startDate, $startTime, $endDate, $endTime);

                            $recurringVacation->update([
                                'VacationName' => $this->state['vacation_name'],
                                'BackGrndColor' => ltrim($this->state['background_color'], '#'),
                                'FontColor' => ltrim($this->state['font_color'], '#'),
                                'recurrence' => $this->state['recurrence'] === 'none' ? null : $this->state['recurrence'],
                                'StartDateId' => $startDate->DateId,
                                'StartTimeId' => $startTime->timeid,
                                'EndDateId' => $endDate->DateId,
                                'EndTimeId' => $endTime->timeid,
                            ]);

                            if (
                                isset($this->state['book_rooms']) &&
                                $this->state['book_rooms'] == 1 &&
                                isset($this->state['vacation_rooms']) &&
                                is_array($this->state['vacation_rooms']) &&
                                count($this->state['vacation_rooms']) > 0
                            ) {
                                $recurringVacation->rooms()->delete();
                                foreach ($this->state['vacation_rooms'] as $key => $schedules) {
                                    foreach ($schedules as $schedule) {
                                        $recurringVacation->rooms()->save(new VacationRoom([
                                            'room_id' => $key,
                                            'starts_at' => $schedule['starts_at'],
                                            'ends_at' => $schedule['ends_at'],
                                        ]));
                                    }
                                }
                            }
                        }
                        $i++;
                    }
                    $repeatInterval = $repeatInterval - $i;
                    if ($repeatInterval > 0) {
                        $recurring = [];
                        foreach (range(0, $repeatInterval) as $interval) {
                            if ($this->state['recurrence'] === 'monthly') {
                                $startDatetime->addMonth();
                                $endDatetime->addMonth();
                            } else {
                                $startDatetime->addYear();
                                $endDatetime->addYear();
                            }
                            $this->syncCalendar($startDatetime, $endDatetime, $startDate, $startTime, $endDate, $endTime);

                            $recurring[] = new Vacation([
                                'VacationName' => $this->state['vacation_name'],
                                'BackGrndColor' => ltrim($this->state['background_color'], '#'),
                                'FontColor' => ltrim($this->state['font_color'], '#'),
                                'recurrence' => $this->state['recurrence'] === 'none' ? null : $this->state['recurrence'],
                                'StartDateId' => $startDate->DateId,
                                'StartTimeId' => $startTime->timeid,
                                'EndDateId' => $endDate->DateId,
                                'EndTimeId' => $endTime->timeid,
                                'HouseId' => $this->user->is_admin ? ($this->house ?? $this->user->HouseId) : $this->user->HouseId,
                                'OwnerId' => $this->user->is_admin ? ($this->owner ?? $this->user->user_id) : $this->user->user_id,
                            ]);
                        }

                        $models = $this->vacation->recurrings()->saveMany($recurring);
                        if (
                            isset($this->state['book_rooms']) &&
                            $this->state['book_rooms'] == 1 &&
                            isset($this->state['vacation_rooms']) &&
                            is_array($this->state['vacation_rooms']) &&
                            count($this->state['vacation_rooms']) > 0
                        ) {
                            foreach ($this->state['rooms'] as $key => $schedules) {
                                foreach ($schedules as $schedule) {
                                    foreach ($models as $model) {
                                        $model->rooms()->save(new VacationRoom([
                                            'room_id' => $key,
                                            'starts_at' => $schedule['starts_at'],
                                            'ends_at' => $schedule['ends_at'],
                                        ]));
                                    }
                                }
                            }

                        }
                    }

                }
            }
        } else {
            if (!$this->isCreating) {
                $this->vacation->recurrings()->delete();
            }
        }

        if (isset($this->state['book_rooms']) && $this->state['book_rooms'] == 1){
            Session::put('setVacationId', $this->vacation->VacationId);
            Session::put('startDatetimeVacation', $startDatetime);
//            $this->dispatchBrowserEvent('vacationScheduled');
//            $this->emit('setVacationId', $this->vacation->VacationId);
        }


        Cookie::queue('vbc', $this->state['background_color'], 10000);
        Cookie::queue('vfc', $this->state['font_color'], 10000);
//        $this->emitSelf('toggle', false);
        if (!$this->isCreating) {
            return redirect()->route('dash.calendar');
        }
//        $this->emit('vacation-schedule-successfully');
    }


    public function render()
    {
        return view('dash.settings.vacations.schedule-vacation-form');
    }

    public function syncCalendar($startDatetime, $endDatetime, &$startDate, &$startTime, &$endDate, &$endTime)
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

        // End Datetime

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
    public function destroyedSuccessfully($data)
    {
        Vacation::where('parent_id', $data['VacationId'])->delete();
//        Vacation::where('parent_id', $data['VacationId'])->delete();

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
            return redirect()->route('dash.calendar')->with('successMessage', 'Your vacation has been deleted successfully.');
            $this->vacation = null;
        } catch (Exception $e) {

        }
    }

    public function deleteVacation()
    {
        if ($this->model) {
            $deletableModel = app($this->model)->findOrFail($this->vacation->parent_id ?: $this->vacation->VacationId);
            Session::put('startDatetimeForDeleteVacation', $deletableModel->start_datetime);
            $this->emit(
                'destroyable-confirmation-modal',
                $this->model,
                $this->vacation->parent_id ?: $this->vacation->VacationId,
                $this->destroyableConfirmationContent,
            );
        }
    }
    public function cancelVacation(){
        return redirect()->route('dash.calendar');
    }
}
