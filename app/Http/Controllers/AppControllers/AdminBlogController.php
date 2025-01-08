<?php

namespace App\Http\Controllers\AppControllers;

use App\Http\Controllers\AppControllers\BaseController as BaseController;
use App\Models\BlogViews;
use App\Models\Likes;
use Illuminate\Support\Facades\Log;
use App\Models\Blog\Blog;
use App\Models\Category;
use App\Models\User;
use App\Notifications\BlogNotification;
use App\Notifications\DeleteBlogEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminBlogController extends BaseController
{

    public $siteUrl;
    public $category;
    public $limit;
    public $offSet;
    public $file;


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

            $blogList = Blog::where('HouseId', $user->HouseId)
                ->when($user->is_owner_only, function ($query) use ($user) {
                    $query->where('user_id', $user->user_id);
                })
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

            $blogCategories = Category::where('type', 'blog')
                ->where('house_id', $user->HouseId)
                ->get();

            $totalBlogs = Blog::where('HouseId', $user->HouseId)
                ->when($user->is_owner_only, function ($query) use ($user) {
                    $query->where('user_id', $user->user_id);
                })
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
                    'totalBlogs' => $totalBlogs,
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
     * New Blog api
     *
     * @return \Illuminate\Http\Response
     */
    public function createBlog(Request $request)
    {
        try {

            $user = Auth::user();
            $date = date('Y/m/d H:i:s');
            $inputs = $request->all();
            $isCreating = empty($inputs['BlogId']);

            $blogItem = $isCreating ? new Blog() : Blog::find($inputs['BlogId']);
            $this->file = $request->file('file');

            if ($this->file) {
                $inputs['image'] = $this->file;
            } else {
                unset($inputs['image']);
            }

            $validator = Validator::make($inputs, [
                'Subject' => [
                    'required', 'string', 'max:100',
                    $isCreating ? Rule::unique('Blog')->where(function ($query) use ($user) {
                        return $query->where('HouseId', $user->HouseId);
                    }) : '',
                ],
                'image' => 'nullable|mimes:png,jpg,gif,tiff',
                'Contents' => 'required|max:4000000000',
                'is_public' => 'nullable|boolean',
                'category_id' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation error', $validator->errors(), 422);
            }

            if ($isCreating) {
                $blogItem->user_id = $user->user_id;
                $blogItem->HouseId = $user->HouseId;
                $blogItem->Author = $user->first_name . " " . $user->last_name;
                $blogItem->BlogDate = $date;
                $blogItem->Audit_user_name = $user->Audit_user_name;
                $blogItem->Audit_Role = $user->Audit_Role;
                $blogItem->Audit_FirstName = $user->Audit_FirstName;
                $blogItem->Audit_LastName = $user->Audit_LastName;
                $blogItem->Audit_Email = $user->Audit_Email;
            }
            $slug = Str::slug($inputs['Subject']);
            $blogItem->fill([
                'Subject' => $inputs['Subject'],
                'Contents' => $inputs['Contents'] ?? '',
                'category_id' => $inputs['category_id'] ?? null,
                'slug' => $slug,
            ])->save();

            $blogItem->updateFile($this->file);




//            $this->siteUrl = route('guest.blog.show', $slug);
            $this->siteUrl = '';

            $items = $blogItem;
            $createdHouseName = $user->house->HouseName;
            $blogUrl = $this->siteUrl;
            $ccList = [];
            if ($user) {
                $ccList[] = $user->email;
            }

            if (!is_null($user->house->BlogEmailList) && !empty($user->house->BlogEmailList) && $isCreating) {

//                $blogEmailsList = explode(',', $user->house->BlogEmailList);
//                if (count($blogEmailsList) > 0 && !empty($blogEmailsList)) {
//                    $users = User::whereIn('email', $blogEmailsList)->where('HouseId', $user->HouseId)->get();
//
//                    foreach ($users as $us) {
//                        $us->notify(new BlogNotification($ccList,$items, $blogUrl, $user, $createdHouseName));
//                    }
////                Notification::send($users, new BlogNotification($items,$blogUrl,$createdHouseName));
//                    $blogEmailsList = array_diff($blogEmailsList, $users->pluck('email')->toArray());
//                    if (count($blogEmailsList) > 0) {
//                        Notification::route('mail', $blogEmailsList)
//                            ->notify(new BlogNotification($ccList,$items, $blogUrl, $user, $createdHouseName));
//                    }
//                }
            }


            return response()->json([
                'success' => true,
                'data' => $blogItem,
                'message' => $isCreating ? 'Blog created successfully' : 'Blog updated successfully',
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error creating/updating blog:', [
                'message' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
                'inputs' => $request->all(),
            ]);
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



    public function destroy(Request $request)
    {
        try {
            $user = Auth::user();
            $blogId = $request->id;

            // Find the blog by ID and ensure it belongs to the user's house
            $blog = Blog::find($blogId);

            if (!$blog) {
                return response()->json([
                    'success' => false,
                    'message' => 'Blog not found or access denied.',
                ], 404);
            }

            $blog->delete();
            $data = $blog->toArray();
            $title = $data['Subject'];
            $createdHouseName = $user->house->HouseName;

            $owner = null;
            if (!empty($data['user_id'])) {
                $owner = User::where('user_id', $data['user_id'])->first();
            }
            $ccList = [];
            if ($owner && $owner->email) {
                $ccList[] = $owner->email;
            }

//
//            if (!is_null($user->house->BlogEmailList) && !empty($user->house->BlogEmailList)) {
//
//                $blogEmailsList = explode(',', $user->house->BlogEmailList);
//
//                if (count($blogEmailsList) > 0 && !empty($blogEmailsList)) {
//
//                    $users = User::whereIn('email', $blogEmailsList)->where('HouseId', $user->HouseId)->get();
//
//                    foreach ($users as $user) {
//                        $user->notify(new DeleteBlogEmailNotification($ccList, $title, $user, $createdHouseName));
//                    }
//
//                    $blogEmailsList = array_diff($blogEmailsList, $users->pluck('email')->toArray());
//
//                    if (count($blogEmailsList) > 0) {
//
//                        Notification::route('mail', $blogEmailsList)
//                            ->notify(new DeleteBlogEmailNotification($ccList, $title, $user, $createdHouseName));
//
//                    }
//                }
//            }


            return response()->json([
                'success' => true,
                'message' => 'Blog deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), [], 500);
        }
    }


}
