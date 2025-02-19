<?php

namespace App\Http\Controllers\AppControllers;

use App\Models\CalendarSetting;
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

            $response = [
                'success' => true,
                'data' => [
                    'CalendarSetting' => $calendarSetting,
                ],
                'message' => 'Data fetched successfully',
            ];

            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }
}
