<?php

namespace App\Http\Controllers;


use App\Models\Board;
use App\Models\GuestBook;
use App\Models\Photo\Album;
use App\Models\Photo\Photo;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Utils;

class DashboardController extends Controller
{

    public function index()
    {
        $users = User::paginate(20);
        return view('dash.index', compact('users'));

    }

    public function calendar(Request $request)
    {
        abort_if(!is_any_subscribed(), 403);
        return view('dash.calendar.index', [
            'user' => $request->user(),
            'iCalUrl' => $request->user()->iCalUrl(),
        ]);
    }

    public function blogs()
    {
        return view('dash.blog.display-as.index');
    }

    public function houses()
    {
        return view('dash.houses.index');
    }

    public function photoAlbum()
    {
        return view('dash.houses.photo-album.index');
    }

    public function showSingleAlbum($id)
    {
        $album = Album::findOrFail($id);
        return view('dash.houses.photo-album.show', compact('album'));
    }


    public function bulletins()
    {
        return view('dash.bulletin-board.display-list.list');
    }

    public function bulletinBoard()
    {
        $boards = Board::where('HouseId', \Auth::user()->HouseId)->get();
        return view('dash.bulletin-board.index', compact('boards'));

    }

    public function localGuide(Request $request)
    {
        abort_if($request->user()->is_guest  || !is_any_subscribed(), 403);
        return view('dash.settings.local-guide.index', [
            'user' => $request->user()
        ]);

    }

    public function notifications(Request $request)
    {
        $data = $request->user()->unreadNotifications()->paginate(10);

        return view('dash.notifications.index', [
            'user' => $request->user(),
            'data' => $data
        ]);

    }

    public function markAsReadSingleNotification(Request $request, $id)
    {

        $d = DB::table('notifications')->where('id', $id)->update(['read_at' => now()]);

        return back();
    }

    public function markAsReadNotifications(Request $request)
    {
        $d = DB::table('notifications')->update(['read_at' => now()]);
        return back();
    }

    public function foodItemList(Request $request)
    {
        abort_if($request->user()->is_guest  || !is_any_subscribed(), 403);
        return view('dash.house-items.food-item-list.index', [
            'user' => $request->user()
        ]);

    }


    public function shoppingItemList(Request $request)
    {
        abort_if($request->user()->is_guest  || !is_any_subscribed(), 403);
        return view('dash.house-items.shopping-item-list.index', [
            'user' => $request->user()
        ]);

    }

    public function planAndPricing(Request $request)
    {
        abort_if(!$request->user()->is_admin ||  ($request->user()->is_admin && !$request->user()->primary_account), 403);
        return view('dash.plans-and-pricing.index', [
            'user' => $request->user()
        ]);

    }

    public function photoAlbums(Request $request)
    {
        abort_if($request->user()->is_guest || !is_any_subscribed(), 403);
        return view('dash.houses.photo-albums.index', [
            'user' => $request->user()
        ]);

    }

    public function photos(Request $request, $id)
    {
        $album = Album::findOrFail($id);
        return view('dash.houses.photo-albums.photos.index', [
            'album' => $album,
            'user' => $request->user()
        ]);

    }

    public function switchHouse(Request $request)
    {
        $user = User::where([
            'HouseId' => $request->house_id,
            'email' => auth()->user()->email,
        ])->first();

        abort_if(!$user, 500, 'Sorry! unable to switch house something went wrong. Try again later.');

        auth()->loginUsingId($user->user_id);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function manageBulletinBoard(Request $request)
    {
        abort_if(!$request->user()->is_admin, 403);
        return view('dash.settings.bulletin-board.index', [
            'user' => $request->user()
        ]);
    }

    public function guestBook(Request $request)
    {
        abort_if(!$request->user()->is_admin, 403);
        return view('dash.settings.guest-book.index', [
            'user' => $request->user()
        ]);
    }

}
