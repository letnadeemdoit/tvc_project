<?php

namespace App\Http\Controllers\AppControllers;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\Time;
use App\Models\Vacation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CalendarTaskController extends BaseController
{

    public $user;

    public ?Vacation $vacation;


    /**
     * Create Task api
     *
     * @return \Illuminate\Http\Response
     */
    public function createTask(Request $request)
    {
        try {
            $user = Auth::user();
            $inputs = $request->all();
            $isCreating = empty($inputs['VacationId']);
            $this->vacation = $isCreating ? new Vacation() : Vacation::find($inputs['VacationId']);
            $validator = Validator::make($inputs, [
                'task_title' => ['required', 'string', 'max:100'],
                'start_datetime' => ['required'],
                'recurrence' => ['required', 'in:once,weekly,yearly'],
                'repeat_interval' => ($inputs['recurrence'] ?? 'once') !== 'once' ? ['required', 'numeric', 'min:1', 'max:30'] : ['nullable'],
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation error', $validator->errors(), 422);
            }

            $taskStartDateTime = Carbon::parse($inputs['start_datetime']);
            $taskEndDateTime = Carbon::parse($inputs['end_datetime']);

            $startDatetime = Carbon::parse($inputs['start_datetime']);
            $endDatetime = Carbon::parse($inputs['end_datetime']);

            $this->syncCalendar($startDatetime, $endDatetime, $startDate, $startTime, $endDate, $endTime);

            if ($isCreating) {
                $this->vacation->HouseId = $user->HouseId;
                $this->vacation->OwnerId = $user->user_id;
            }

            $this->vacation->BackGrndColor = '#038cfc';
            $this->vacation->FontColor = '#ffff';

            $this->vacation->fill([
                'VacationName' => $inputs['task_title'],
                'recurrence' => $inputs['recurrence'] === 'none' ? null : $inputs['recurrence'],
                'StartDateId' => $startDate->DateId,
                'StartTimeId' => $startTime->timeid,
                'EndDateId' => $endDate->DateId,
                'EndTimeId' => $endTime->timeid,
                'repeat_interval' => $inputs['repeat_interval'] ?? 0,
                'is_calendar_task' => 1,
            ])->save();


            if ($inputs['recurrence'] !== 'once') {
                if ($isCreating) {
                    $recurring = [];
                    foreach (range(1, intval($inputs['repeat_interval'] ?? 0)) as $interval) {
                        if ($inputs['recurrence'] === 'weekly') {
                            $taskStartDateTime->addWeek();
                            $taskEndDateTime->addWeek();
                        } else {
                            $taskStartDateTime->addYear();
                            $taskEndDateTime->addYear();
                        }
                        $this->syncCalendar($taskStartDateTime, $taskEndDateTime, $startDate, $startTime, $endDate, $endTime);

                        $recurring[] = new Vacation([
                            'VacationName' => $inputs['task_title'],
                            'BackGrndColor' => '#038cfc',
                            'FontColor' => '#ffff',
                            'recurrence' => $inputs['recurrence'] === 'none' ? null : $inputs['recurrence'],
                            'StartDateId' => $startDate->DateId,
                            'StartTimeId' => $startTime->timeid,
                            'EndDateId' => $endDate->DateId,
                            'EndTimeId' => $endTime->timeid,
                            'HouseId' => $user->HouseId,
                            'OwnerId' => $user->user_id,
                            'is_calendar_task' => 1,
                        ]);
                    }
                    $models = $this->vacation->recurrings()->saveMany($recurring);

                } else {
                    $repeatInterval = intval($inputs['repeat_interval'] ?? 0);

                    $recurringVacations = $this->vacation->recurrings;

                    if (count($recurringVacations) >= $repeatInterval) {
                        $i = 0;
                        foreach ($recurringVacations as $recurringVacation) {
                            if ($i < $repeatInterval) {
                                if ($inputs['recurrence'] === 'weekly') {
                                    $taskStartDateTime->addWeek();
                                    $taskEndDateTime->addWeek();
                                } else {
                                    $taskStartDateTime->addYear();
                                    $taskEndDateTime->addYear();
                                }
                                $this->syncCalendar($taskStartDateTime, $taskEndDateTime, $startDate, $startTime, $endDate, $endTime);

                                $recurringVacation->update([
                                    'VacationName' => $inputs['task_title'],
                                    'BackGrndColor' => '#038cfc',
                                    'FontColor' => '#ffff',
                                    'recurrence' => $inputs['recurrence'] === 'none' ? null : $inputs['recurrence'],
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
                                if ($inputs['recurrence'] === 'weekly') {
                                    $taskStartDateTime->addWeek();
                                    $taskEndDateTime->addWeek();
                                } else {
                                    $taskStartDateTime->addYear();
                                    $taskEndDateTime->addYear();
                                }
                                $this->syncCalendar($taskStartDateTime, $taskEndDateTime, $startDate, $startTime, $endDate, $endTime);

                                $recurringVacation->update([
                                    'VacationName' => $inputs['task_title'],
                                    'BackGrndColor' => '#038cfc',
                                    'FontColor' => '#ffff',
                                    'recurrence' => $inputs['recurrence'] === 'none' ? null : $inputs['recurrence'],
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
                                if ($inputs['recurrence'] === 'weekly') {
                                    $taskStartDateTime->addWeek();
                                    $taskEndDateTime->addWeek();
                                } else {
                                    $taskStartDateTime->addYear();
                                    $taskEndDateTime->addYear();
                                }
                                $this->syncCalendar($taskStartDateTime, $taskEndDateTime, $startDate, $startTime, $endDate, $endTime);

                                $recurring[] = new Vacation([
                                    'VacationName' => $inputs['task_title'],
                                    'BackGrndColor' => '#038cfc',
                                    'FontColor' => '#ffff',
                                    'recurrence' => $inputs['recurrence'] === 'none' ? null : $inputs['recurrence'],
                                    'StartDateId' => $startDate->DateId,
                                    'StartTimeId' => $startTime->timeid,
                                    'EndDateId' => $endDate->DateId,
                                    'EndTimeId' => $endTime->timeid,
                                    'HouseId' => $user->HouseId,
                                    'OwnerId' => $user->user_id,
                                    'is_calendar_task' => 1,
                                ]);
                            }
                        }

                    }
                }
            } else {
                if (!$isCreating) {
                    $this->vacation->recurrings()->delete();
                }
            }


            $response = [
                'success' => true,
                'data' => [
                    'vacation' => $this->vacation,
                ],
                'message' => $isCreating ? 'Task created successfully' : 'Task Updated successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }



    /**
     * Delete Calendar Tasks api
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteTask(Request $request)
    {
        try {
            $tasks = Vacation::where('VacationId', $request->VacationId)
                ->orWhere('parent_id', $request->VacationId)
                ->get();
            if (isset($tasks) && count($tasks) > 0) {
                foreach ($tasks as $event) {
                    $event->delete();
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Task deleted successfully.',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Task not found.',
                ], 404);
            }

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
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

}
