<?php

namespace App\Http\Controllers\AppControllers;

use App\Http\Controllers\Controller;
use App\Models\Blog\Blog;
use App\Models\BlogViews;
use App\Models\Category;
use App\Models\LocalGuide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestLocalGuideController extends BaseController
{
    public $siteUrl;

    public $file;

    public $category = 'all';


    /**
     * Local Guide List api
     *
     * @return \Illuminate\Http\Response
     */
    public function localGuideList(Request $request)
    {
        try {
            $user = Auth::user();
            $this->category = $request->category;

            $localGuideList = LocalGuide::where('house_id', $user->HouseId)
                ->when($this->category !== 'all', function ($query) {
                    $query->whereHas('category', function ($query) {
                        $query->where('slug', $this->category);
                    });
                })
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
            $dt = LocalGuide::where('id', $request->id)->first();

            if (!$dt){
                $response = [
                    'success' => true,
                    'data' => [],
                    'message' => 'Local Guide Not Found',
                ];
                return response()->json($response, 404);
            }


            $user = Auth::user();
            $categories = Category::where('type', 'local-guide')
                ->where(function ($query) use ($user){
                    $query->where('house_id', $user->HouseId)
                        ->orWhere('house_id', null);
                })
                ->withCount(['localGuides' => function($query) use($user){
                    $query->where('house_id', $user->HouseId);
                }])
                ->get();

            $relatedGuides = LocalGuide::where('house_id', $dt->house_id)->withCount('reviews')->inRandomOrder()->limit(3)->get()->except($dt->id);


            $totalReviewLocalGuide = $dt->reviews()->get();

            $sumTotalReviews = count($totalReviewLocalGuide);

            if (isset($sumTotalReviews) && $sumTotalReviews > 0) {

                $avgRating = intval($totalReviewLocalGuide->sum('rating') / $sumTotalReviews);

            }

            $response = [
                'success' => true,
                'data' => [
                    'user' => $user,
                    'localGuide' => $dt,
                    'categories' => $categories,
                    'relatedGuides' => $relatedGuides,
                    'avgRating' => $avgRating ?? 0,
                ],
                'message' => 'Data fetched successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }

    }


}
