<?php

namespace App\Http\Controllers\AppControllers;

use App\Http\Controllers\Controller;
use App\Models\Photo\Album;
use App\Models\Photo\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GuestPhotoAlbumController extends BaseController
{

    public $parent_id = null;

    public $user = null;

    public $file;

    public ?Album $album;

    public ?Photo $photo;

    public $sort_order = null;


    /**
     * Photos List api
     *
     * @return \Illuminate\Http\Response
     */
    public function photoList(Request $request)
    {
        try {
            $this->user = Auth::user();
            $this->parent_id = $request->parent_id;
            $this->sort_order = $request->order ?? 'asc';

            $this->album = !is_null($this->parent_id)
                ? Album::where('id', $this->parent_id)->where('house_id', $this->user->HouseId)->first()
                : null;

            $data = Album::with(['nestedAlbums', 'photos'])
                ->where('house_id', $this->user->HouseId)
                ->when($this->parent_id, function ($query) {
                    $query->where('parent_id', $this->parent_id)->whereNotNull('parent_id');
                }, function ($query) {
                    $query->whereNull('parent_id');
                })
                ->get();

            if ($this->album && $this->album->photos->isNotEmpty()) {
                $albumPhotos = $this->album->photos;
                $sortedPhotos = $this->sort_order === 'desc'
                    ? $albumPhotos->sortByDesc('created_at')
                    : $albumPhotos->sortBy('created_at');
                $data = $data->merge($sortedPhotos);
            }

            if ($this->sort_order === 'desc') {
                $data = $data->sortByDesc('created_at');
            } else {
                $data = $data->sortBy('created_at');
            }

            $response = [
                'success' => true,
                'data' => [
                    'photosList' => $data->values(),
                ],
                'message' => 'Data fetched successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            \Log::error('Photo list error', ['exception' => $e]);
            return $this->sendError('An error occurred while fetching the photo list.', []);
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




}
