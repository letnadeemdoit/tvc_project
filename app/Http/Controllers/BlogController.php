<?php

namespace App\Http\Controllers;

use App\Models\Blog\Blog;
use App\Models\Blog\BlogComment;
use App\Models\BlogViews;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request) {
        return view('blog.index', [
            'user' => $request->user()
        ]);
    }
    public function show(Request $request, Blog $post) {

        $user = $request->user();

        $existing_views = 0;

//        $blog_views = Blog::where('HouseId' , $user->HouseId)->where('BlogId' ,$post->BlogId)->withCount('views')->first();
        $blog_views = BlogViews::where('user_id' ,$user->user_id)->where('viewable_id' ,$post->BlogId)->get();
        if (!is_null($blog_views)){
            $existing_views = count($blog_views);
        }

        $categories = Category::where('type', 'blog')->where('house_id',$user->HouseId)->withCount('blogs')->get();

        $relatedBlog = Blog::where('HouseId' , $user->HouseId)->inRandomOrder()->limit(4)->get()->except($post->BlogId);

        $existingTags = $post->tags;
//        dd($existingTags);

        $views = BlogViews::where('user_id' ,$user->user_id)->where('viewable_id' ,$post->BlogId)->first();

//        $views = Blog::where('user_id' ,$user->user_id)->where('BlogId' ,$post->BlogId)->first();

        if (is_null($views)){
            $view = new BlogViews();

            $view->fill([
                'user_id' => $user->user_id,
                'ip_address' => $request->getClientIp()
            ]);

            $post->views()->save($view);
        }

        return view('blog.post', [
            'user' => $request->user(),
            'post' => $post,
            'existing_views' => $existing_views,
            'categories' => $categories,
            'relatedBlog' => $relatedBlog,
            'existingTags' => $existingTags

        ]);
    }

}
