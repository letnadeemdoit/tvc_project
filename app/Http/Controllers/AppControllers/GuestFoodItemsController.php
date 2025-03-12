<?php

namespace App\Http\Controllers\AppControllers;

use App\Http\Controllers\Controller;
use App\Models\FoodItem;
use App\Models\ShoppingItem;
use App\Models\User;
use App\Notifications\DeleteFoodItemEmailNotification;
use App\Notifications\FoodItemsNotification;
use App\Notifications\ShoppingItemsNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class GuestFoodItemsController extends BaseController
{

    public $search;
    public $limit;
    public $offSet;
    public $siteUrl;
    public $file;


    /**
     * Food List api
     *
     * @return \Illuminate\Http\Response
     */
    public function foodList(Request $request)
    {
        try {
            $user = Auth::user();
            $this->search = $request->search ?? '';
            $this->limit = $request->limit ?? 5;
            $this->offSet = $request->offSet ?? 0;

            $data = FoodItem::where('house_id', $user->HouseId)
                ->when($this->search !== '', function ($query) {
                    $query->where(function ($query) {
                        $query
                            ->where('name', 'LIKE', "%$this->search%");
                    });
                })
                ->with(['user' => function ($query) {
                    $query->select('user_id', 'first_name', 'last_name', 'email', 'profile_photo_path');
                }])
                ->skip($this->offSet)
                ->take($this->limit)
                ->get();

            $totalFoodItems = FoodItem::where('house_id', $user->HouseId)
                ->when($this->search !== '', function ($query) {
                    $query->where(function ($query) {
                        $query
                            ->where('name', 'LIKE', "%$this->search%");
                    });
                })
                ->count();


            $response = [
                'success' => true,
                'data' => [
                    'foodItems' => $data,
                    'totalFoodItems' => $totalFoodItems,
                ],
                'message' => 'Data fetched successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }


    /**
     * New Food api
     *
     * @return \Illuminate\Http\Response
     */
    public function createFood(Request $request)
    {
        try {

            $user = Auth::user();
            $inputs = $request->all();
            $isCreating = empty($inputs['id']);

            $foodItem = $isCreating ? new FoodItem() : FoodItem::find($inputs['id']);
            $this->file = $request->file('file');

            if ($this->file) {
                $inputs['image'] = $this->file;
            } else {
                unset($inputs['image']);
            }

            $validator = Validator::make($inputs, [
                'name' => 'required|string|max:100'
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation error', $validator->errors(), 422);
            }

            if ($isCreating) {
                $foodItem->user_id = $user->user_id;
                $foodItem->house_id = $user->HouseId;
            }

            // Format expiration_date if provided
            $inputs['expiration_date'] = !empty($inputs['expiration_date'])
                ? \Carbon\Carbon::parse($inputs['expiration_date'])->format('Y-m-d')
                : null;

            $foodItem->fill([
                'name' => $inputs['name'],
                'location' => $inputs['location'] ?? null,
                'expiration_date' => $inputs['expiration_date'] ?? null,
            ])->save();

            $foodItem->updateFile($this->file);

            // Create Food item email
            $this->siteUrl = route('guest.house-items.index');
            $ccList = [];
            if ($user && primary_user()->email !== $user->email) {
                $ccList[] = $user->email;
            }
            $items = $foodItem;
            $createdHouseName = $user->house->HouseName;

            if (!is_null($user->house->food_item_list) && !empty($user->house->food_item_list) && $isCreating) {

                $foodEmailsList = explode(',', $user->house->food_item_list);
                $foodEmailsList = array_merge($foodEmailsList, $ccList);
                $foodEmailsList = array_unique(array_filter($foodEmailsList));

                if (count($foodEmailsList) > 0 && !empty($foodEmailsList)) {

                    $users = User::whereIn('email', $foodEmailsList)->where('HouseId', $user->HouseId)->get();
                    foreach ($users as $us) {
                        $us->notify(new FoodItemsNotification($ccList,$items,$user, $this->siteUrl, $createdHouseName));
                    }

                    if (count($foodEmailsList) > 0) {
                        Notification::route('mail', $foodEmailsList)
                            ->notify(new FoodItemsNotification($ccList,$items,$user, $this->siteUrl, $createdHouseName));
                    }
                }
            }

            return response()->json([
                'success' => true,
                'data' => $foodItem,
                'message' => $isCreating ? 'Food Item created successfully' : 'Food Item updated successfully',
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error creating/updating food Item:', [
                'message' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
                'inputs' => $request->all(),
            ]);
            return $this->sendError($e->getMessage(), []);
        }

    }

    /**
     * Delete Food Item api
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyFood(Request $request)
    {
        try {
            $user = Auth::user();
            $foodId = $request->id;

            $foodItem = FoodItem::find($foodId);

            if (!$foodItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Food Item not found or access denied.',
                ], 404);
            }

            $data = $foodItem->toArray();

            $foodItem->delete();

            // Delete food item email
            $title = $data['name'];
            $createdHouseName = $user->house->HouseName;
            $isModel = 'Food Item';
            $owner = null;
            if (!empty($data['user_id'])) {
                $owner = User::where('user_id', $data['user_id'])->first();
            }
            $ccList = [];
            if ($owner && primary_user()->email !== $owner->email) {
                $ccList[] = $owner->email;
            }

            if (!is_null($user->house->food_item_list) && !empty($user->house->food_item_list)) {

                $foodItemEmailsList = explode(',', $user->house->food_item_list);
                $foodItemEmailsList = array_merge($foodItemEmailsList, $ccList);
                $foodItemEmailsList = array_unique(array_filter($foodItemEmailsList));

                if (count($foodItemEmailsList) > 0 && !empty($foodItemEmailsList)) {

                    $users = User::whereIn('email', $foodItemEmailsList)->where('HouseId', $user->HouseId)->get();
                    foreach ($users as $us) {
                        $us->notify(new DeleteFoodItemEmailNotification($ccList, $isModel, $title, $user, $createdHouseName));
                    }

                    if (count($foodItemEmailsList) > 0) {
                        Notification::route('mail', $foodItemEmailsList)
                            ->notify(new DeleteFoodItemEmailNotification($ccList, $isModel, $title, $user, $createdHouseName));
                    }
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Food Item deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), [], 500);
        }
    }




    //    Shopping Item Section
    /**
     * Shopping List api
     *
     * @return \Illuminate\Http\Response
     */
    public function shoppingList(Request $request)
    {
        try {
            $user = Auth::user();
            $this->search = $request->search ?? '';
            $this->limit = $request->limit ?? 5;
            $this->offSet = $request->offSet ?? 0;

            $data = ShoppingItem::where('house_id', $user->HouseId)
                ->when($this->search !== '', function ($query) {
                    $query->where(function ($query) {
                        $query
                            ->where('name', 'LIKE', "%$this->search%");
                    });
                })
                ->with(['user' => function ($query) {
                    $query->select('user_id', 'first_name', 'last_name', 'email', 'profile_photo_path');
                }])
                ->skip($this->offSet)
                ->take($this->limit)
                ->get();

            $totalShoppingItems = ShoppingItem::where('house_id', $user->HouseId)
                ->when($this->search !== '', function ($query) {
                    $query->where(function ($query) {
                        $query
                            ->where('name', 'LIKE', "%$this->search%");
                    });
                })
                ->count();


            $response = [
                'success' => true,
                'data' => [
                    'shoppingItems' => $data,
                    'totalShoppingItems' => $totalShoppingItems
                ],
                'message' => 'Data fetched successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }

    /**
     * New Shopping api
     *
     * @return \Illuminate\Http\Response
     */
    public function createShopping(Request $request)
    {
        try {

            $user = Auth::user();
            $inputs = $request->all();
            $isCreating = empty($inputs['id']);

            $shoppingItem = $isCreating ? new ShoppingItem() : ShoppingItem::find($inputs['id']);

            $this->file = $request->file('file');

            if ($this->file) {
                $inputs['image'] = $this->file;
            } else {
                unset($inputs['image']);
            }

            $validator = Validator::make($inputs, [
                'name' => 'required|string|max:100'
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation error', $validator->errors(), 422);
            }

            if ($isCreating) {
                $shoppingItem->user_id = $user->user_id;
                $shoppingItem->house_id = $user->HouseId;
            }

            $shoppingItem->fill([
                'name' => $inputs['name'],
                'location' => $inputs['location'] ?? null,
            ])->save();

            $shoppingItem->updateFile($this->file);


            // Create Shopping item email
            $this->siteUrl = route('guest.house-items.index');
            $ccList = [];
            if ($user && primary_user()->email !== $user->email) {
                $ccList[] = $user->email;
            }
            $items = $shoppingItem;
            $createdHouseName = $user->house->HouseName;

            if (!is_null($user->house->food_item_list) && !empty($user->house->food_item_list) && $isCreating) {

                $foodEmailsList = explode(',', $user->house->food_item_list);
                $foodEmailsList = array_merge($foodEmailsList, $ccList);
                $foodEmailsList = array_unique(array_filter($foodEmailsList));

                if (count($foodEmailsList) > 0 && !empty($foodEmailsList)) {

                    $users = User::whereIn('email', $foodEmailsList)->where('HouseId', $user->HouseId)->get();
                    foreach ($users as $us) {
                        $us->notify(new ShoppingItemsNotification($ccList,$items,$user, $this->siteUrl, $createdHouseName));
                    }

                    if (count($foodEmailsList) > 0) {
                        Notification::route('mail', $foodEmailsList)
                            ->notify(new ShoppingItemsNotification($ccList,$items,$user, $this->siteUrl, $createdHouseName));
                    }
                }
            }

            return response()->json([
                'success' => true,
                'data' => $shoppingItem,
                'message' => $isCreating ? 'Shopping Item created successfully' : 'Shopping Item updated successfully',
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error creating/updating Shopping Item:', [
                'message' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
                'inputs' => $request->all(),
            ]);
            return $this->sendError($e->getMessage(), []);
        }

    }

    public function destroyShopping(Request $request)
    {
        try {
            $user = Auth::user();
            $shoppingId = $request->id;

            $shoppingItem = ShoppingItem::find($shoppingId);

            if (!$shoppingItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Shopping Item not found or access denied.',
                ], 404);
            }

            $data = $shoppingItem->toArray();
            $shoppingItem->delete();

            // Delete Shopping item email
            $title = $data['name'];
            $createdHouseName = $user->house->HouseName;
            $isModel = 'Shopping Item';
            $owner = null;
            if (!empty($data['user_id'])) {
                $owner = User::where('user_id', $data['user_id'])->first();
            }
            $ccList = [];
            if ($owner && primary_user()->email !== $owner->email) {
                $ccList[] = $owner->email;
            }
            if (!is_null($user->house->food_item_list) && !empty($user->house->food_item_list)) {

                $foodItemEmailsList = explode(',', $user->house->food_item_list);
                $foodItemEmailsList = array_merge($foodItemEmailsList, $ccList);
                $foodItemEmailsList = array_unique(array_filter($foodItemEmailsList));

                if (count($foodItemEmailsList) > 0 && !empty($foodItemEmailsList)) {

                    $users = User::whereIn('email', $foodItemEmailsList)->where('HouseId', $user->HouseId)->get();
                    foreach ($users as $us) {
                        $us->notify(new DeleteFoodItemEmailNotification($ccList,$isModel,$title,$user,$createdHouseName));
                    }

                    if (count($foodItemEmailsList) > 0) {
                        Notification::route('mail', $foodItemEmailsList)
                            ->notify(new DeleteFoodItemEmailNotification($ccList,$isModel,$title,$user,$createdHouseName));

                    }
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Shopping Item deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), [], 500);
        }
    }





}
