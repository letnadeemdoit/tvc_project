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

        $blog_views = Blog::where('BlogId' ,$post->BlogId)->withCount('views')->first();
        $existing_views = $blog_views->views_count;


        $categories = Category::where('type', 'blog')->where('house_id',$user->HouseId)->withCount('blogs')->get();

        $relatedBlog = Blog::where('HouseId', $post->HouseId)->inRandomOrder()->limit(4)->get()->except($post->BlogId);

        $views = Blog::where('user_id' ,$post->user_id)->where('BlogId' ,$post->BlogId)->first();


        if (count($views->views) == 0){
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
            'relatedBlog' => $relatedBlog

        ]);
    }

    public function items(Category $category) {
        dd($category);
//        $data = Blog::where('category_id', $category->id)->get();
//        return view('blog.blog-list', compact('data'));
    }
}
