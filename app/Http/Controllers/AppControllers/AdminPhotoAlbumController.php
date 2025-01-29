<?php

namespace App\Http\Controllers\AppControllers;

use App\Http\Controllers\Controller;
use App\Models\Blog\Blog;
use App\Models\Photo\Album;
use App\Models\Photo\Photo;
use App\Models\User;
use App\Notifications\DeletePhotoEmailNotification;
use App\Notifications\PhotoAlbumNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminPhotoAlbumController extends BaseController
{
    public $user;

    public $file;

    public $limit;
    public $offSet;

    /**
     * Albums List api
     *
     * @return \Illuminate\Http\Response
     */
    public function albumsList(Request $request)
    {
        try {
            $this->user = Auth::user();
            $search = $request->search;
            $this->limit = $request->limit ?? 5;
            $this->offSet = $request->offSet ?? 0;
            $albums = Album::where('house_id', $this->user->HouseId)
                ->when($search !== '', function ($query) use ($search) {
                    $query->where(function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%$search%");
                    });
                })
                ->with(['house' => function ($query) {
                    $query->select('HouseID', 'HouseName');
                }])
                ->with(['user' => function ($query) {
                    $query->select('user_id', 'first_name', 'last_name', 'email', 'profile_photo_path');
                }])
                ->skip($this->offSet)
                ->take($this->limit)
                ->get();

            $response = [
                'success' => true,
                'data' => [
                    'albumsList' => $albums,
                ],
                'message' => 'Data fetched successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }


    /**
     * Album Photos List api
     *
     * @return \Illuminate\Http\Response
     */
    public function albumPhotos(Request $request)
    {
        try {
            $album_id = $request->albumId;
            $this->limit = $request->limit ?? 10;
            $this->offSet = $request->offSet ?? 0;
            $albumPhotos = Photo::where('album_id', $album_id)
                ->orderBy('created_at', 'ASC')
                ->skip($this->offSet)
                ->take($this->limit)
                ->get();

            $response = [
                'success' => true,
                'data' => [
                    'albumPhotos' => $albumPhotos,
                ],
                'message' => 'Data fetched successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }


    /**
     * New Photos List api
     *
     * @return \Illuminate\Http\Response
     */

    public function createNewPhoto(Request $request)
    {
        try {
            $user = Auth::user();
            $inputs = $request->all();
            $isCreating = empty($inputs['PhotoId']);

            $photoItem = $isCreating ? new Photo() : Photo::find($inputs['PhotoId']);

            $this->file = $request->file('file');

            if ($this->file) {
                $inputs['image'] = $this->file;
            } else {
                unset($inputs['image']);
            }

            $validator = Validator::make($inputs, [
                'image' => [
                    $isCreating ? 'required' : 'nullable',
                    'mimes:png,jpg,gif,tiff'
                ],
                'album_id' => 'required',
                'description' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation error', $validator->errors(), 422);
            }

            $photoItem->fill([
                'HouseId' => $user->HouseId,
                'OwnerId' => $user->user_id,
                'album_id' => $inputs['album_id'],
                'description' => $inputs['description'] ?? null,
            ])->save();

            if ($this->file) {
                $photoItem->updateFile($this->file, 'path');
            }


//            $siteUrl = route('guest.photo-album.index');
//            $siteUrl = null;
//            $ccList = [];
//            if ($user) {
//                $ccList[] = $user->email;
//            }
//            $items = $photoItem;
//            $createdHouseName = $user->house->HouseName;
//
//            if (!is_null($user->house->photo_email_list) && !empty($user->house->photo_email_list) && $isCreating) {
//
//                $photoEmailsList = explode(',', $user->house->photo_email_list);
//                if (count($photoEmailsList) > 0 && !empty($photoEmailsList)) {
//                    $users = User::whereIn('email', $photoEmailsList)->where('HouseId', $user->HouseId)->get();
//
//                    foreach ($users as $us) {
//                        $us->notify(new PhotoAlbumNotification($ccList,$items,$user, $siteUrl, $createdHouseName));
//                    }
//                    $photoEmailsList = array_diff($photoEmailsList, $users->pluck('email')->toArray());
//                    if (count($photoEmailsList) > 0) {
//                        Notification::route('mail', $photoEmailsList)
//                            ->notify(new PhotoAlbumNotification($ccList,$items,$user, $siteUrl, $createdHouseName));
//                    }
//                }
//            }


            return response()->json([
                'success' => true,
                'data' => $photoItem,
                'message' => $isCreating ? 'Photo created successfully' : 'Photo updated successfully',
            ], 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }

    }


    /**
     * Delete Photo api
     *
     * @return \Illuminate\Http\Response
     */

    public function destroyPhoto(Request $request)
    {
        try {
            $user = Auth::user();
            $photoId = $request->id;

            // Find the Photo by ID and ensure it belongs to the user's house
            $photo = Photo::find($photoId);

            if (!$photo) {
                return response()->json([
                    'success' => false,
                    'message' => 'Photo not found or access denied.',
                ], 404);
            }

            $data = $photo->toArray();
            $photo->delete();

            $siteUrl = null;
            $owner = null;
            if (!empty($data['OwnerId'])) {
                $owner = User::where('user_id', $data['OwnerId'])->first();
            }

            $ccList = [];
            if ($owner && $owner->email) {
                $ccList[] = $owner->email;
            }
            $createdHouseName = $user->house->HouseName;

            $album = Album::where('id', $data['album_id'])->first();

            $dataObject = null;


//            if (!is_null($user->house->photo_email_list) && !empty($user->house->photo_email_list)) {
//
//                $photoEmailsList = explode(',', $user->house->photo_email_list);
//
//                if (count($photoEmailsList) > 0 && !empty($photoEmailsList)) {
//
//                    $users = User::whereIn('email', $photoEmailsList)->where('HouseId', $user->HouseId)->get();
//
//                    foreach ($users as $us) {
//                        $us->notify(new DeletePhotoEmailNotification($ccList, $siteUrl,$dataObject,$album['name'],$user, $createdHouseName));
//                    }
//
//                    $photoEmailsList = array_diff($photoEmailsList, $users->pluck('email')->toArray());
//
//                    if (count($photoEmailsList) > 0) {
//
//                        Notification::route('mail', $photoEmailsList)
//                            ->notify(new DeletePhotoEmailNotification($ccList, $siteUrl,$dataObject,$album['name'],$user, $createdHouseName));
//
//                    }
//                }
//            }




            return response()->json([
                'success' => true,
                'message' => 'Photo deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), [], 500);
        }
    }





}
