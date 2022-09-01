<?php

namespace App\Http\Livewire\Settings\Vacations;

use App\Models\Calendar;
use App\Models\Time;
use App\Models\User;
use App\Models\Vacation;
use App\Notifications\CalendarEmailNotification;
use App\Rules\VacationSchedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ScheduleVacationForm extends Component
{
    public $user;

    public $state = [];
    public ?Vacation $vacation;

    protected $listeners = [
        'showVacationScheduleModal'
    ];

    public function showVacationScheduleModal($toggle, $vacation = null, $initialDate = null)
    {
        $this->emitSelf('toggle', $toggle);
        $this->vacation = Vacation::firstOrNew(['VacationID' => $vacation]);
        $this->reset('state');

        if ($this->vacation->VacationName) {
            $this->state = [
                'vacation_name' => $this->vacation->VacationName,
                'start_datetime' => $this->vacation->start_datetime->format('m/d/Y h:i'),
                'end_datetime' => $this->vacation->end_datetime->format('m/d/Y h:i'),
                'background_color' => $this->vacation->BackGrndColor,
                'font_color' => $this->vacation->FontColor,
            ];
        } else {
            $this->state = [
                'background_color' => '#000000',
                'font_color' => '#000000',
            ];

            if ($initialDate) {
                try {
                    $initialDatetime = Carbon::parse($initialDate);
                    $this->state['start_datetime'] = $initialDatetime->format('m/d/Y h:i');
                    $this->state['end_datetime'] = $initialDatetime->format('m/d/Y h:i');
                } catch (\Exception $e) {

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
        ])->validateWithBag('saveVacationSchedule');

        $startDatetime = Carbon::parse($this->state['start_datetime']);

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


        $endDatetime = Carbon::parse($this->state['end_datetime']);

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

        $this->vacation->fill([
            'VacationName' => $this->state['vacation_name'],
            'BackGrndColor' => ltrim($this->state['background_color'], '#'),
            'FontColor' => ltrim($this->state['font_color'], '#'),
            'StartDateId' => $startDate->DateId,
            'StartTimeId' => $startTime->timeid,
            'EndDateId' => $endDate->DateId,
            'EndTimeId' => $endTime->timeid,
            'HouseId' => $this->user->HouseId
        ])->save();

        $items =$this->vacation;

        if (!is_null($this->user->house->CalEmailList)){

            $CalEmailList = explode(',',$this->user->house->CalEmailList);

            if (count($CalEmailList) > 0) {

                $users = User::whereIn('email', $CalEmailList)->where('HouseId', $this->user->HouseId)->get();

                Notification::send($users, new CalendarEmailNotification($items));

                $CalEmailList = array_diff($CalEmailList, $users->pluck('email')->toArray());

                if (count($CalEmailList) > 0) {

                    Notification::route('mail', $CalEmailList)
                        ->notify(new CalendarEmailNotification($items));

                }
            }

        }

        $this->emitSelf('toggle', false);
        $this->emit('vacation-schedule-successfully');
    }


    public function render()
    {
        return view('dash.settings.vacations.schedule-vacation-form');
    }
}
