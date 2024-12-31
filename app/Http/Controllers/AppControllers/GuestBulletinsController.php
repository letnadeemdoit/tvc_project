<?php

namespace App\Http\Controllers\AppControllers;

use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\Category;
use App\Models\LocalGuide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestBulletinsController extends BaseController
{

    public $category = 'all';

    public $order = 'desc';


    /**
     * Bulletins List api
     *
     * @return \Illuminate\Http\Response
     */
    public function bulletinList(Request $request)
    {
        try {
            $user = Auth::user();
            $this->category = $request->category;
            $this->order = $request->order;

            $data = Board::where('HouseId', $user->HouseId)
                ->when($this->category !== 'all', function ($query) {
                    $query->whereHas('category', function ($query) {
                        $query->where('slug', $this->category);
                    });
                })
                ->orderBy('id', $this->order)
                ->get();

            $bulletinsCategories = Category::where('type', 'bulletin-board')->where('house_id', $user->HouseId)->get();

            $response = [
                'success' => true,
                'data' => [
                    'bulletins' => $data,
                    'bulletinsCategories' => $bulletinsCategories,
                ],
                'message' => 'Data fetched successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }


}
