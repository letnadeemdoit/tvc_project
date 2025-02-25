<?php

namespace App\Http\Controllers\AppControllers;

use App\Models\CalendarSetting;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarSettingsController extends BaseController
{
    /**
     * Get Calendar Settings api
     *
     * @return \Illuminate\Http\Response
     */
    public function getCalendarSettings(Request $request)
    {
        try {
            $calendarSetting = CalendarSetting::where('house_id', primary_user()->HouseId)->first();

            $user = Auth::user();
            $user->load('house');
            $subscription = Subscription::where([
                'user_id' => primary_user()->user_id,
                'house_id' => primary_user()->HouseId,
                'status' => 'ACTIVE',
            ])->whereIn('plan', ['basic', 'standard', 'premium'])->first();

            $authUser['user'] = $user;
            $authUser['subscription'] = $subscription;

            $response = [
                'success' => true,
                'data' => [
                    'CalendarSetting' => $calendarSetting->toCalendarSettings(),
                    'authUser' => $authUser
                ],
                'message' => 'Data fetched successfully',
            ];

            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }
}
