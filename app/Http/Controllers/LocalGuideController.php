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
//        return view('local-guide.index',compact('data'));

    }

    public function show(Request $request, LocalGuide $dt){

        $categories = Category::where('type', 'local-guide')->where('house_id',$dt->house_id)->withCount('localGuides')->get();

        $guide_views = LocalGuide::where('id' ,$dt->id)->withCount('views')->first();
        $existing_views = $guide_views->views_count;

        $relatedGuides = LocalGuide::where('house_id', $dt->house_id)->inRandomOrder()->limit(4)->get()->except($dt->id);

        $guide_views = LocalGuide::where('user_id' ,$dt->user_id)->where('id' ,$dt->id)->first();

        if (count($guide_views->views) == 0){
            $view = new BlogViews();

            $view->fill([
                'user_id' => $dt->user_id,
                'ip_address' => $request->getClientIp()
            ]);

            $dt->views()->save($view);
        }

        return view('local-guide.single-guide.show',[
            'user' => $request->user(),
            'localGuide' => $dt,
            'categories' => $categories,
            'existingViews' =>$existing_views,
            'relatedGuides' => $relatedGuides

        ]);

    }
}
