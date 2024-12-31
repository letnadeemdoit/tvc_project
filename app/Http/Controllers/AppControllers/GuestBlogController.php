<?php

namespace App\Http\Controllers\AppControllers;

use App\Http\Controllers\Controller;
use App\Models\Blog\Blog;
use App\Models\BlogViews;
use App\Models\Category;
use App\Models\User;
use App\Notifications\BlogNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class GuestBlogController extends BaseController
{
    public $siteUrl;

    public $file;

    public $category = 'all';


    /**
     * Blog List api
     *
     * @return \Illuminate\Http\Response
     */
    public function blogList(Request $request)
    {
        try {
            $user = Auth::user();
            $this->category = $request->category;

            $blogList = Blog::where('HouseId', $user->HouseId)
                ->when($this->category !== 'all', function ($query) {
                    $query->whereHas('category', function ($query) {
                        $query->where('slug', $this->category);
                    });
                })
                ->orderBy('BlogId', 'DESC')
                ->get();

            $blogCategories = Category::where('type', 'blog')
                ->where('house_id', $user->HouseId)
                ->get();

            $response = [
                'success' => true,
                'data' => [
                    'Blogs' => $blogList,
                    'blogCategories' => $blogCategories,
                ],
                'message' => 'Data fetched successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }


    /**
     * Blog Detail api
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        try {

            $post = $request->slug;
            $user = Auth::user();

            $post = Blog::where('slug', $post)->where('HouseId', $user->HouseId)->first();
            if (!$post){
                $response = [
                    'success' => true,
                    'data' => [],
                    'message' => 'Blog Not Found',
                ];
                return response()->json($response, 404);
            }

            $existing_views = 0;

            $blog_views = BlogViews::where('viewable_id', $post->BlogId)->distinct(['ip_address', 'user_id'])->count();
            if ($blog_views) {
                $existing_views = $blog_views;
            }


            $categories = Category::where('type', 'blog')->where('house_id', $user->HouseId)->withCount('blogs')->get();

            $relatedBlog = Blog::where('HouseId', $user->HouseId)->inRandomOrder()->limit(4)->get()->except($post->BlogId);

            $blogComments = $post->comments()->count();


            $view = new BlogViews();

            $view->fill([
                'user_id' => $user->user_id,
                'ip_address' => $request->getClientIp()
            ]);

            $post->views()->save($view);

            $response = [
                'success' => true,
                'data' => [
                    'user' => $user,
                    'post' => $post,
                    'existing_views' => $existing_views,
                    'categories' => $categories,
                    'relatedBlog' => $relatedBlog,
                    'blogComments' => $blogComments
                ],
                'message' => 'Data fetched successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }

    }


}
