<?php

namespace App\Http\Livewire\Settings\Vacations;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\Calendar;
use App\Models\Time;
use App\Models\Vacation;
use App\Rules\VacationSchedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
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
        $this->model = Vacation::class;
        $this->vacation = Vacation::firstOrNew(['VacationID' => $vacationId]);
        $this->reset('state');

        if ($this->vacation->VacationName && $this->vacation->parent_id !== null) {
            $this->vacation = Vacation::firstOrNew(['VacationID' => $this->vacation->parent_id]);
        }
        if ($this->vacation->VacationName) {
            $this->isCreating = false;
            $this->state = [
                'task_title' => $this->vacation->VacationName,
                'start_datetime' => $this->vacation->start_datetime->format('m/d/Y H:i'),
                'end_datetime' => $this->vacation->end_datetime->format('m/d/Y H:i'),
                'start_end_datetime' => $this->vacation->start_datetime->format('m/d/Y H:i') . ' - ' . $this->vacation->end_datetime->format('m/d/Y H:i'),
                'background_color' => $this->vacation->BackGrndColor,
                'font_color' => $this->vacation->FontColor,
                'recurrence' => $this->vacation->recurrence ?? 'once',
                'repeat_interval' => $this->vacation->repeat_interval ?? 0,
            ];
        }
        else{
            $this->isCreating = true;
            $this->state = [
                'recurrence' => 'once',
                'repeat_interval' => 0,
                'task_title' => null,
                'start_datetime' => null,
                'end_datetime' => null,
                'start_end_datetime' => null,
            ];
        }

    }

    public function render()
    {
        return view('dash.settings.vacations.schedule-informational-entries-form');
    }

    public function updateRecurrence($value){
        $this->state = [
            'recurrence' => $value,
            'task_title' => $this->state['task_title'],
            'start_datetime' => $this->state['start_datetime'],
            'end_datetime' => $this->state['end_datetime'],
            'repeat_interval' => $this->state['repeat_interval'] ?? 0,
            'start_end_datetime' => $this->vacation->start_datetime->format('m/d/Y H:i') . ' - ' . $this->vacation->end_datetime->format('m/d/Y H:i'),
        ];
//        $this->emit('enableUpdateRecurrence', $value);
    }

    public function scheduleCalendarTask() {

        $this->resetErrorBag();

        Validator::make($this->state, [
            'task_title' => ['required', 'string', 'max:100'],
            'start_datetime' => ['required'],
            'recurrence' => ['required', 'in:once,weekly,yearly'],
            'repeat_interval' => ($this->state['recurrence'] ?? 'once') !== 'once' ? ['required', 'numeric', 'min:1', 'max:30'] : ['nullable'],
        ],[
            'start_datetime.required' => 'The start & end datetime field is required'
        ])->validateWithBag('scheduleCalendarTask');


        $taskStartDateTime = Carbon::parse($this->state['start_datetime']);
        $taskEndDateTime = Carbon::parse($this->state['end_datetime']);

        $this->syncCalendar($taskStartDateTime, $taskEndDateTime, $startDate, $startTime, $endDate, $endTime);


        if ($this->isCreating) {
            $this->vacation->HouseId = $this->user->HouseId;
            $this->vacation->OwnerId = $this->user->user_id;
        }
        $this->vacation->BackGrndColor = '#038cfc';
        $this->vacation->FontColor = '#ffff';

        $this->vacation->fill([
            'VacationName' => $this->state['task_title'],
            'recurrence' => $this->state['recurrence'] === 'none' ? null : $this->state['recurrence'],
            'StartDateId' => $startDate->DateId,
            'StartTimeId' => $startTime->timeid,
            'EndDateId' => $endDate->DateId,
            'EndTimeId' => $endTime->timeid,
            'repeat_interval' => $this->state['repeat_interval'] ?? 0,
            'is_calendar_task' => 1,
        ])->save();


        if ($this->state['recurrence'] !== 'once') {
            if ($this->isCreating) {
                $recurring = [];
                foreach (range(1, intval($this->state['repeat_interval'] ?? 0)) as $interval) {
                    if ($this->state['recurrence'] === 'weekly') {
                        $taskStartDateTime->addWeek();
                        $taskEndDateTime->addWeek();
                    } else {
                        $taskStartDateTime->addYear();
                        $taskEndDateTime->addYear();
                    }
                    $this->syncCalendar($taskStartDateTime, $taskEndDateTime, $startDate, $startTime, $endDate, $endTime);

                    $recurring[] = new Vacation([
                        'VacationName' => $this->state['task_title'],
                        'BackGrndColor' => '#038cfc',
                        'FontColor' => '#ffff',
                        'recurrence' => $this->state['recurrence'] === 'none' ? null : $this->state['recurrence'],
                        'StartDateId' => $startDate->DateId,
                        'StartTimeId' => $startTime->timeid,
                        'EndDateId' => $endDate->DateId,
                        'EndTimeId' => $endTime->timeid,
                        'HouseId' => $this->user->HouseId,
                        'OwnerId' => $this->user->user_id,
                        'is_calendar_task' => 1,
                    ]);
                }
                $models = $this->vacation->recurrings()->saveMany($recurring);

            } else {
                $repeatInterval = intval($this->state['repeat_interval'] ?? 0);

                $recurringVacations = $this->vacation->recurrings;

                if (count($recurringVacations) >= $repeatInterval) {
                    $i = 0;
                    foreach ($recurringVacations as $recurringVacation) {
                        if ($i < $repeatInterval) {
                            if ($this->state['recurrence'] === 'weekly') {
                                $taskStartDateTime->addWeek();
                                $taskEndDateTime->addWeek();
                            } else {
                                $taskStartDateTime->addYear();
                                $taskEndDateTime->addYear();
                            }
                            $this->syncCalendar($taskStartDateTime, $taskEndDateTime, $startDate, $startTime, $endDate, $endTime);

                            $recurringVacation->update([
                                'VacationName' => $this->state['task_title'],
                                'BackGrndColor' => '#038cfc',
                                'FontColor' => '#ffff',
                                'recurrence' => $this->state['recurrence'] === 'none' ? null : $this->state['recurrence'],
                                'StartDateId' => $startDate->DateId,
                                'StartTimeId' => $startTime->timeid,
                                'EndDateId' => $endDate->DateId,
                                'EndTimeId' => $endTime->timeid,
                                'is_calendar_task' => 1,
                            ]);
                        } else {
                            $recurringVacation->delete();
                        }

                        $i++;
                    }
                } elseif (count($recurringVacations) < $repeatInterval) {
                    $i = 0;
                    foreach ($recurringVacations as $recurringVacation) {
                        if ($i < $repeatInterval) {
                            if ($this->state['recurrence'] === 'weekly') {
                                $taskStartDateTime->addWeek();
                                $taskEndDateTime->addWeek();
                            } else {
                                $taskStartDateTime->addYear();
                                $taskEndDateTime->addYear();
                            }
                            $this->syncCalendar($taskStartDateTime, $taskEndDateTime, $startDate, $startTime, $endDate, $endTime);

                            $recurringVacation->update([
                                'VacationName' => $this->state['task_title'],
                                'BackGrndColor' => '#038cfc',
                                'FontColor' => '#ffff',
                                'recurrence' => $this->state['recurrence'] === 'none' ? null : $this->state['recurrence'],
                                'StartDateId' => $startDate->DateId,
                                'StartTimeId' => $startTime->timeid,
                                'EndDateId' => $endDate->DateId,
                                'EndTimeId' => $endTime->timeid,
                                'is_calendar_task' => 1,
                            ]);
                        }
                        $i++;
                    }
                    $repeatInterval = $repeatInterval - $i;
                    if ($repeatInterval > 0) {
                        $recurring = [];
                        foreach (range(0, $repeatInterval) as $interval) {
                            if ($this->state['recurrence'] === 'weekly') {
                                $taskStartDateTime->addWeek();
                                $taskEndDateTime->addWeek();
                            } else {
                                $taskStartDateTime->addYear();
                                $taskEndDateTime->addYear();
                            }
                            $this->syncCalendar($taskStartDateTime, $taskEndDateTime, $startDate, $startTime, $endDate, $endTime);

                            $recurring[] = new Vacation([
                                'VacationName' => $this->state['task_title'],
                                'BackGrndColor' => '#038cfc',
                                'FontColor' => '#ffff',
                                'recurrence' => $this->state['recurrence'] === 'none' ? null : $this->state['recurrence'],
                                'StartDateId' => $startDate->DateId,
                                'StartTimeId' => $startTime->timeid,
                                'EndDateId' => $endDate->DateId,
                                'EndTimeId' => $endTime->timeid,
                                'HouseId' => $this->user->HouseId,
                                'OwnerId' => $this->user->user_id,
                                'is_calendar_task' => 1,
                            ]);
                        }
                    }

                }
            }
        } else {
            if (!$this->isCreating) {
                $this->vacation->recurrings()->delete();
            }
        }

        if ($this->isCreating) {
            return redirect()->route('dash.calendar')->with('successMessage', 'Your task has been scheduled successfully.');
        } else {
            return redirect()->route('dash.calendar')->with('successMessage', 'Your task has been updated successfully.');
        }

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


    public function deleteCalendarTask()
    {
        if ($this->model) {
            $deletableModel = app($this->model)->findOrFail($this->vacation->parent_id ?: $this->vacation->VacationId);
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
