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
    public function show(Request $request, $post) {

        $user = $request->user();
        $post = Blog::where('slug', $post)->where('HouseId', $user->HouseId)->first();

        abort_if(!$post, 404);

        $existing_views = 0;

        $blog_views = BlogViews::where('viewable_id' , $post->BlogId)->distinct(['ip_address','user_id'])->count();
        if ($blog_views){
            $existing_views = $blog_views;
        }


        $categories = Category::where('type', 'blog')->where('house_id',$user->HouseId)->withCount('blogs')->get();

        $relatedBlog = Blog::where('HouseId' , $user->HouseId)->inRandomOrder()->limit(4)->get()->except($post->BlogId);

        $blogComments = $post->comments()->count();

        $existingTags = $post->tags;

//        if(!auth()->user()->is_guest){
//            if (is_null($views)){
                $view = new BlogViews();

                $view->fill([
                    'user_id' => $user->user_id,
                    'ip_address' => $request->getClientIp()
                ]);

                $post->views()->save($view);
//            }
//        }

        return view('blog.post', [
            'user' => $request->user(),
            'post' => $post,
            'existing_views' => $existing_views,
            'categories' => $categories,
            'relatedBlog' => $relatedBlog,
            'existingTags' => $existingTags,
            'blogComments' => $blogComments

        ]);
    }

}
