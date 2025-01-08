<?php

namespace App\Http\Controllers\AppControllers;

use App\Models\Blog\Blog;
use App\Models\FoodItem;
use App\Models\ShoppingItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdminFoodItemsController extends BaseController
{


    public $siteUrl;
    public $search;
    public $limit;
    public $offSet;
    public $file;



//    Food Item Section

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


            $response = [
                'success' => true,
                'data' => [
                    'foodItems' => $data,
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

            $foodItem->delete();

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


            $response = [
                'success' => true,
                'data' => [
                    'foodItems' => $data,
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
            $shoppingId = $request->id;

            $shoppingItem = ShoppingItem::find($shoppingId);

            if (!$shoppingItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Shopping Item not found or access denied.',
                ], 404);
            }

            $shoppingItem->delete();

            return response()->json([
                'success' => true,
                'message' => 'Shopping Item deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), [], 500);
        }
    }


}
