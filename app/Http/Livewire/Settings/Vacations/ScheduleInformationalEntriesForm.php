<?php

namespace App\Http\Livewire\Settings\Vacations;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\Calendar;
use App\Models\Time;
use App\Models\Vacation;
use Carbon\Carbon;
use Livewire\Component;
use function Symfony\Component\Translation\t;

class ScheduleInformationalEntriesForm extends Component
{
    use Destroyable;
    public $user;

    public $state = [];
    public ?Vacation $vacation;

    public $isCreating = false;
    protected $destroyableConfirmationContent = [
        'title' => '',
        'description' => ''
    ];
    protected $listeners = [
        'vacation-deleted-successfully' => 'destroyedSuccessfully'
    ];

    public function mount($vacationId = null)
    {
        $this->vacation = Vacation::firstOrNew(['VacationID' => $vacationId]);
//        $this->reset('state');
        $this->state = [
            'recurrence' => 'once',
            'task_title' => null,
        ];
        $this->isCreating = true;
    }

    public function render()
    {
        return view('dash.settings.vacations.schedule-informational-entries-form');
    }

    public function updateRecurrence($value){
        $this->state = [
            'recurrence' => $value,
            'task_title' => $this->state['task_title'],
            'task_start_date' => $this->state['task_start_date'],
            'task_end_date' => $this->state['task_end_date'],
        ];
        $this->emit('enableUpdateRecurrence', $value);
    }

    public function scheduleCalendarTask() {

        $taskStartDate = Carbon::parse($this->state['task_start_date']);
        $taskEndDate = Carbon::parse($this->state['task_end_date']);
        $endRepeatDate = isset($this->state['end_repeat_date']) ? Carbon::parse($this->state['end_repeat_date']) : null;

        $this->syncCalendar($taskStartDate, $taskEndDate,$endRepeatDate, $startDate, $endDate,$repeatDate);


        if ($this->isCreating) {
            $this->vacation->HouseId = $this->user->HouseId;
            $this->vacation->OwnerId = $this->user->user_id;
        }

        $this->vacation->BackGrndColor = '#cccc';
        $this->vacation->FontColor = '#ffff';

        $this->vacation->fill([
            'VacationName' => $this->state['task_title'],
            'recurrence' => $this->state['recurrence'] === 'none' ? null : $this->state['recurrence'],
            'StartDateId' => $startDate->DateId,
            'EndDateId' => $endDate->DateId,
            'is_calendar_task' => 1,
            'EndRepeatDateId' => $repeatDate->DateId ?? 0,
        ])->save();
    }



    public function syncCalendar($startDatetime, $endDatetime,$endRepeatDate, &$startDate, &$endDate, &$repeatDate)
    {
        // Start Datetime
        $startDay = $startDatetime->day;
        $startMonth = $startDatetime->month;
        $startYear = $startDatetime->year;
        $stDate = $startDatetime->format('Y-m-d');

        $startDate = Calendar::firstOrNew([
            'Day' => $startDay,
            'Month' => $startMonth,
            'Year' => $startYear,
            'RealDate' => $stDate,
        ]);


        if (!$startDate->exists) $startDate->save();

        // End Datetime
        $endDay = $endDatetime->day;
        $endMonth = $endDatetime->month;
        $endYear = $endDatetime->year;
        $enDate = $endDatetime->format('Y-m-d');

        $endDate = Calendar::firstOrNew([
            'Day' => $endDay,
            'Month' => $endMonth,
            'Year' => $endYear,
            'RealDate' => $enDate,
        ]);


        if (!$endDate->exists) $endDate->save();


        //End Repeat Date
        if ($endRepeatDate){
            $repeatDay = $endRepeatDate->day;
            $repeatMonth = $endRepeatDate->month;
            $repeatYear = $endRepeatDate->year;
            $reDate = $endRepeatDate->format('Y-m-d');

            $repeatDate = Calendar::firstOrNew([
                'Day' => $repeatDay,
                'Month' => $repeatMonth,
                'Year' => $repeatYear,
                'RealDate' => $reDate,
            ]);


            if (!$repeatDate->exists) $repeatDate->save();
        }

    }


}
