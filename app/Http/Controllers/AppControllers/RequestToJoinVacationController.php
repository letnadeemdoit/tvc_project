<?php

namespace App\Http\Controllers\AppControllers;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\CalendarSetting;
use App\Models\GuestContact;
use App\Models\Time;
use App\Models\User;
use App\Models\Vacation;
use App\Notifications\RequestToApproveVacationEmailNotification;
use App\Notifications\RequestToJoinVacationNotification1;
use App\Notifications\RequestToUseVacationHomeNotification1;
use App\Notifications\RequestToUseVacationHomeNotification2;
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

    public $siteUrl = null;
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
                $users = User::whereIn('email', $ccList)->where('HouseId', $this->user->HouseId)->get();

                $state_user['name'] = $inputs['name'];
                $state_user['email'] = $inputs['email'];
                foreach ($users as $us) {
                    $us->notify(new RequestToJoinVacationNotification1($vacation_name, $ccList, $house_name, $state_user, $inputs['start_datetime'], $inputs['end_datetime']));
                }

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
                'message' => 'Request to join vacation sent successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }


    /**
     * Request To Use House api
     *
     * @return \Illuminate\Http\Response
     */
    public function RequestToUseHouse(Request $request)
    {
        try {
            $calendarSetting = CalendarSetting::where('house_id', primary_user()->HouseId)->first();
            if ($calendarSetting && $calendarSetting->allow_guest_vacations === 1) {
                $this->isGuestScheduleVacation = true;
            }

            $inputs = $request->all();
            $this->vacation = Vacation::firstOrNew(['VacationID' => null]);
            $this->user = Auth::user();
            $validator = Validator::make($inputs, [
                'vacation_name' => $this->isGuestScheduleVacation ? ['required'] : ['nullable'],
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'email', 'string', 'max:255'],
                'start_datetime' => $this->isGuestScheduleVacation && !$this->vacation->VacationId ? [
                    'required',
                    new VacationSchedule($inputs['end_datetime'] ?? null, $this->user, $this->vacation)
                ] : ['required'],
            ], [
                'start_datetime.required' => 'The start & end datetime field is required'
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation error', $validator->errors(), 422);
            }

            if ($this->isGuestScheduleVacation && $this->user->is_guest) {
                // Creating guest vacation
                $vacation = $this->saveVacationSchedule($inputs);

                $response = [
                    'success' => true,
                    'data' => [
                        'vacation' => $vacation,
                    ],
                    'message' => 'Guest vacation created successfully',
                ];
                return response()->json($response, 200);
                // End creating guest vacation
            } else {
                $house = $this->user->house;
                if ($house && !is_null($house->request_to_use_house_email_list) && !empty($house->request_to_use_house_email_list)) {

                    $request_to_use_house_email_list = explode(',', $this->user->house->request_to_use_house_email_list);

                    $users = User::whereIn('email', $request_to_use_house_email_list)->where('HouseId', $this->user->HouseId)->get();
                    foreach ($users as $us) {
                        $us->notify(new RequestToUseVacationHomeNotification1($inputs['name'], $inputs['email'], $house->HouseName, $inputs['start_datetime'], $inputs['end_datetime']));
                    }

                    if (count($request_to_use_house_email_list) > 0 && !empty($request_to_use_house_email_list)) {
                        if (count($request_to_use_house_email_list) > 0) {
                            Notification::route('mail', $request_to_use_house_email_list)
                                ->notify(new RequestToUseVacationHomeNotification1($inputs['name'], $inputs['email'], $house->HouseName, $inputs['start_datetime'], $inputs['end_datetime']));

                        }

                    }
                }


                $response = [
                    'success' => true,
                    'data' => [],
                    'message' => 'Request to use house request sent successfully',
                ];
                return response()->json($response, 200);

            }


        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }


    public function saveVacationSchedule($inputs)
    {
        try {

            $startDatetime = Carbon::parse($inputs['start_datetime']);
            $endDatetime = Carbon::parse($inputs['end_datetime']);

            $vacStartDate = $startDatetime->format('m-d-Y H:i');;
            $vacEndDate = $endDatetime->format('m-d-Y H:i');

            $this->syncCalendar($startDatetime, $endDatetime, $startDate, $startTime, $endDate, $endTime);

            $this->vacation->fill([
                'HouseId' => $this->user->HouseId,
                'OwnerId' => $this->user->user_id,
                'BackGrndColor' => '#CCCCCC',
                'FontColor' => '#ffffff',
                'VacationName' => $inputs['vacation_name'],
                'recurrence' => null,
                'StartDateId' => $startDate->DateId,
                'StartTimeId' => $startTime->timeid,
                'EndDateId' => $endDate->DateId,
                'EndTimeId' => $endTime->timeid,
                'repeat_interval' => 0,
                'book_rooms' => 0,
                'is_vac_approved' => 0,
                'original_owner' => $this->user->user_id,
            ])->save();

            $guestContact = GuestContact::firstOrNew(['house_id' => $this->user->HouseId, 'guest_id' => $this->user->user_id, 'guest_email' => $inputs['email'], 'guest_vac_id' => $this->vacation->VacationId,]);
            if ($guestContact && $guestContact->id) {
                $guestContact->update(
                    [
                        'guest_name' => $inputs['name'],
                    ]
                );
            } else {
                $guestContact->fill([
                    'guest_id' => $this->user->user_id,
                    'house_id' => $this->user->HouseId,
                    'guest_vac_id' => $this->vacation->VacationId,
                    'guest_vac_color' => '#CCCCCC',
                    'guest_name' => $inputs['name'],
                    'guest_email' => $inputs['email']
                ])->save();
            }


            $currentUrl = url('/');
            $fullUrl = $currentUrl . '/settings/vacation-request-approval';

            $vacName = $inputs['vacation_name'];
            $createdHouseName = $this->user->house->HouseName;
            $ccList = [];
            if (isset($inputs['email'])) {
                $ccList[] = $inputs['email'];
            }
            if (!is_null($this->user->house->request_to_use_house_email_list) && !empty($this->user->house->request_to_use_house_email_list)) {

                $CalEmailList = explode(',', $this->user->house->request_to_use_house_email_list);
                $CalEmailList = array_merge($CalEmailList, $ccList);
                $CalEmailList = array_unique(array_filter($CalEmailList));

                $users = User::whereIn('email', $CalEmailList)->where('HouseId', $this->user->HouseId)->get();
                foreach ($users as $us) {
                    $us->notify(new RequestToUseVacationHomeNotification2($vacName, $ccList, $inputs['name'], $inputs['email'], $createdHouseName, $vacStartDate, $vacEndDate));
                }

                if (count($CalEmailList) > 0 && !empty($CalEmailList)) {
                    if (count($CalEmailList) > 0) {
                        Notification::route('mail', $CalEmailList)
                            ->notify(new RequestToUseVacationHomeNotification2($vacName, $ccList, $inputs['name'], $inputs['email'], $createdHouseName, $vacStartDate, $vacEndDate));
                    }

                }
            }

            if (!is_null($this->user->house->vacation_approval_email_list) && !empty($this->user->house->vacation_approval_email_list)) {

                $this->siteUrl = route('dash.settings.vacation-request-approval');

                $CalEmailList = explode(',', $this->user->house->vacation_approval_email_list);
                $CalEmailList = array_merge($CalEmailList, $ccList);
                $CalEmailList = array_unique(array_filter($CalEmailList));
                $users = User::whereIn('email', $CalEmailList)->where('HouseId', $this->user->HouseId)->get();
                foreach ($users as $us) {
                    $us->notify(new RequestToApproveVacationEmailNotification($vacName, $this->siteUrl, $ccList, $inputs['name'], $inputs['email'], $createdHouseName, $vacStartDate, $vacEndDate));
                }

                if (count($CalEmailList) > 0 && !empty($CalEmailList)) {
                    if (count($CalEmailList) > 0) {
                        Notification::route('mail', $CalEmailList)
                            ->notify(new RequestToApproveVacationEmailNotification($vacName, $this->siteUrl, $ccList, $inputs['name'], $inputs['email'], $createdHouseName, $vacStartDate, $vacEndDate));
                    }

                }
            }

            // Return the created vacation
            return $this->vacation;

        } catch (Exception $e) {
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
