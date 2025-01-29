<?php

namespace App\Http\Controllers\AppControllers;

use App\Http\Controllers\Controller;
use App\Models\GuestBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class GuestBookController extends BaseController
{
    public $siteUrl;
    public $limit;
    public $offSet;
    public $file;
    public $search;



    /**
     * Guest Book List api
     *
     * @return \Illuminate\Http\Response
     */
    public function guestBookList(Request $request)
    {
        try {
            $user = Auth::user();
            $this->limit = $request->limit ?? 5;
            $this->offSet = $request->offSet ?? 0;
            $data = GuestBook::where('house_id', $user->HouseId)
                ->where('status', 1)
                ->skip($this->offSet)
                ->take($this->limit)
                ->orderBy('id', 'DESC')
                ->get();

            $response = [
                'success' => true,
                'data' => [
                    'data' => $data
                ],
                'message' => 'Data fetched successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }



    /**
     * New Guest Book api
     *
     * @return \Illuminate\Http\Response
     */
    public function createGuestBook(Request $request)
    {
        try {
            $user = Auth::user();
            $inputs = $request->all();
            $this->file = $request->file('file');

            if ($this->file) {
                $inputs['image'] = $this->file;
            } else {
                unset($inputs['image']);
            }

            $validator = Validator::make($inputs, [
                'name' => 'required|string|max:40',
                'title' => 'required|string|max:80',
                'content' => 'required',
                'image' => 'nullable|mimes:png,jpg,gif,tiff',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation error', $validator->errors(), 422);
            }

            $guestBookItem = new GuestBook();
            $guestBookItem->user_id = $user->user_id;
            $guestBookItem->house_id = $user->HouseId;

            $guestBookItem->fill([
                'name' => $inputs['name'],
                'title' => $inputs['title'],
                'content' => $inputs['content'],
                'status' => 0,
            ])->save();

            if ($this->file) {
                $guestBookItem->updateFile($this->file);
            }


            //$this->siteUrl = route('guest.guest-book.index');
//
//            $createdHouseName = $user->house->HouseName;
//            $ccList = [];
//            if ($user) {
//                $ccList[] = $user->email;
//            }
//
//            if (!is_null($user->house->guest_book_email_list) && !empty($user->house->guest_book_email_list)) {
//
//                $guestBookEmailsList = explode(',', $user->house->guest_book_email_list);
//                if (count($guestBookEmailsList) > 0 && !empty($guestBookEmailsList)) {
//                    $users = User::whereIn('email', $guestBookEmailsList)->where('HouseId', $user->HouseId)->get();
//
//                    foreach ($users as $us) {
//                        $us->notify(new GuestBookNotification($ccList,$inputs['title'],$user, $this->siteUrl, $createdHouseName));
//                    }
//                    $guestBookEmailsList = array_diff($guestBookEmailsList, $users->pluck('email')->toArray());
//                    if (count($guestBookEmailsList) > 0) {
//                        Notification::route('mail', $guestBookEmailsList)
//                            ->notify(new GuestBookNotification($ccList,$inputs['title'],$user, $this->siteUrl, $createdHouseName));
//                    }
//                }
//            }


            return response()->json([
                'success' => true,
                'data' => $guestBookItem,
                'message' => 'Guest Book created successfully',
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error creating Guest Book Item:', [
                'message' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
                'inputs' => $request->all(),
            ]);
            return $this->sendError('An error occurred while creating the Guest Book.', []);
        }
    }


}
