<?php

namespace App\Http\Controllers\AppControllers;

use App\Http\Controllers\Controller;
use App\Models\FoodItem;
use App\Models\ShoppingItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestFoodItemsController extends BaseController
{

    public $search;
    public $limit;
    public $offSet;


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
     * Food List api
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
                    'shoppingItems' => $data,
                ],
                'message' => 'Data fetched successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }

}
