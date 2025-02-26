<?php

namespace App\Http\Controllers\AppControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vacation;
use App\Notifications\RequestToJoinVacationNotification1;
use App\Notifications\RequestToUseVacationHomeNotification1;
use App\Rules\VacationSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class RequestToJoinVacationController extends BaseController
{

    public $user;

    public $vacation;
    public $isGuestScheduleVacation = false;


    /**
     * Request To Join Vacations api
     *
     * @return \Illuminate\Http\Response
     */
    public function RequestToJoinVacation(Request $request)
    {
        try {

            $inputs = $request->all();
            $this->vacation = Vacation::firstOrNew(['VacationID' => $inputs['VacationId'] ?? null]);
            $this->user = Auth::user();
            $validator = Validator::make($inputs, [
                'VacationId' => ['required'],
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'email', 'string', 'max:255'],
                'start_datetime' => ['required', new VacationSchedule($inputs['end_datetime'] ?? null, $this->user, $this->vacation)],
            ], [
                'start_datetime.required' => 'The start & end datetime field is required'
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation error', $validator->errors(), 422);
            }

            $vacation_name = $this->vacation->VacationName;
            $house_name = $this->user->house->HouseName;

            $ccList = [];
            if (isset($inputs['email'])) {
                $ccList[] = $inputs['email'];
            }
            $owner = $this->vacation->VacationId && $this->vacation->owner ? $this->vacation->owner : User::where(['HouseId' => $this->user->HouseId, 'role' => User::ROLE_ADMINISTRATOR])->first();
            $ccList[] = $owner->email;
            $ccList = array_unique(array_filter($ccList));
            try {
                $state_user['name'] = $inputs['name'];
                $state_user['email'] = $inputs['email'];
                Notification::route('mail', $ccList)
                    ->notify(new RequestToJoinVacationNotification1($vacation_name, $ccList, $house_name, $state_user, $inputs['start_datetime'], $inputs['end_datetime']));

            } catch (\Exception $e) {
                Log::error('Notification error: ' . $e->getMessage());
            }

            $response = [
                'success' => true,
                'data' => [
                    'vacation' => $this->vacation,
                ],
                'message' => 'Request sent successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }

    }
}
