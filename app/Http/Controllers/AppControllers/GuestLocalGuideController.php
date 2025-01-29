<?php

namespace App\Http\Controllers\AppControllers;

use App\Http\Controllers\Controller;
use App\Models\Blog\Blog;
use App\Models\BlogViews;
use App\Models\Category;
use App\Models\Likes;
use App\Models\LocalGuide;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
