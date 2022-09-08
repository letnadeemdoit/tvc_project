<?php

namespace App\Http\Controllers;

use App\Models\BlogViews;
use App\Models\Category;
use App\Models\LocalGuide;
use Illuminate\Http\Request;

class LocalGuideController extends Controller
{
    public function index(Request $request){

        return view('local-guide.index', [
            'user' => $request->user()
        ]);
    }

    public function show(Request $request, LocalGuide $dt){

//        $categories = Category::where('type', 'local-guide')->where('house_id',$dt->house_id)->withCount('localGuides')->get();
//        $localGuideCategories = Category::where('type', 'local-guide')
//            ->where(function ($query){
//                $query->where('house_id', $this->user->HouseId)
//                    ->orWhere('house_id', null);
//            })
//            ->get();

        $categories = Category::where('type', 'local-guide')
            ->where(function ($query){
                $query->where('house_id', auth()->user()->HouseId)
                    ->orWhere('house_id', null);
            })
            ->withCount(['localGuides' => function($query) {
                $query->where('house_id', auth()->user()->HouseId);
            }])
            ->get();

        $relatedGuides = LocalGuide::where('house_id', $dt->house_id)->inRandomOrder()->limit(3)->get()->except($dt->id);


        $totalReviewLocalGuide = $dt->reviews()->get();

        $sumTotalReviews = count($totalReviewLocalGuide);

        if (isset($sumTotalReviews) && $sumTotalReviews > 0) {

            $avgRating = intval($totalReviewLocalGuide->sum('rating') / $sumTotalReviews);

        }

        return view('local-guide.single-guide.show',[
            'user' => $request->user(),
            'localGuide' => $dt,
            'categories' => $categories,
            'relatedGuides' => $relatedGuides,
            'avgRating' => $avgRating ?? 0,

        ]);
    }
}
