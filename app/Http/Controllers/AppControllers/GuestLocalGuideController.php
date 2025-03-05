<?php

namespace App\Http\Controllers\AppControllers;

use App\Http\Controllers\Controller;
use App\Models\Blog\Blog;
use App\Models\BlogViews;
use App\Models\Category;
use App\Models\Likes;
use App\Models\LocalGuide;
use App\Models\Review;
use App\Models\User;
use App\Notifications\DeleteLocalGuideEmailNotification;
use App\Notifications\LocalGuideNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class GuestLocalGuideController extends BaseController
{
    public $siteUrl;

    public $file;

    public $category;
    public $limit;
    public $offSet;


    /**
     * Local Guide List api
     *
     * @return \Illuminate\Http\Response
     */
    public function localGuideList(Request $request)
    {
        try {
            $user = Auth::user();
            $this->category = $request->category ?? 'all';
            $this->limit = $request->limit ?? 5;
            $this->offSet = $request->offSet ?? 0;

            $localGuideList = LocalGuide::where('house_id', $user->HouseId)
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
                ->with(['reviews' => function ($query) {
                    $query->select('id', 'rating', 'commentable_id'); // Include the foreign key
                }])
                ->withCount('reviews')
                ->orderBy('id', 'DESC')
                ->get();


            $localGuideCategories = Category::where('type', 'local-guide')
                ->where(function ($query) use ($user){
                    $query->where('house_id', $user->HouseId)
                        ->orWhere('house_id', null);
                })
                ->get();

            $response = [
                'success' => true,
                'data' => [
                    'localGuides' => $localGuideList,
                    'localGuideCategories' => $localGuideCategories,
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


            // Create Local Guide Email
            $slug = $localGuideItem->id;
            $this->siteUrl = route('guest.local-guide.show', $slug);
            $items = $localGuideItem;
            $createdHouseName = $user->house->HouseName;
            $ccList = [];
            if ($user && primary_user()->email !== $user->email) {
                $ccList[] = $user->email;
            }

            if (!is_null($user->house->local_guide_email_list) && !empty($user->house->local_guide_email_list) && $isCreating) {

                $localGuideEmailsList = explode(',', $user->house->local_guide_email_list);
                $localGuideEmailsList = array_merge($localGuideEmailsList, $ccList);
                $localGuideEmailsList = array_unique(array_filter($localGuideEmailsList));

                if (count($localGuideEmailsList) > 0 && !empty($localGuideEmailsList)) {
                    if (count($localGuideEmailsList) > 0) {

                        Notification::route('mail', $localGuideEmailsList)
                            ->notify(new LocalGuideNotification($ccList,$items,$user, $this->siteUrl, $createdHouseName));
                    }
                }
            }

            return response()->json([
                'success' => true,
                'data' => $localGuideItem,
                'message' => $isCreating ? 'Local Guide created successfully' : 'Local Guide updated successfully',
            ], 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }

    /**
     * Delete Local Guide api
     *
     * @return \Illuminate\Http\Response
     */
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

            // Delete Local Guide Email
            $data = $localGuide->toArray();
            $title = $data['title'];
            $createdHouseName = $user->house->HouseName;
            $owner = null;
            if (!empty($data['user_id'])) {
                $owner = User::where('user_id', $data['user_id'])->first();
            }
            $ccList = [];
            if ($owner && primary_user()->email !== $owner->email) {
                $ccList[] = $owner->email;
            }
            if (!is_null($user->house->local_guide_email_list) && !empty($user->house->local_guide_email_list)) {
                $localGuideEmailsList = explode(',', $user->house->local_guide_email_list);
                $localGuideEmailsList = array_merge($localGuideEmailsList, $ccList);
                $localGuideEmailsList = array_unique(array_filter($localGuideEmailsList));

                if (count($localGuideEmailsList) > 0 && !empty($localGuideEmailsList)) {

                    if (count($localGuideEmailsList) > 0) {
                        Notification::route('mail', $localGuideEmailsList)
                            ->notify(new DeleteLocalGuideEmailNotification($ccList,$title,$user,$createdHouseName));
                    }
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Local Guide deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), [], 500);
        }
    }



    /**
     * Local Guide Detail api
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        try {
            $user = Auth::user();
            $order = $request->order ?? 'desc';

            $dt = LocalGuide::where('id', $request->id)
                ->with([
                    'user' => function ($query) {
                        $query->select('user_id', 'first_name', 'last_name','profile_photo_path');
                    },
                    'reviews' => function ($query) use ($order){
                        $query->orderBy('created_at', $order)
                            ->with([
                                'user' => function ($query) {
                                    $query->select('user_id', 'first_name', 'last_name', 'profile_photo_path');
                                }
                            ]);
                    }
                ])
                ->withCount('reviews')
                ->first();

            if (!$dt){
                $response = [
                    'success' => true,
                    'data' => [],
                    'message' => 'Local Guide Not Found',
                ];
                return response()->json($response, 404);
            }

            $relatedGuides = LocalGuide::where('house_id', $dt->house_id)->withCount('reviews')->inRandomOrder()->limit(4)->get()->except($dt->id);


            $totalReviewLocalGuide = $dt->reviews()->get();

            $sumTotalReviews = count($totalReviewLocalGuide);

            if (isset($sumTotalReviews) && $sumTotalReviews > 0) {

                $avgRating = intval($totalReviewLocalGuide->sum('rating') / $sumTotalReviews);

            }

            $localGuideCategories = Category::where('type', 'local-guide')
                ->where(function ($query) use ($user) {
                    $query->where('house_id', $user->HouseId)
                        ->orWhere('house_id', null);
                })
                ->get();


            $response = [
                'success' => true,
                'data' => [
                    'localGuide' => $dt,
                    'relatedGuides' => $relatedGuides,
                    'localGuideCategories' => $localGuideCategories,
                    'avgRating' => $avgRating ?? 0,
                ],
                'message' => 'Data fetched successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }


    /**
     * Add Review api
     *
     * @return \Illuminate\Http\Response
     */
    public function addReview(Request $request)
    {
        try {
            $user = Auth::user();
            $inputs = $request->all();

            $validator = Validator::make($inputs, [
                'LocalGuideId' => 'required|integer',
                'rating' => 'required',
                'remarks' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation error', $validator->errors(), 422);
            }

            $localGuide = LocalGuide::where('id', $request->LocalGuideId)->first();

            if (!$localGuide) {
                return response()->json([
                    'success' => false,
                    'data' => [],
                    'message' => 'Local Guide not found',
                ], 404);
            }

            $remark = new Review();

            $remark->fill([
                'user_id' => $user->user_id,
                'house_id' => $user->HouseId,
                'rating' => $inputs['rating'] ?? null,
                'remarks' => $inputs['remarks'] ?? null,
            ]);

            $localGuide->reviews()->save($remark);

            // Load the associated user for the review
            $remark->load('user:user_id,first_name,last_name,email,profile_photo_path');

            return response()->json([
                'success' => true,
                'data' => [
                    'review' => $remark
                ],
                'message' => 'Review created successfully',
            ], 200);

        } catch (\Exception $e) {
            return $this->sendError('An error occurred: ' . $e->getMessage(), []);
        }
    }


    /**
     * Delete Local Guide Review api
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteReview(Request $request)
    {
        try {
            $inputs = $request->all();
            $validator = Validator::make($inputs, [
                'LocalGuideId' => 'required|integer',
                'ReviewId' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation error', $validator->errors(), 422);
            }
            $localGuide = LocalGuide::where('id', $request->LocalGuideId)->first();

            $reviewQuery = $localGuide->reviews();

            $reviewQuery->where('id', $request->ReviewId)->delete();

            return response()->json([
                'success' => true,
                'data' => [],
                'message' => 'Review Deleted successfully',
            ], 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }



}
