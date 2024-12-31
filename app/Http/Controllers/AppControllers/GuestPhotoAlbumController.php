<?php

namespace App\Http\Controllers\AppControllers;

use App\Http\Controllers\Controller;
use App\Models\Photo\Album;
use App\Models\Photo\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestPhotoAlbumController extends BaseController
{

    public $parent_id = null;

    public $user = null;

    public ?Album $album;

    public ?Photo $photo;

    public $sort_order = null;

    /**
     * Photos List api
     *
     * @return \Illuminate\Http\Response
     */
//    public function photoList(Request $request)
//    {
//        try {
//            $this->user = Auth::user();
//            $this->parent_id = $request->parent_id;
//            $this->sort_order = $request->order ?? 'asc';
//
//            if (!is_null($this->parent_id)) {
//                $this->album = Album::where('id', $this->parent_id)->where('house_id', $this->user->HouseId)->first();
//            } else {
//                $this->album = null;
//            }
//
//
//            $data = Album::where('house_id', $this->user->HouseId)
//                ->when($this->parent_id !== null, function ($query) {
//                    $query->where('parent_id', $this->parent_id)->whereNotNull('parent_id');
//                })
//                ->when($this->parent_id === null, function ($query) {
//                    $query->whereNull('parent_id');
//                })
//                ->where(function ($query) {
//                    $query->whereHas('nestedAlbums', function ($query) {
//                        $query->whereHas('nestedAlbums')->orWhereHas('photos');
//                    })->orWhereHas('photos');
//                })
//                ->get();
//
//            if ($this->album && $this->album->photos->isNotEmpty()) {
//                $albumPhotos = $this->album->photos;
//                $sortedPhotos = $this->sort_order === 'desc'
//                    ? $albumPhotos->sortByDesc('created_at')
//                    : $albumPhotos->sortBy('created_at');
//                $data = $data->merge($sortedPhotos);
//            }
//
//            $data->shuffle();
//
//
//            if ($this->parent_id === null){
//                if ($this->sort_order === 'desc') {
//                    $data = $data->sortByDesc('created_at');
//                } else {
//
//                    $data = $data->sortBy('created_at');
//                }
//            }
//
//            $response = [
//                'success' => true,
//                'data' => [
//                    'photosList' => $data,
//                ],
//                'message' => 'Data fetched successfully',
//            ];
//            return response()->json($response, 200);
//
//        } catch (\Exception $e) {
//            return $this->sendError($e->getMessage(), []);
//        }
//    }


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




}
