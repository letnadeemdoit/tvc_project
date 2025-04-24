<?php

namespace App\Http\Controllers\AppControllers;

use App\Http\Controllers\Controller;
use App\Models\Blog\Blog;
use App\Models\BlogViews;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminNotificationsController extends BaseController
{
    public $limit;
    public $offSet;



    /**
     * Notifications List api
     *
     * @return \Illuminate\Http\Response
     */
    public function notificationsList(Request $request)
    {
        try {
            $user = Auth::user();
            $this->limit = $request->limit ?? 10;
            $this->offSet = $request->offSet ?? 0;


            $data = $user->unreadNotifications()
                ->skip($this->offSet)
                ->take($this->limit)
                ->get();


            $response = [
                'success' => true,
                'data' => [
                    'notifications' => $data,
                ],
                'message' => 'Data fetched successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError('An error occurred: ' . $e->getMessage(), []);
        }
    }


    /**
     * Read Notification api
     *
     * @return \Illuminate\Http\Response
     */
    public function readNotification(Request $request)
    {
        try {
            $inputs = $request->all();

            $validator = Validator::make($inputs, [
                'id' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation error', $validator->errors(), 422);
            }

            DB::table('notifications')->where('id', $request->id)->update(['read_at' => now()]);

            return response()->json([
                'success' => true,
                'data' => [],
                'message' => 'Notification read successfully',
            ], 200);

        } catch (\Exception $e) {
            return $this->sendError('An error occurred: ' . $e->getMessage(), []);
        }
    }

    

    /**
     * Read All Notifications api
     *
     * @return \Illuminate\Http\Response
     */
    public function readAllNotifications(Request $request)
    {
        try {
            DB::table('notifications')->update(['read_at' => now()]);
            return response()->json([
                'success' => true,
                'data' => [],
                'message' => 'Notifications read successfully',
            ], 200);

        } catch (\Exception $e) {
            return $this->sendError('An error occurred: ' . $e->getMessage(), []);
        }
    }


    /**
     * Count unread notifications for a specific house
     *
     * @return \Illuminate\Http\Response
     */
    public function notificationsCount(Request $request)
    {
        try {

            $user = Auth::user();
            $count = $user->unreadNotifications()->count();

            return response()->json([
                'success' => true,
                'data' => [
                    'count' => $count
                ],
                'message' => 'Unread notifications count retrieved successfully',
            ], 200);

        } catch (\Exception $e) {
            return $this->sendError('An error occurred: ' . $e->getMessage(), []);
        }
    }

}
