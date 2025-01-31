<?php

namespace App\Http\Controllers;


use App\Models\Board;
use App\Models\CalendarSetting;
use App\Models\GuestBook;
use App\Models\Photo\Album;
use App\Models\Photo\Photo;
use App\Models\User;
use App\Notifications\DeleteVacationRoomEmailNotification;
use Cookie;
use App\Models\Vacation;
use App\Models\VacationRoom;
use App\Notifications\DeleteNotification;
use App\Notifications\DeleteVacationNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Utils;
use function PHPUnit\Framework\assertFalse;

class DashboardController extends Controller
{

    public ?Vacation $vacation;

    public $startDatetimeOfDelVacation;

    public $endDatetimeOfDelVacation;

    public $startDatetimeOfDelRoom;
    public $endDatetimeOfDelRoom;

    public function index()
    {
        $users = User::paginate(20);
        return view('dash.index', compact('users'));

    }

    public function scheduleVacation(Request $request){
        if ($request->query('Vacation_Id') && $request->query('isRoom')){
            $vacationId = $request->query('Vacation_Id');
            $currentVacation = Vacation::where('VacationID' ,$vacationId)->first();
            $start_datetime = $currentVacation->start_datetime;
            Session::put('setVacationId', $vacationId);
            Session::put('startDatetimeVacation', $start_datetime);
            return redirect()->route('dash.calendar');
        }
        $vacationId = $request->query('vacationId');
        $initialDate = $request->query('initialDate');
        $owner = $request->query('owner');
        $vacationListRoute = $request->query('vacationListRoute');
        $this->vacation = Vacation::firstOrNew(['VacationID' => $vacationId]);
        if ($this->vacation->VacationName && !$request->user()->is_admin) {
            if ($this->vacation->OwnerId !== $request->user()->user_id) {
                return redirect()->route('dash.request-to-join-vacation', ['vacationId' => $vacationId, 'initialDate' => null]);
            }
        }
        return view('dash.settings.vacations.schedule-vacation.schedule-vacation', [
            'vacationId' => $vacationId,
            'initialDate' => $initialDate,
            'owner' => $owner,
            'vacationListRoute' => $vacationListRoute,
            'user' => $request->user(),
        ]);
    }

    public function scheduleVacationRoom(Request $request){
        $roomId = $request->query('roomId');
        $vacationRoomId = $request->query('vacationRoomId');
        $initialDate = $request->query('initialDate');
        $owner = $request->query('owner');
        return view('dash.settings.vacations.schedule-vacation.schedule-vacation-room', [
            'roomId' => $roomId,
            'vacationRoomId' => $vacationRoomId,
            'initialDate' => $initialDate,
            'owner' => $owner,
            'user' => $request->user(),
        ]);
    }
    public function requestToJoinVacation(Request $request){
        $vacationId = $request->query('vacationId');
        $initialDate = $request->query('initialDate');
//        $this->vacation = Vacation::firstOrNew(['VacationID' => $vacationId]);
//
//        if ($request->user()->is_guest && (is_null($this->vacation)) || !is_null($this->vacation) && !$this->vacation->VacationId) {
//            return redirect()->route('guest.guest-request-to-join-vacation', ['vacationId' => $vacationId, 'initialDate' => null]);
//        }
        return view('dash.settings.vacations.schedule-vacation.request-to-join-vacation', [
            'vacationId' => $vacationId,
            'initialDate' => $initialDate,
            'user' => $request->user(),
        ]);
    }

    public function scheduleCalendarTask(Request $request){
        $vacationId = $request->query('vacationId');

        return view('dash.settings.vacations.schedule-vacation.schedule-informational-entries', [
            'vacationId' => $vacationId,
            'user' => $request->user(),
        ]);
    }

