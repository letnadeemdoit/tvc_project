<?php

namespace App\Http\Controllers\AppControllers;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\Room\Room;
use App\Models\Time;
use App\Models\User;
use App\Models\Vacation;
use App\Models\VacationRoom;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VacationRoomsController extends BaseController
{

    public $user;

    public ?Vacation $vacation;
    public $vacationRoom;
    public $room;


    /**
     * Get Rooms List api
     *
     * @return \Illuminate\Http\Response
     */
    public function getRoomsList(Request $request)
    {
        try {
            $user = Auth::user();

            $guestUser = User::where('HouseId', current_house()->HouseID)->where('parent_id', primary_user()->user_id)->where('role', 'guest')->first();

            $vacationsData = Vacation::where('HouseId', current_house()->HouseID)
                ->when($user->is_admin && $guestUser, function ($query) use ($guestUser) {
                    $query->where('OwnerId', '<>', $guestUser->user_id);
                })
                ->when($user->is_owner_only, function ($query) use($user) {
                    $query->where('OwnerId', $user->user_id);
                })
                ->where('is_calendar_task', 0)
                ->orderBy('VacationName')->get();

            $rooms = Room::where('HouseId', $user->HouseId)->select('RoomID', 'RoomName')->get();
            $vacations = [];
            foreach ($vacationsData as $vacation) {
                $event = $vacation->houseVacations();
                if ($event['is_calendar_task'] === 0){
                    $vacations[] = $event;
                    foreach ($vacation->rooms as $room){
                        $vacations[] = $room->houseVacationRooms();
                    }
                }
            }

            $response = [
                'success' => true,
                'data' => [
                    'vacations' => $vacations,
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
     * Get Specific Vacation api
     *
     * @return \Illuminate\Http\Response
     */
    public function getSpecificVacation(Request $request)
    {
        try {
            $vacationId = $request->vacation_id;
            $vacation = Vacation::where('VacationId', $vacationId)->first();

            $response = [
                'success' => true,
                'data' => [
                    'vacation' => $vacation,
                ],
                'message' => 'Data fetched successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }


    /**
     * Get Specific Vacation Room api
     *
     * @return \Illuminate\Http\Response
     */
    public function getSpecificVacationRoom(Request $request)
    {
        try {
            $vacationId = $request->vacation_id;
            $roomId = $request->room_id;
            $vacationsRoom = VacationRoom::where('vacation_id', $vacationId)->where('room_id',$roomId)->first();

            $response = [
                'success' => true,
                'data' => [
                    'vacationRoom' => $vacationsRoom,
                ],
                'message' => 'Data fetched successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }


    /**
     * Create Vacation Room api
     *
     * @return \Illuminate\Http\Response
     */
    public function createVacationRoom(Request $request)
    {
        try {
            $user = Auth::user();
            $inputs = $request->all();
            $isCreating = empty($inputs['vacationRoomId']);
            $this->room = Room::where('RoomID', $inputs['room_id'])->first();

            $this->vacationRoom = $isCreating ? new VacationRoom() : VacationRoom::find($inputs['vacationRoomId']);

            $startDatetime = Carbon::parse($inputs['start_date'])->format('Y-m-d');
            $endDatetime = Carbon::parse($inputs['end_date'])->format('Y-m-d');

            $current_vacation = Vacation::where('VacationId', $inputs['vacation_id'] ?? '')->first();

            $startdate = explode(' ', $current_vacation->startDatetime);
            $startDatetime = $startDatetime. ' ' .$startdate[1];
            $enddate = explode(' ', $current_vacation->endDatetime);
            $endDatetime = $endDatetime. ' ' .$enddate[1];

            $validator = Validator::make($inputs, [
                'room_id' => ['required'],
                'vacation_id' => ['required'],
                'occupant_name' => ['required'],
                'start_date' => ['required'],
            ])->after(function ($validator) use ($startDatetime, $endDatetime,$isCreating,$inputs) {

                $vacation = Vacation::where('VacationId', $inputs['vacation_id'] ?? '')->first();

                if ($vacation && !($vacation->startDatetime->lte($startDatetime) && $vacation->endDatetime->gte($endDatetime))) {
                    $validator->errors()->add('vacation_id', __('You can schedule room  ' . $vacation->startDatetime . ' - ' . $vacation->endDatetime . ' date time against ' . $vacation->VacationName . '  vacation.'));
                }

                $vacationRoom = VacationRoom::where('vacation_id', $inputs['vacation_id'] ?? '')
                    ->where('room_id', $inputs['room_id'] ?? '')
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
                    ->when(!$isCreating, function ($query) {
                        $query->whereNot('id', $this->vacationRoom->id);
                    })
                    ->first();

                if ($vacationRoom) {
                    $validator->errors()->add('starts_at', __('Room already reserved in this vacation at given datetime'));
                }
            })->validate();


            $this->vacationRoom->fill([
                'vacation_id' => $inputs['vacation_id'],
                'room_id' => $inputs['room_id'],
                'occupant_name' => $inputs['occupant_name'],
                'starts_at' => $startDatetime,
                'ends_at' => $endDatetime,
            ])->save();


            $response = [
                'success' => true,
                'data' => [
                    'vacation' => $current_vacation,
                ],
                'message' => $isCreating ? 'Vacation Room created successfully' : 'Vacation Room Updated successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }


    /**
     * Delete Vacation Room api
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteVacationRoom(Request $request)
    {
        try {
            $vacationRoom = VacationRoom::find($request->id);

            if ($vacationRoom) {
                $vacationRoom->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Vacation Room deleted successfully.',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Vacation Room not found.',
                ], 404);
            }

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }


}
