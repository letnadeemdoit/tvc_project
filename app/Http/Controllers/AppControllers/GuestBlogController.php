<?php

namespace App\Http\Controllers\AppControllers;

use App\Http\Controllers\Controller;
use App\Models\Blog\Blog;
use App\Models\BlogViews;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Likes;
use App\Models\User;
use App\Notifications\BlogNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

                    // Calculate existing views
                    $existing_views = BlogViews::where('viewable_id', $blog->BlogId)
                        ->distinct(['ip_address', 'user_id'])
                        ->count();
                    $blog->views_count = $existing_views;

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

            $slug = $request->slug;
            $order = $request->order ?? 'desc';
            $user = Auth::user();

            $post = Blog::where('slug', $slug)->where('HouseId', $user->HouseId)
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
            $post->views_count = BlogViews::where('viewable_id', $post->BlogId)->distinct(['ip_address', 'user_id'])->count();

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


    /**
     * Like Blog api
     *
     * @return \Illuminate\Http\Response
     */
    public function likeBlog(Request $request)
    {
        try {
            $user = Auth::user();
            $inputs = $request->all();

            $validator = Validator::make($inputs, [
                'BlogId' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation error', $validator->errors(), 422);
            }
            $blog = Blog::where('BlogId', $request->BlogId)->first();

            if (!$blog) {
                return response()->json([
                    'success' => false,
                    'data' => [],
                    'message' => 'Blog not found',
                ], 404);
            }

            // Check if the user has already liked the blog
            $existingLike = Likes::where('user_id', $user->user_id)
                ->where('likeable_id', $blog->BlogId)
                ->first();

            if ($existingLike) {
                $existingLike->delete();
                $message = 'Like removed successfully';
            } else {
                $like = new Likes();
                $like->fill([
                    'user_id' => $user->user_id,
                    'ip_address' => $request->getClientIp(),
                    'likes' => 1,
                ]);
                $blog->likes()->save($like);
                $message = 'Like created successfully';
            }

            return response()->json([
                'success' => true,
                'data' => [],
                'message' => $message,
            ], 200);

        } catch (\Exception $e) {
            return $this->sendError('An error occurred: ' . $e->getMessage(), []);
        }
    }


    /**
     * Blog Comment api
     *
     * @return \Illuminate\Http\Response
     */
    public function addBlogComment(Request $request)
    {
        try {
            $user = Auth::user();
            $inputs = $request->all();
            $validator = Validator::make($inputs, [
                'BlogId' => 'required|integer',
                'Content' => 'required|max:255',
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation error', $validator->errors(), 422);
            }
            $blog = Blog::where('BlogId', $request->BlogId)->first();

            if (!$blog){
                $response = [
                    'success' => true,
                    'data' => [],
                    'message' => 'Blog Not Found',
                ];
                return response()->json($response, 404);
            }
            $comment = new Comment();
            $comment->fill([
                'user_id' => $user->user_id,
                'house_id' => $user->HouseId,
                'message' => $inputs['Content'] ?? null,
            ]);
            $blog->comments()->save($comment);
            // Load the associated user for the comment
            $comment->load('user:user_id,first_name,last_name,email,profile_photo_path');

            return response()->json([
                'success' => true,
                'data' => [
                    'comment' => $comment
                ],
                'message' => 'Comment created successfully',
            ], 200);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }


    /**
     * Delete Blog Comment api
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteBlogComment(Request $request)
    {
        try {
            $inputs = $request->all();
            $validator = Validator::make($inputs, [
                'BlogId' => 'required|integer',
                'CommentId' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation error', $validator->errors(), 422);
            }
            $blog = Blog::where('BlogId', $request->BlogId)->first();

            $commentsQuery = $blog->comments();

            $commentsQuery->where('id', $request->CommentId)->delete();

            return response()->json([
                'success' => true,
                'data' => [],
                'message' => 'Comment Deleted successfully',
            ], 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }

}