    public function calendar(Request $request)
    {
//        return view('emails.calendar_email_notification', [
//            'createdHouseName' => 'WWWWWW',
//        ]);

        //Function to save HouseId and User Role into cookies
        $this->setHouseInCookie();

        if (\auth()->user()->is_guest){
            return redirect(route('guest.guest-calendar'));
        }
        abort_if(!is_any_subscribed(), 403);
        if ($request->query('VacationName') && $request->query('VacationId'))
        {
            if (session()->has('startDatetimeOfVacation')) {
                $this->startDatetimeOfDelVacation = session()->get('startDatetimeOfVacation');
                session()->forget('startDatetimeOfVacation');
            }
            if (session()->has('endDatetimeOfVacation')) {
                $this->endDatetimeOfDelVacation = session()->get('endDatetimeOfVacation');
                session()->forget('endDatetimeOfVacation');
            }
            $vac_owner = User::where('user_id', $request->query('OwnerId'))->first();
            Vacation::where('parent_id', $request->query('VacationId'))->delete();
            $name = $request->query('VacationName');
            try {
                $user = Auth::user();
                $createdHouseName = $user->house->HouseName;
                Session::put('vacHouseName', $createdHouseName);
                $isAction = 'Deleted';
                $isModal = 'Vacation';
                $ccList = [];
                $ccList[] = $user->email;
                if (!is_null($vac_owner)) {
                    $ccList[] = $vac_owner->email;
                }


                if (!is_null($user->house->CalEmailList) && !empty($user->house->CalEmailList)) {
                    $CalEmailList = explode(',', $user->house->CalEmailList);
                    if (count($CalEmailList) > 0 && !empty($CalEmailList)) {
//                        $users = User::whereIn('email', $CalEmailList)->where('HouseId', $user->HouseId)->get();
//                        foreach ($users as $us) {
//                            $us->notify(new DeleteVacationNotification($name,$user,$vac_owner,$ccList,$this->startDatetimeOfDelVacation,$this->endDatetimeOfDelVacation, $isAction,$createdHouseName,$isModal));
//                        }
//                        $CalEmailList = array_diff($CalEmailList, $users->pluck('email')->toArray());
                        if (count($CalEmailList) > 0) {
                            Notification::route('mail', $CalEmailList)
                                ->notify(new DeleteVacationNotification($name,$user,$vac_owner,$ccList,$this->startDatetimeOfDelVacation,$this->endDatetimeOfDelVacation, $isAction,$createdHouseName,$isModal));
                        }
                    }
                }
                return redirect()->route('dash.calendar')->with('successMessage', 'Your vacation has been deleted successfully.');
                $this->vacation = null;
            } catch (Exception $e) {

            }
        }
        if ($request->query('RoomId') && $request->query('VacationId'))
        {
            try {
                Session::put('startDatetimeForDeleteRoom', $request->query('SetStartDate'));

                if (session()->has('startDatetimeOfRoom')) {
                    $this->startDatetimeOfDelRoom = session()->get('startDatetimeOfRoom');
                    session()->forget('startDatetimeOfRoom');
                }
                if (session()->has('endDatetimeOfRoom')) {
                    $this->endDatetimeOfDelRoom = session()->get('endDatetimeOfRoom');
                    session()->forget('endDatetimeOfRoom');
                }
                $vacation = Vacation::where('VacationId', $request->query('VacationId'))->first();


                $user = Auth::user();
                $createdHouseName = $user->house->HouseName;

                if (!is_null($user->house->CalEmailList) && !empty($user->house->CalEmailList)) {
                    $CalEmailList = explode(',', $user->house->CalEmailList);
                    if (count($CalEmailList) > 0 && !empty($CalEmailList)) {
//                        $users = User::whereIn('email', $CalEmailList)->where('HouseId', $user->HouseId)->get();
//                        foreach ($users as $user) {
//                            $user->notify(new DeleteVacationRoomEmailNotification($createdHouseName,$vacation['VacationName'],$user,$this->startDatetimeOfDelRoom,$this->endDatetimeOfDelRoom));
//                        }
//                        $CalEmailList = array_diff($CalEmailList, $users->pluck('email')->toArray());
                        if (count($CalEmailList) > 0) {
                            Notification::route('mail', $CalEmailList)
                                ->notify(new DeleteVacationRoomEmailNotification($createdHouseName,$vacation['VacationName'],$user,$this->startDatetimeOfDelRoom,$this->endDatetimeOfDelRoom));
                        }
                    }
                }
                return redirect()->route('dash.calendar')->with('successMessage', 'Your vacation room has been deleted successfully.');
                $this->vacation = null;
            } catch (Exception $e) {

            }
        }


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
//        abort_if(!$request->user()->is_admin ||  ($request->user()->is_admin && !$request->user()->primary_account), 403);
        abort_if(!$request->user()->is_admin, 403);
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
//        abort_if(!$user, 500, 'Sorry! unable to switch house something went wrong. Try again later.');
        //Modified
        if (auth()->user()->role === 'Owner') {
            $new_user = User::where([
                'parent_id' => auth()->user()->parent_id,
                'HouseId' => $request->house_id,
                'email' => auth()->user()->email,
                'role' => 'Owner'
            ])->first();
            auth()->loginUsingId($new_user->user_id);
            return redirect()->intended(RouteServiceProvider::HOME)->cookie(cookie()->forget('switched_from_primary_account'));
        }
        else{
            //Origional
            auth()->loginUsingId($user->user_id);

            if (auth()->loginUsingId($user->user_id)->primary_account == 0){
                return redirect()->intended(RouteServiceProvider::HOME)->withCookie(cookie('switched_from_primary_account', 'yes', 120));
            }else{
                return redirect()->intended(RouteServiceProvider::HOME)->cookie(cookie()->forget('switched_from_primary_account'));
            }
        }
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


    public function manageBlog(Request $request)
    {
        abort_if($request->user()->is_guest, 403);
        return view('dash.settings.blog.index', [
            'user' => $request->user()
        ]);
    }

    public function setHouseInCookie()
    {
        $user = Auth::user();
        $lifetime = time() + 60 * 60 * 24 * 30; // 30 days
        Cookie::queue('house_id', $user->HouseId, $lifetime);
        Cookie::queue('user_role', $user->role, $lifetime);

    }

}
