<?php

namespace App\Http\Controllers\AppControllers;

use App\Http\Controllers\Controller;
use App\Models\Photo\Album;
use App\Models\Photo\Photo;
use App\Models\User;
use App\Notifications\DeletePhotoEmailNotification;
use App\Notifications\PhotoAlbumNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class GuestPhotoAlbumController extends BaseController
{

    public $parent_id = null;

    public $user = null;

    public $siteUrl = null;

    public $file;

    public ?Album $album;

    public ?Photo $photo;

    public $sort_order = null;

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

            $totalAlbums = Album::where('house_id', $this->user->HouseId)
                ->when($search !== '', function ($query) use ($search) {
                    $query->where(function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%$search%");
                    });
                })
                ->count();


            $response = [
                'success' => true,
                'data' => [
                    'albumsList' => $albums,
                    'totalAlbums' => $totalAlbums,
                ],
                'message' => 'Data fetched successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }



    /**
     * Photos List api
     *
     * @return \Illuminate\Http\Response
     */
    public function photoList(Request $request)
    {
        try {
            $this->user = Auth::user();
            $this->parent_id = $request->albumId;
            $this->sort_order = $request->order ?? 'asc';
            $this->limit = $request->limit ?? 5;
            $this->offSet = $request->offSet ?? 0;
            $search = $request->search;
            if (!is_null($this->parent_id)) {
                $this->album = Album::where('id', $this->parent_id)->where('house_id', $this->user->HouseId)->first();
                if (!$this->album){
                    $this->album = Album::where('id', $this->parent_id)->where('house_id', null)->where('name', 'General')->first();
                }
            } else {
                $this->album = null;
            }

            $photosCount = 0;
            $data = Album::with(['nestedAlbums'])
                ->with(['house' => function ($query) {
                    $query->select('HouseID', 'HouseName');
                }])
                ->with(['user' => function ($query) {
                    $query->select('user_id', 'first_name', 'last_name', 'email', 'profile_photo_path');
                }])
                ->when($search !== '', function ($query) use ($search) {
                    $query->where(function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%$search%");
                    });
                })
                ->where(function ($query){
                    $query->where('house_id', $this->user->HouseId)
                        ->orWhere('house_id', null);
                })
//                ->where('house_id', $this->user->HouseId)
                ->when($this->parent_id, function ($query) {
                    $query->where('parent_id', $this->parent_id)->whereNotNull('parent_id');
                }, function ($query) {
                    $query->whereNull('parent_id');
                })
                ->skip($this->offSet)
                ->take($this->limit)
                ->get();

                $data->each(function ($album) use (&$photosCount) {
                    $album->image = $album->getFileUrl();
                    $album->photos = $album->getRelevantPhotos($album->id,$this->user->HouseId);
                    $photosCount += $album->photos->count();
                });

            // if ($this->album && $this->album->photos->isNotEmpty()) {
            //     $albumPhotos = $this->album->photos()
            //         ->orderBy('created_at', $this->sort_order)
            //         ->skip($this->offSet)
            //         ->take($this->limit)
            //         ->get();
            //     // Store count separately
            //     $photosCount = $this->album->photos()->count();

            //     $data = $data->merge($albumPhotos);
            // }


                    // Fetch photos according to new condition
            $photos = collect();

            if ($this->album) {
                if (is_null($this->album->house_id)) {
                    // If album's house_id is null, fetch photos by user's HouseId
                    $photos = Photo::where('album_id',$this->album->id)->where('HouseId', $this->user->HouseId)
                        ->orderBy('created_at', $this->sort_order)
                        ->skip($this->offSet)
                        ->take($this->limit)
                        ->get();

                    $photosCount = Photo::where('album_id',$this->album->id)->where('HouseId', $this->user->HouseId)->count();
                } else {
                    // If album has a house_id, fetch by album_id only
                    $photos = $this->album->photos()
                        ->orderBy('created_at', $this->sort_order)
                        ->skip($this->offSet)
                        ->take($this->limit)
                        ->get();

                    $photosCount = $this->album->photos()->count();
                }

                $data = $data->merge($photos);
            }

            if ($this->sort_order === 'desc') {
                $data = $data->sortByDesc('created_at');
            } else {
                $data = $data->sortBy('created_at');
            }

            $totalAlbums = Album::
//            where('house_id', $this->user->HouseId)
                where(function ($query){
                    $query->where('house_id', $this->user->HouseId)
                        ->orWhere('house_id', null);
                })
                ->when($search !== '', function ($query) use ($search) {
                    $query->where(function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%$search%");
                    });
                })
                ->where('parent_id', $this->parent_id)
                ->count();

            $response = [
                'success' => true,
                'data' => [
                    'albums' => $data->values(),
                    'totalAlbums' => $totalAlbums,
                    'photosCount' => $photosCount ?? 0,
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


            // Create Photo in album email
            $this->siteUrl = route('guest.photo-album.index', ['parent_id' => $inputs['album_id']]);
            $ccList = [];
            if ($user && primary_user()->email !== $user->email) {
                $ccList[] = $user->email;
            }
            $items = $photoItem;
            $createdHouseName = $user->house->HouseName;

            if (!is_null($user->house->photo_email_list) && !empty($user->house->photo_email_list) && $isCreating) {

                $photoEmailsList = explode(',', $user->house->photo_email_list);
                $photoEmailsList = array_merge($photoEmailsList, $ccList);
                $photoEmailsList = array_unique(array_filter($photoEmailsList));

                if (count($photoEmailsList) > 0 && !empty($photoEmailsList)) {

                    $users = User::whereIn('email', $photoEmailsList)->where('HouseId', $user->HouseId)->get();
                    foreach ($users as $us) {
                        $us->notify(new PhotoAlbumNotification($ccList,$items,$user, $this->siteUrl, $createdHouseName));
                    }

                    if (count($photoEmailsList) > 0) {
                        Notification::route('mail', $photoEmailsList)
                            ->notify(new PhotoAlbumNotification($ccList,$items,$user, $this->siteUrl, $createdHouseName));
                    }
                }
            }

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

            $this->siteUrl = route('guest.photo-album.index', ['parent_id' => $data['album_id']]);
            $owner = null;
            if (!empty($data['OwnerId'])) {
                $owner = User::where('user_id', $data['OwnerId'])->first();
            }
            $ccList = [];
            if ($owner && primary_user()->email !== $owner->email) {
                $ccList[] = $owner->email;
            }
            $createdHouseName = $user->house->HouseName;
            $album = Album::where('id', $data['album_id'])->first();
            $dataObject = null;

            if (!is_null($user->house->photo_email_list) && !empty($user->house->photo_email_list)) {

                $photoEmailsList = explode(',', $user->house->photo_email_list);
                $photoEmailsList = array_merge($photoEmailsList, $ccList);
                $photoEmailsList = array_unique(array_filter($photoEmailsList));

                if (count($photoEmailsList) > 0 && !empty($photoEmailsList)) {

                    $users = User::whereIn('email', $photoEmailsList)->where('HouseId', $user->HouseId)->get();
                    foreach ($users as $us) {
                        $us->notify(new DeletePhotoEmailNotification($ccList, $this->siteUrl, $dataObject, $album['name'], $user, $createdHouseName));
                    }

                    if (count($photoEmailsList) > 0) {
                        Notification::route('mail', $photoEmailsList)
                            ->notify(new DeletePhotoEmailNotification($ccList, $this->siteUrl, $dataObject, $album['name'], $user, $createdHouseName));
                    }
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Photo deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), [], 500);
        }
    }



}
