<?php

namespace App\Http\Controllers\AppControllers;

use App\Http\Controllers\Controller;
use App\Models\GuestBook;
use App\Models\User;
use App\Notifications\DeleteGuestBookEmailNotification;
use App\Notifications\GuestBookNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
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
                ->when($user->role !== 'Administrator', function ($query) {
                    $query->where('status', 1);
                })
//                ->where('status', 1)
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
            $isCreating = empty($inputs['id']);

            $guestBookItem = $isCreating ? new GuestBook() : GuestBook::find($inputs['id']);
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

            if ($isCreating) {
                $guestBookItem->user_id = $user->user_id;
                $guestBookItem->house_id = $user->HouseId;
            }

            $guestBookItem->fill([
                'name' => $inputs['name'],
                'title' => $inputs['title'] ?? null,
                'content' => $inputs['content'] ?? null,
                'status' => $inputs['status'] ?? 0,
            ])->save();

            $guestBookItem->updateFile($this->file);

            // Create Guest book email
            $this->siteUrl = route('guest.guest-book.index');
            $createdHouseName = $user->house->HouseName;
            $ccList = [];
            if ($user && primary_user()->email !== $user->email) {
                $ccList[] = $user->email;
            }

            if (!is_null($user->house->guest_book_email_list) && !empty($user->house->guest_book_email_list) && $isCreating) {

                $guestBookEmailsList = explode(',', $user->house->guest_book_email_list);
                $guestBookEmailsList = array_merge($guestBookEmailsList, $ccList);
                $guestBookEmailsList = array_unique(array_filter($guestBookEmailsList));

                if (count($guestBookEmailsList) > 0 && !empty($guestBookEmailsList)) {

                    $users = User::whereIn('email', $guestBookEmailsList)->where('HouseId', $user->HouseId)->get();
                    foreach ($users as $us) {
                        $us->notify(new GuestBookNotification($ccList,$inputs['title'],$user, $this->siteUrl, $createdHouseName));
                    }

                    if (count($guestBookEmailsList) > 0) {
                        Notification::route('mail', $guestBookEmailsList)
                            ->notify(new GuestBookNotification($ccList,$inputs['title'],$user, $this->siteUrl, $createdHouseName));
                    }
                }

            }

            return response()->json([
                'success' => true,
                'data' => $guestBookItem,
                'message' => $isCreating ? 'Guest Book created successfully' : 'Guest Book updated successfully',
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error creating/updating Guest Book Item:', [
                'message' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
                'inputs' => $request->all(),
            ]);
            return $this->sendError($e->getMessage(), []);
        }

    }

    /**
     * Delete Guest Book api
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteGuestBook(Request $request)
    {
        try {
            $user = Auth::user();

            $guestBookId = $request->id;
            $guestBookItem = GuestBook::find($guestBookId);
            if (!$guestBookItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Guest Book not found or access denied.',
                ], 404);
            }

            // Delete Guest book email notification
            $data = $guestBookItem->toArray();
            $guestBookItem->delete();
            $title = $data['title'];
            $createdHouseName = $user->house->HouseName;
            $isModel = 'Guest Book';
            $owner = null;
            if (!empty($data['user_id'])) {
                $owner = User::where('user_id', $data['user_id'])->first();
            }
            $ccList = [];
            if ($owner && primary_user()->email !== $owner->email) {
                $ccList[] = $owner->email;
            }
            if (!is_null($user->house->guest_book_email_list) && !empty($user->house->guest_book_email_list)) {

                $guestBookEmailsList = explode(',', $user->house->guest_book_email_list);
                $guestBookEmailsList = array_merge($guestBookEmailsList, $ccList);
                $guestBookEmailsList = array_unique(array_filter($guestBookEmailsList));

                if (count($guestBookEmailsList) > 0 && !empty($guestBookEmailsList)) {

                    $users = User::whereIn('email', $guestBookEmailsList)->where('HouseId', $user->HouseId)->get();
                    foreach ($users as $us) {
                        $us->notify(new DeleteGuestBookEmailNotification($ccList, $isModel, $title, $user, $createdHouseName));
                    }

                    if (count($guestBookEmailsList) > 0) {
                        Notification::route('mail', $guestBookEmailsList)
                            ->notify(new DeleteGuestBookEmailNotification($ccList, $isModel, $title, $user, $createdHouseName));
                    }
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Guest Book Item deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), [], 500);
        }
    }


}
