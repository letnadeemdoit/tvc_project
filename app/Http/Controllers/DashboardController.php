<?php

namespace App\Http\Controllers;


use App\Models\Board;
use App\Models\GuestBook;
use App\Models\Photo\Album;
use App\Models\Photo\Photo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Utils;

class DashboardController extends Controller
{

    public function index(){

        $users= User::paginate(20);

        return view('dash.index',compact('users'));

    }


    public function blogs(){

        return view('dash.blog.display-as.index');

    }

    public function houses(){

        return view('dash.houses.index');

    }

    public function photoAlbum(){

        return view('dash.houses.photo-album.index');

    }

    public function showSingleAlbum($id){

        $album = Album::findOrFail($id);

        return view('dash.houses.photo-album.show',compact('album'));
    }


    public function bulletins(){

        return view('dash.bulletin-board.display-list.list');

    }

    public function bulletinBoard(){


        $boards = Board::where('HouseId',\Auth::user()->HouseId)->get();

        return view('dash.bulletin-board.index',compact('boards'));

    }

    public function localGuide(Request $request){

        return view('dash.local-guide.index', [
            'user' => $request->user()
        ]);

    }

    public function foodItemList(Request $request){

        return view('dash.house-items.food-item-list.index', [
            'user' => $request->user()
        ]);

    }

    public function shoppingItemList(Request $request){

        return view('dash.house-items.shopping-item-list.index', [
            'user' => $request->user()
        ]);

    }
    public function planAndPricing(Request $request){

        return view('dash.plans-and-pricing.index', [
            'user' => $request->user()
        ]);

    }

    public function photoAlbums(Request $request){

        return view('dash.houses.photo-albums.index', [
            'user' => $request->user()
        ]);

    }

    public function photos(Request $request, $id){

        $album = Album::findOrFail($id);

        return view('dash.houses.photo-albums.photos.index', [
            'album' => $album,
            'user' => $request->user()
        ]);

    }


    public function switchHouse(Request $request) {
        $user = User::where([
            'HouseId' => $request->house_id,
            'email' => auth()->user()->email,
        ])->first();

        abort_if(!$user, 500,'Sorry! unable to switch house something went wrong. Try again later.');

        auth()->loginUsingId($user->user_id);

        return redirect()->intended('/dashboard');
    }

}
