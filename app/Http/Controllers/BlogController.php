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
//        $existing_likes = 0;
//        $blog_Likes = $post->likes;
//        foreach ($blog_Likes as $like){
//            $existing_likes += $like->likes;
//        }
        $user = $request->user();
        $existing_views = 0;
        $blog_views = $post->views;
        foreach ($blog_views as $view){
            $existing_views += $view->views;
        }

        $blogcomments = BlogComment::where('BlogId', $post->BlogId )->get();
        $numberofcomments = count($blogcomments);

            $categories = Category::where('type', 'blog')->where('house_id',$user->HouseId)->withCount('blogs')->get();

        $relatedBlog = Blog::where('HouseId', $post->HouseId)->inRandomOrder()->limit(4)->get();

        $views = BlogViews::where('blog_id', $post->BlogId)->where('user_id', $user->user_id)->get();
        if (count($views) == 0){
            $view = new BlogViews();

            $view->fill([
                'user_id' => $user->user_id,
                'blog_id' => $post->BlogId,
                'views' => $existing_views+1,
            ]);

            $post->views()->save($view);
        }

        return view('blog.post', [
            'user' => $request->user(),
            'post' => $post,
//            'existing_likes' => $existing_likes,
            'existing_views' => $existing_views,
            'total_comments' => $numberofcomments,
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
