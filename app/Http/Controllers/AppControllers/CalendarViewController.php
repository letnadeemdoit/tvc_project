<?php

namespace App\Http\Controllers\AppControllers;

use App\Models\Calendar;
use App\Models\House;
use App\Models\Room\Room;
use App\Models\Time;
use App\Models\User;
use App\Models\Vacation;
use App\Models\VacationRoom;
use App\Rules\VacationSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CalendarViewController extends BaseController
{

    public $user;
    public $house;
    public $owner;
    public $properties;
    public $selectedHouses = [];

    public ?Vacation $vacation;

    /**
     * Get Vacations api
     *
     * @return \Illuminate\Http\Response
     */
    public function getVacations(Request $request)
    {
        try {
            $user = Auth::user();
            $inputs = $request->all();
            if (!$user->is_guest) {
                $this->properties = $inputs['properties'] ?? [];
                $this->owner = $inputs['owner'] ?? null;

                if (is_string($this->properties)) {
                    $decodedProperties = json_decode($this->properties, true);
                    $this->properties = is_array($decodedProperties) ? $decodedProperties : [];
                }

                $this->selectedHouses = is_array($this->properties) ? $this->properties : [];
                $houses = $this->getHousesProperty();

                $whereHouses = !empty($this->selectedHouses) ? $this->selectedHouses : $houses->pluck('HouseID')->toArray();

                $vacations = Vacation::whereIn('HouseId', $whereHouses)
                    ->when($user->user_id !== $this->owner && $this->owner !== null, function ($query) {
                        $query->where('OwnerId', $this->owner);
                    })
                    ->orderBy('VacationId', 'ASC')
                    ->get();
            } else {
                $vacations = Vacation::where('HouseId', $user->HouseId)->orderBy('VacationId', 'ASC')->get();
            }

            $events = [];
            foreach ($vacations as $vacation) {
                $events[] = $vacation->toAppCalendar();
                foreach ($vacation->rooms as $room) {
                    $events[] = $room->toCalendar();
                }
            }

            $response = [
                'success' => true,
                'data' => [
                    'events' =>  $events,
                ],
                'message' => 'Data fetched successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }

    /**
     * Get Houses Property Function
     *
     * @return \Illuminate\Http\Response
     */
    public function getHousesProperty()
    {
        $user = Auth::user();
        if ($user->role === 'Owner') {
            return House::whereHas('users', function ($query) use ($user) {
                $query->where([
                    'role' => User::ROLE_OWNER,
                ])->where([
                    ['email', $user->email],
                    ['HouseId', '<>', 0],
                    'parent_id' => $user->parent_id
                ]);
            })
                ->select('HouseID', 'parent_id', 'HouseName')
                ->get();
        } elseif ($user->role === 'Administrator') {
            return House::whereHas('users', function ($query) use ($user) {
                $query->where([
                    'role' => User::ROLE_ADMINISTRATOR,
                ])->where(function ($query) use ($user) {
                    $query->where('email', $user->email)
                        ->when($user->primary_account, function ($query) use ($user) {
                            $query->orWhere('parent_id', $user->user_id);
                        })
                        ->when(!$user->primary_account, function ($query) use ($user) {
                            $query->orWhere(function ($query) use ($user) {
                                $query->where('parent_id', $user->user_id)
                                    ->orWhere('user_id', $user->user_id);
                            });
                        });
                });
            })
                ->select('HouseID', 'parent_id', 'HouseName')
                ->get();
        }

    }


    /**
     * Get House Properties api
     *
     * @return \Illuminate\Http\Response
     */
    public function houseRelevantProperties(Request $request)
    {
        try {
            $user = Auth::user();
            $houses = null;
            if ($user->role === 'Owner') {
                $houses = House::whereHas('users', function ($query) use ($user) {
                    $query->where([
                        'role' => User::ROLE_OWNER,
                    ])->where([
                        ['email', $user->email],
                        ['HouseId', '<>', 0],
                        'parent_id' => $user->parent_id
                    ]);
                })
                    ->select('HouseID', 'parent_id', 'HouseName')
                    ->get();
            } elseif ($user->role === 'Administrator') {
                $houses = House::whereHas('users', function ($query) use ($user) {
                    $query->where([
                        'role' => User::ROLE_ADMINISTRATOR,
                    ])->where(function ($query) use ($user) {
                        $query->where('email', $user->email)
                            ->when($user->primary_account, function ($query) use ($user) {
                                $query->orWhere('parent_id', $user->user_id);
                            })
                            ->when(!$user->primary_account, function ($query) use ($user) {
                                $query->orWhere(function ($query) use ($user) {
                                    $query->where('parent_id', $user->user_id)
                                        ->orWhere('user_id', $user->user_id);
                                });
                            });
                    });
                })
                    ->select('HouseID', 'parent_id', 'HouseName')
                    ->get();
            }

            $users = User::where('HouseId', $user->HouseId)
                ->where('role', '<>', User::ROLE_GUEST)
                ->where('user_id', '<>', $user->user_id)
                ->select('user_id', 'first_name', 'last_name','role')
                ->get();


            $response = [
                'success' => true,
                'data' => [
                    'houses' => $houses,
                    'users' => $users,
                ],
                'message' => 'Data fetched successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }


    /**
     * Get Rooms api
     *
     * @return \Illuminate\Http\Response
     */
    public function getRooms(Request $request)
    {
        try {
            $user = Auth::user();
            $rooms = Room::where('HouseID', $user->HouseId)
                ->select('RoomID', 'RoomName')
                ->get();

            $response = [
                'success' => true,
                'data' => [
                    'rooms' => $rooms,
                ],
                'message' => 'Data fetched successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }


    /**
     * Save Vacation api
     *
     * @return \Illuminate\Http\Response
     */
    public function saveVacations(Request $request)
    {
        try {
            $user = Auth::user();
            $inputs = $request->all();
            $isCreating = empty($inputs['VacationId']);
            $this->vacation = $isCreating ? new Vacation() : Vacation::find($inputs['VacationId']);
            $validator = Validator::make($inputs, [
                'vacation_name' => ['required', 'string', 'max:100'],
                'start_datetime' => ['required', new VacationSchedule($inputs['end_datetime'] ?? null, $user, $this->vacation)],
                'background_color' => ['required'],
                'font_color' => ['required'],
                'recurrence' => ['required', 'in:once,monthly,yearly'],
                'repeat_interval' => ($inputs['recurrence'] ?? 'once') !== 'once' ? ['required', 'numeric', 'min:1', 'max:30'] : ['nullable'],
            ], [
                'start_datetime.required' => 'The start & end datetime field is required'
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation error', $validator->errors(), 422);
            }

            $startDatetime = Carbon::parse($inputs['start_datetime']);
            $endDatetime = Carbon::parse($inputs['end_datetime']);

            $this->syncCalendar($startDatetime, $endDatetime, $startDate, $startTime, $endDate, $endTime);

            if ($isCreating) {
                $this->vacation->HouseId = $user->HouseId;
                $this->vacation->OwnerId = $user->user_id;
            }

            $this->vacation->BackGrndColor = $inputs['background_color'];
            $this->vacation->FontColor = $inputs['font_color'];

            $this->vacation->fill([
                'VacationName' => $inputs['vacation_name'],
                'recurrence' => $inputs['recurrence'] === 'none' ? null : $inputs['recurrence'],
                'StartDateId' => $startDate->DateId,
                'StartTimeId' => $startTime->timeid,
                'EndDateId' => $endDate->DateId,
                'EndTimeId' => $endTime->timeid,
                'repeat_interval' => $inputs['repeat_interval'] ?? 0,
                'book_rooms' => $inputs['book_rooms'] ?? 0,
                'is_vac_approved' => 0,
//                'is_vac_approved' => $isCreating ? ($user->is_owner_only && $this->isOwnerVacApproval ? 1: 0) : $this->vacation->is_vac_approved,
            ])->save();



            if (
                isset($inputs['book_rooms']) &&
                $inputs['book_rooms'] == 1 &&
                isset($inputs['vacation_rooms']) &&
                is_array($inputs['vacation_rooms']) &&
                count($inputs['vacation_rooms']) > 0
            ) {
                $this->vacation->rooms()->delete();

                foreach ($inputs['vacation_rooms'] as $key => $schedules) {
                    foreach ($schedules as $schedule) {
                        $this->vacation->rooms()->save(new VacationRoom([
                            'room_id' => $key,
                            'starts_at' => $schedule['starts_at'],
                            'ends_at' => $schedule['ends_at'],
                            'occupant_name' => $schedule['occupant_name'],
                        ]));
                    }
                }

            }

            if ($inputs['recurrence'] !== 'once') {
                if ($isCreating) {
                    $recurring = [];
                    foreach (range(1, intval($inputs['repeat_interval'] ?? 0)) as $interval) {
                        if ($inputs['recurrence'] === 'monthly') {
                            $startDatetime->addMonth();
                            $endDatetime->addMonth();
                        } else {
                            $startDatetime->addYear();
                            $endDatetime->addYear();
                        }
                        $this->syncCalendar($startDatetime, $endDatetime, $startDate, $startTime, $endDate, $endTime);

                        $recurring[] = new Vacation([
                            'VacationName' => $inputs['vacation_name'],
                            'BackGrndColor' => ltrim($inputs['background_color'], '#'),
                            'FontColor' => ltrim($inputs['font_color'], '#'),
                            'recurrence' => $inputs['recurrence'] === 'none' ? null : $inputs['recurrence'],
                            'StartDateId' => $startDate->DateId,
                            'StartTimeId' => $startTime->timeid,
                            'EndDateId' => $endDate->DateId,
                            'EndTimeId' => $endTime->timeid,
                            'HouseId' => $user->HouseId,
                            'OwnerId' => $user->user_id,
                            'is_vac_approved' => 0,
                        ]);
                    }

                    $models = $this->vacation->recurrings()->saveMany($recurring);
                    if (
                        isset($inputs['book_rooms']) &&
                        $inputs['book_rooms'] == 1 &&
                        isset($inputs['vacation_rooms']) &&
                        is_array($inputs['vacation_rooms']) &&
                        count($inputs['vacation_rooms']) > 0
                    ) {
                        foreach ($inputs['vacation_rooms'] as $key => $schedules) {
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

                    $repeatInterval = intval($inputs['repeat_interval'] ?? 0);

                    $recurringVacations = $this->vacation->recurrings;

                    if (count($recurringVacations) >= $repeatInterval) {
                        $i = 0;
                        foreach ($recurringVacations as $recurringVacation) {
                            if ($i < $repeatInterval) {
                                if ($inputs['recurrence'] === 'monthly') {
                                    $startDatetime->addMonth();
                                    $endDatetime->addMonth();
                                } else {
                                    $startDatetime->addYear();
                                    $endDatetime->addYear();
                                }
                                $this->syncCalendar($startDatetime, $endDatetime, $startDate, $startTime, $endDate, $endTime);

                                $recurringVacation->update([
                                    'VacationName' => $inputs['vacation_name'],
                                    'BackGrndColor' => ltrim($inputs['background_color'], '#'),
                                    'FontColor' => ltrim($inputs['font_color'], '#'),
                                    'recurrence' => $inputs['recurrence'] === 'none' ? null : $inputs['recurrence'],
                                    'StartDateId' => $startDate->DateId,
                                    'StartTimeId' => $startTime->timeid,
                                    'EndDateId' => $endDate->DateId,
                                    'EndTimeId' => $endTime->timeid,
                                    'is_vac_approved' => $this->vacation->is_vac_approved,

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
                                if ($inputs['recurrence'] === 'monthly') {
                                    $startDatetime->addMonth();
                                    $endDatetime->addMonth();
                                } else {
                                    $startDatetime->addYear();
                                    $endDatetime->addYear();
                                }
                                $this->syncCalendar($startDatetime, $endDatetime, $startDate, $startTime, $endDate, $endTime);

                                $recurringVacation->update([
                                    'VacationName' => $inputs['vacation_name'],
                                    'BackGrndColor' => ltrim($inputs['background_color'], '#'),
                                    'FontColor' => ltrim($inputs['font_color'], '#'),
                                    'recurrence' => $inputs['recurrence'] === 'none' ? null : $inputs['recurrence'],
                                    'StartDateId' => $startDate->DateId,
                                    'StartTimeId' => $startTime->timeid,
                                    'EndDateId' => $endDate->DateId,
                                    'EndTimeId' => $endTime->timeid,
                                    'is_vac_approved' => $this->vacation->is_vac_approved,
                                ]);

                                if (
                                    isset($inputs['book_rooms']) &&
                                    $inputs['book_rooms'] == 1 &&
                                    isset($inputs['vacation_rooms']) &&
                                    is_array($inputs['vacation_rooms']) &&
                                    count($inputs['vacation_rooms']) > 0
                                ) {
                                    $recurringVacation->rooms()->delete();
                                    foreach ($inputs['vacation_rooms'] as $key => $schedules) {
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
                                if ($inputs['recurrence'] === 'monthly') {
                                    $startDatetime->addMonth();
                                    $endDatetime->addMonth();
                                } else {
                                    $startDatetime->addYear();
                                    $endDatetime->addYear();
                                }
                                $this->syncCalendar($startDatetime, $endDatetime, $startDate, $startTime, $endDate, $endTime);

                                $recurring[] = new Vacation([
                                    'VacationName' => $inputs['vacation_name'],
                                    'BackGrndColor' => ltrim($inputs['background_color'], '#'),
                                    'FontColor' => ltrim($inputs['font_color'], '#'),
                                    'recurrence' => $inputs['recurrence'] === 'none' ? null : $inputs['recurrence'],
                                    'StartDateId' => $startDate->DateId,
                                    'StartTimeId' => $startTime->timeid,
                                    'EndDateId' => $endDate->DateId,
                                    'EndTimeId' => $endTime->timeid,
                                    'HouseId' => $user->HouseId,
                                    'OwnerId' => $user->user_id,
                                    'is_vac_approved' => $this->vacation->is_vac_approved,
                                ]);
                            }

                            $models = $this->vacation->recurrings()->saveMany($recurring);
                            if (
                                isset($inputs['book_rooms']) &&
                                $inputs['book_rooms'] == 1 &&
                                isset($inputs['vacation_rooms']) &&
                                is_array($inputs['vacation_rooms']) &&
                                count($inputs['vacation_rooms']) > 0
                            ) {
                                foreach ($inputs['rooms'] as $key => $schedules) {
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
                if (!$isCreating) {
                    $this->vacation->recurrings()->delete();
                }
            }

            $response = [
                'success' => true,
                'data' => [
                    'vacation' => $this->vacation->toAppCalendar(),
                ],
                'message' => $isCreating ? 'Vacation created successfully' : 'Vacation Updated successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            Log::error('Error:', [
                'message' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
                'inputs' => $request->all(),
            ]);
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


    /**
     * Delete Event api
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteCalendarEvent(Request $request)
    {
        try {
            // Validate request
            $validator = Validator::make($request->all(), [
                'VacationId' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first(),
                ], 400);
            }

            $tasksExist = Vacation::where('VacationId', $request->VacationId)
                ->orWhere('parent_id', $request->VacationId)
                ->exists();

            if (!$tasksExist) {
                return response()->json([
                    'success' => false,
                    'message' => 'Event not found.',
                ], 404);
            }

            Vacation::where('VacationId', $request->VacationId)
                ->orWhere('parent_id', $request->VacationId)
                ->delete();

            return response()->json([
                'success' => true,
                'message' => 'Vacation(s) deleted successfully.',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }









}
