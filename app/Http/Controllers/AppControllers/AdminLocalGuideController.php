<?php

namespace App\Http\Controllers\AppControllers;

use App\Http\Controllers\AppControllers\BaseController as BaseController;
use App\Models\Blog\Blog;
use App\Models\Category;
use App\Models\LocalGuide;
use App\Models\User;
use App\Notifications\LocalGuideNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminLocalGuideController extends BaseController
{
    public $siteUrl;

    public $file;

    public $category;
    public $limit;
    public $offSet;

    public $user;


    /**
     * Guide List api
     *
     * @return \Illuminate\Http\Response
     */
    public function LocalGuideList(Request $request)
    {
        try {
            $this->user = Auth::user();
            $this->category = $request->category ?? 'all';
            $this->limit = $request->limit ?? 5;
            $this->offSet = $request->offSet ?? 0;
            $user = $this->user;
            $localGuideList = LocalGuide::where('house_id', $this->user->HouseId)
                ->when($this->user->is_owner_only, function ($query) {
                    $query->where('user_id', $this->user->user_id);
                })
                ->when($this->category !== 'all', function ($query) {
                    $query->whereHas('category', function ($query) {
                        $query->where('slug', $this->category);
                    });
                })
                ->skip($this->offSet)
                ->take($this->limit)
                ->with(['user' => function ($query) {
                    $query->select('user_id', 'first_name', 'last_name', 'email', 'profile_photo_path');
                }])
                ->with(['category' => function ($query) {
                    $query->select('id', 'name', 'slug');
                }])
                ->with(['reviews' => function ($query) {
                    $query->select('id', 'rating', 'commentable_id'); // Include the foreign key
                }])
                ->withCount('reviews')
                ->orderBy('id', 'DESC')
                ->get();

            $localGuideCategories = Category::where('type', 'local-guide')
                ->where(function ($query){
                    $query->where('house_id', $this->user->HouseId)
                        ->orWhere('house_id', null);
                })
                ->get();

            $totalGuides = LocalGuide::where('house_id', $user->HouseId)
                ->when($user->is_owner_only, function ($query) use ($user) {
                    $query->where('user_id', $user->user_id);
                })
                ->when($this->category !== 'all', function ($query) {
                    $query->whereHas('category', function ($query) {
                        $query->where('slug', $this->category);
                    });
                })
                ->count();

            $response = [
                'success' => true,
                'data' => [
                    'localGuides' => $localGuideList,
                    'localGuideCategories' => $localGuideCategories,
                    'totalGuides' => $totalGuides,
                ],
                'message' => 'Data fetched successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }


    /**
     * New Local Guide api
     *
     * @return \Illuminate\Http\Response
     */
    public function createLocalGuide(Request $request)
    {
        try {
            $user = Auth::user();
            $inputs = $request->all();
            $isCreating = empty($inputs['id']);

            $localGuideItem = $isCreating ? new LocalGuide() : LocalGuide::find($inputs['id']);

            $this->file = $request->file('file');

            if ($this->file) {
                $inputs['image'] = $this->file;
            } else {
                unset($inputs['image']);
            }

            $validator = Validator::make($inputs, [
                'title' => 'required|string|max:100',
                'category_id' => 'required',
                'address' => 'nullable|max:255',
                'description' => 'nullable|max:4000000000',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation error', $validator->errors(), 422);
            }

            if ($isCreating) {
                $localGuideItem->user_id = $user->user_id;
                $localGuideItem->house_id = $user->HouseId;
            }

            $localGuideItem->fill([
                'category_id' => $inputs['category_id'] ?? null,
                'title' => $inputs['title'],
                'description' => $inputs['description'] ?? null,
                'address' => $inputs['address'] ?? null,
                'datetime' => $inputs['datetime'] ?? null,
            ])->save();

            $localGuideItem->updateFile($this->file);


//            $this->siteUrl = route('guest.local-guide.index');

//            $items = $localGuideItem;
//            $createdHouseName = $user->house->HouseName;
//            $ccList = [];
//            if ($user) {
//                $ccList[] = $user->email;
//            }
//
//            if (!is_null($user->house->local_guide_email_list) && !empty($user->house->local_guide_email_list) && $isCreating) {
//
//                $localGuideEmailsList = explode(',', $user->house->local_guide_email_list);
//                if (count($localGuideEmailsList) > 0 && !empty($localGuideEmailsList)) {
//                    $users = User::whereIn('email', $localGuideEmailsList)->where('HouseId', $user->HouseId)->get();
//
//                    foreach ($users as $us) {
//                        $us->notify(new LocalGuideNotification($ccList,$items,$user, $this->siteUrl, $createdHouseName));
//                    }
////                Notification::send($users, new BlogNotification($items,$blogUrl,$createdHouseName));
//                    $localGuideEmailsList = array_diff($localGuideEmailsList, $users->pluck('email')->toArray());
//                    if (count($localGuideEmailsList) > 0) {
//                        Notification::route('mail', $localGuideEmailsList)
//                            ->notify(new LocalGuideNotification($ccList,$items,$user, $this->siteUrl, $createdHouseName));
//                    }
//                }
//            }


            return response()->json([
                'success' => true,
                'data' => $localGuideItem,
                'message' => $isCreating ? 'Local Guide created successfully' : 'Local Guide updated successfully',
            ], 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }


    public function destroy(Request $request)
    {
        try {
            $user = Auth::user();
            $localGuideId = $request->id;

            // Find the blog by ID and ensure it belongs to the user's house
            $localGuide = LocalGuide::find($localGuideId);

            if (!$localGuide) {
                return response()->json([
                    'success' => false,
                    'message' => 'Local Guide not found or access denied.',
                ], 404);
            }

            $localGuide->delete();
            $data = $localGuide->toArray();
            $title = $data['title'];
            $createdHouseName = $user->house->HouseName;

            $owner = null;
            if (!empty($data['user_id'])) {
                $owner = User::where('user_id', $data['user_id'])->first();
            }
            $ccList = [];
            if ($owner && $owner->email) {
                $ccList[] = $owner->email;
            }

//
//            if (!is_null($user->house->BlogEmailList) && !empty($user->house->BlogEmailList)) {
//
//                $blogEmailsList = explode(',', $user->house->BlogEmailList);
//
//                if (count($blogEmailsList) > 0 && !empty($blogEmailsList)) {
//
//                    $users = User::whereIn('email', $blogEmailsList)->where('HouseId', $user->HouseId)->get();
//
//                    foreach ($users as $user) {
//                        $user->notify(new DeleteBlogEmailNotification($ccList, $title, $user, $createdHouseName));
//                    }
//
//                    $blogEmailsList = array_diff($blogEmailsList, $users->pluck('email')->toArray());
//
//                    if (count($blogEmailsList) > 0) {
//
//                        Notification::route('mail', $blogEmailsList)
//                            ->notify(new DeleteBlogEmailNotification($ccList, $title, $user, $createdHouseName));
//
//                    }
//                }
//            }


            return response()->json([
                'success' => true,
                'message' => 'Local Guide deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), [], 500);
        }
    }



}
