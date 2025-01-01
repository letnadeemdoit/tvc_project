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

    public $category;
    public $limit;
    public $offSet;


    /**
     * Blog List api
     *
     * @return \Illuminate\Http\Response
     */
    public function blogList(Request $request)
    {
        try {
            $user = Auth::user();
            $this->category = $request->category ?? 'all';
            $this->limit = $request->limit ?? 5;
            $this->offSet = $request->offSet ?? 0;

            // Fetch the paginated blog list
            $blogList = Blog::where('HouseId', $user->HouseId)
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
                ->withCount('comments', 'likes')
                ->orderBy('BlogId', 'DESC')
                ->get()
                ->map(function ($blog) use ($user) {
                    $blog->is_liked = $blog->isLikedBy($user->user_id);
                    return $blog;
                });

//             Fetch the blog categories
            $blogCategories = Category::where('type', 'blog')
                ->where('house_id', $user->HouseId)
                ->get();

            $totalBlogs = Blog::where('HouseId', $user->HouseId)
                ->when($this->category !== 'all', function ($query) {
                    $query->whereHas('category', function ($query) {
                        $query->where('slug', $this->category);
                    });
                })
                ->count();

            $response = [
                'success' => true,
                'data' => [
                    'Blogs' => $blogList,
                    'blogCategories' => $blogCategories,
                    'totalBlogs' => $totalBlogs,
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
            $order = 'desc';
            $user = Auth::user();

            $post = Blog::where('slug', $post)->where('HouseId', $user->HouseId)
                ->with([
                    'user' => function ($query) {
                        $query->select('user_id', 'first_name', 'last_name','profile_photo_path');
                    },
                    'comments' => function ($query) use ($order){
                        $query->orderBy('created_at', $order)
                        ->with([
                            'user' => function ($query) {
                                $query->select('user_id', 'first_name', 'last_name', 'profile_photo_path');
                            }
                        ]);
                    }
                ])
                ->withCount('comments', 'likes')
                ->first();

            if (!$post){
                $response = [
                    'success' => true,
                    'data' => [],
                    'message' => 'Blog Not Found',
                ];
                return response()->json($response, 404);
            }

            $post->is_liked = $post->isLikedBy($user->user_id);
            $relatedBlog = Blog::where('HouseId', $user->HouseId)->inRandomOrder()->limit(4)->get()->except($post->BlogId);

            $view = new BlogViews();

            $view->fill([
                'user_id' => $user->user_id,
                'ip_address' => $request->getClientIp()
            ]);

            $post->views()->save($view);

            $response = [
                'success' => true,
                'data' => [
                    'post' => $post,
                    'relatedBlog' => $relatedBlog,
                ],
                'message' => 'Data fetched successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }

    }


}
