<?php

namespace App\Http\Livewire\Settings\Vacations;

use App\Http\Livewire\Traits\Toastr;
use App\Models\Calendar;
use App\Models\CalendarSetting;
use App\Models\GuestContact;
use App\Models\Time;
use App\Models\User;
use App\Models\Vacation;
use App\Notifications\CalendarEmailNotification;
use App\Notifications\RequestToApproveVacationEmailNotification;
use App\Notifications\RequestToJoinCalendarAdminNotification;
use App\Notifications\RequestToJoinCalendarNotification;
use App\Notifications\RequestToJoinVacationCreatorMailNotification;
use App\Notifications\RequestToJoinVacationMailNotification;
use App\Notifications\RequestToJoinVacationNotification1;
use App\Notifications\RequestToJoinVacationNotification2;
use App\Notifications\RequestToUseVacationHomeNotification1;
use App\Notifications\RequestToUseVacationHomeNotification2;
use App\Rules\VacationSchedule;
use Carbon\Carbon;
use Exception;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class RequestToJoinVacationForm extends Component
{
    use Toastr;

    public $user;

    public $state = [];
    public ?Vacation $vacation;

    public $calendarSetting = null;

    public $siteUrl = null;

    public $isGuestScheduleVacation = false;
    public $isEnableScheduleWindow = false;
    public $defaultStartDate = null;
    public $defaultEndDate = null;
    public $state_user = null;
    public $maxVacationLength = null;

    public $house = null;
    public $owner = null;
    protected $queryString = [
        'house' => ['except' => null],
        'owner' => ['except' => null],
    ];

    protected $listeners = [
//        'showRequestToJoinVacationModal'
    ];

    public function mount($vacationId, $initialDate = null) {
//        $this->emitSelf('toggle', $toggle);
        $this->reset('state');

        $this->calendarSetting = CalendarSetting::where('house_id', primary_user()->HouseId)->first();
        if($this->calendarSetting && $this->calendarSetting->enable_schedule_window === 1){
            $this->isEnableScheduleWindow = true;
            $this->defaultStartDate = $this->calendarSetting->start_datetime;
            $this->defaultEndDate = $this->calendarSetting->end_datetime;
        }
        if ($this->calendarSetting && $this->calendarSetting->allow_guest_vacations === 1){
            $this->isGuestScheduleVacation = true;
        }


        $this->vacation = Vacation::firstOrNew(['VacationID' => $vacationId]);
        if ($this->vacation->VacationId) {
            $this->state = [
                'vacation_name' => $this->vacation->VacationName,
                'start_datetime' => $this->vacation->start_datetime->format('m/d/Y H:i'),
                'end_datetime' => $this->vacation->end_datetime->format('m/d/Y H:i'),
                'start_end_datetime' => $this->vacation->start_datetime->format('m/d/Y H:i') . ' - ' . $this->vacation->end_datetime->format('m/d/Y H:i')
            ];
        } else {
            $this->state = [];

            if ($initialDate) {
                try {
                    $initialDatetime = Carbon::parse($initialDate);

//                    if ($this->calendarSetting && $this->calendarSetting->enable_schedule_window === 1) {
                    if ($this->calendarSetting && $this->calendarSetting->start_datetime) {
                        $defaultStartTime = $this->calendarSetting->start_datetime;
                        $defaultEndTime = $this->calendarSetting->end_datetime;

                        $this->state['guest_vacation'] = null;
                        $this->state['start_datetime'] = $initialDatetime->format('m/d/Y') . ' ' . $defaultStartTime->format('H:i');
                        $this->state['end_datetime'] = $initialDatetime->addDays(1)->format('m/d/Y') . ' ' . $defaultEndTime->format('H:i');
                        $this->state['start_end_datetime'] = $initialDatetime->format('m/d/Y') . ' ' . $defaultStartTime->format('H:i') . ' - ' . $initialDatetime->addDays(1)->format('m/d/Y') . ' ' . $defaultEndTime->format('H:i');
                    } else {
                        $this->state['guest_vacation'] = null;
                        $this->state['start_datetime'] = $initialDatetime->addHour(12)->format('m/d/Y H:i');
                        $this->state['end_datetime'] = $initialDatetime->format('m/d/Y H:i');
                        $this->state['start_end_datetime'] = $initialDatetime->addHour(12)->format('m/d/Y H:i') . ' - ' . $initialDatetime->format('m/d/Y H:i');
                    }
                } catch (\Exception $e) {

                }
            }
        }


        $this->dispatchBrowserEvent('rtjv-daterangepicker-update', ['startDatetime' => $this->state['start_datetime'] ?? now()->format('m/d/Y H:i'), 'endDatetime' => $this->state['end_datetime'] ?? now()->addDays(2)->format('m/d/Y H:i')]);

    }

    public function showRequestToJoinVacationModal($toggle, $vacationId, $initialDate = null)
    {
        $this->emitSelf('toggle', $toggle);
        $this->vacation = Vacation::firstOrNew(['VacationID' => $vacationId]);
        $this->reset('state');

        if ($this->vacation->VacationId) {
            $this->state = [
                'vacation_name' => $this->vacation->VacationName,
                'start_datetime' => $this->vacation->start_datetime->format('m/d/Y h:i'),
                'end_datetime' => $this->vacation->end_datetime->format('m/d/Y h:i'),
                'start_end_datetime' => $this->vacation->start_datetime->format('m/d/Y h:i') . ' - ' . $this->vacation->end_datetime->format('m/d/Y h:i')
            ];
        } else {
            $this->state = [];

            if ($initialDate) {
                try {
                    $initialDatetime = Carbon::parse($initialDate);
                    $this->state['start_datetime'] = $initialDatetime->format('m/d/Y h:i');
                    $this->state['end_datetime'] = $initialDatetime->format('m/d/Y h:i');
                    $this->state['start_end_datetime'] = $initialDatetime->format('m/d/Y h:i') . ' - ' . $initialDatetime->format('m/d/Y h:i');
                } catch (\Exception $e) {

                }
            }
        }

        $this->dispatchBrowserEvent('rtjv-daterangepicker-update', ['startDatetime' => $this->state['start_datetime'] ?? now()->format('m/d/Y h:i'), 'endDatetime' => $this->state['end_datetime'] ?? now()->addDays(2)->format('m/d/Y h:i')]);
    }

    public function sendRequestToJoinVacation()
    {
        $this->resetErrorBag();
        Validator::make($this->state, [
            'guest_vacation' => $this->isGuestScheduleVacation && !$this->vacation->VacationId ? ['required'] : ['nullable'],
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'string', 'max:255'],
            'start_datetime' => $this->isGuestScheduleVacation && !$this->vacation->VacationId ? [
                'required',
                new VacationSchedule($this->state['end_datetime'] ?? null, $this->user, $this->vacation)
            ] : ['required'],
        ], [
            'start_datetime.required' => 'The start & end datetime field is required'
        ])->validateWithBag('sendRequestToJoinVacation');

        $selectedStartDate = Carbon::parse($this->state['start_datetime']);
        $selectedEndDate = Carbon::parse($this->state['end_datetime']);

        if ($this->isGuestScheduleVacation && !$this->vacation->VacationId && $this->user->is_guest) {
            if (($this->isEnableScheduleWindow && ($selectedStartDate->gte($this->defaultStartDate) && $selectedStartDate->lte($this->defaultEndDate)) &&
                    ($selectedEndDate->gte($this->defaultStartDate) && $selectedEndDate->lte($this->defaultEndDate))) || !$this->isEnableScheduleWindow) {

                if ($this->calendarSetting && $this->calendarSetting->enable_max_vacation_length === 1) {
                    $vacationHours = $selectedStartDate->diffInHours($selectedEndDate);
                    $definedHours = $this->calendarSetting->vacation_length * 24;
                    $this->maxVacationLength = $this->calendarSetting->vacation_length;
                    if ($vacationHours > $definedHours) {
                        $this->dispatchBrowserEvent('vacation-is-outside-the-defined-length', ['data' => null]);
                        return false;
                    }
                }
                // Creating guest vacation
                $this->saveVacationSchedule();
                // End creating guest vacation

            } else {
                $this->dispatchBrowserEvent('select-relevant-vacation-dates', ['data' => null]);
            }
        } else {

            if (!$this->vacation->VacationId) {

                try {
                    $house = $this->user->house;
                    if ($house && !is_null($house->request_to_use_house_email_list) && !empty($house->request_to_use_house_email_list)) {

                        $request_to_use_house_email_list = explode(',', $this->user->house->request_to_use_house_email_list);

                        if (count($request_to_use_house_email_list) > 0 && !empty($request_to_use_house_email_list)) {
                            $users = User::whereIn('email', $request_to_use_house_email_list)->where('HouseId', $this->user->HouseId)->get();
                            foreach ($users as $user) {
                                $user->notify(new RequestToUseVacationHomeNotification1($this->state['name'], $this->state['email'], $house->HouseName, $this->state['start_datetime'], $this->state['end_datetime']));
                            }
//                            $request_to_use_house_email_list = array_diff($request_to_use_house_email_list, $users->pluck('email')->toArray());

                            if (count($request_to_use_house_email_list) > 0) {
                                Notification::route('mail', $request_to_use_house_email_list)
                                    ->notify(new RequestToUseVacationHomeNotification1($this->state['name'], $this->state['email'], $house->HouseName, $this->state['start_datetime'], $this->state['end_datetime']));

//                            $admin = User::where(['HouseId' => $this->user->HouseId, 'role' => User::ROLE_ADMINISTRATOR])->first();
//
//                                Notification::route('mail', $this->state['email'])
//                                    ->notify(new RequestToUseVacationHomeNotification1($this->state['name'], $this->state['email'], $house->HouseName, $this->state['start_datetime'], $this->state['end_datetime']));
//

                            }

                        }
                    }

                } catch (Exception $e) {

                }
            } else {

                $vacation_name = $this->state['vacation_name'];
                $house_name = $this->user->house->HouseName;

                $ccList = [];
                if (isset($this->state['email'])) {
                    $ccList[] = $this->state['email'];
                }
                $owner = $this->vacation->VacationId && $this->vacation->owner ? $this->vacation->owner : User::where(['HouseId' => $this->user->HouseId, 'role' => User::ROLE_ADMINISTRATOR])->first();
                $ccList[] = $owner->email;
                $ccList = array_unique(array_filter($ccList));
                try {
                    $this->state_user['name'] = $this->state['name'];
                    $this->state_user['email'] = $this->state['email'];
                    Notification::route('mail', $ccList)
                        ->notify(new RequestToJoinVacationNotification1($vacation_name,$ccList, $house_name, $this->state_user, $this->state['start_datetime'], $this->state['end_datetime']));

                } catch (\Exception $e) {

                }

//                if ($owner) {
//                    try {
//                        $this->state_user['email'] = $this->state['email'];
//                        $this->state_user['name'] = $this->state['name'];
//                        $this->state_user['role'] = $this->user->role;
//
//                        Notification::route('mail', $owner->email)
//                            ->notify(new RequestToJoinVacationNotification2($vacation_name, $house_name, $this->state_user, $this->state['start_datetime'], $this->state['end_datetime']));
////                    Mail::send([], [], function (Message $message) use ($owner) {
////                        $message->to($owner->email)
////                            ->replyTo('NoReply@theVacationCalendar.com', config('app.name'))
////                            ->subject('The Vacation Calendar Vacation Request')
////                            ->Html(
////                                "<div style='padding: 10px; 20px'>" .
////                                "<h2>{$owner->first_name} {$owner->last_name},</h2>" .
////                                "<p>{$this->state['name']} has requested to join your vacation from {$this->state['start_datetime']} to {$this->state['end_datetime']}<p/>" .
////                                "<p>They can be reached at the following email address: {$this->state['email']}<p/>" .
////                                "</div>", 'text/plain'
////                            );
////                    });
//                    } catch (\Exception $e) {
//
//                    }
//                }
            }

            if ($this->user->is_guest) {
                if (!$this->vacation->VacationId) {
                    return redirect()->route('guest.guest-calendar')->with('successMessage', 'Your request to use vacation home has been submitted successful.');
                } else {
                    return redirect()->route('guest.guest-calendar')->with('successMessage', 'Your request to join vacation has been submitted successful.');
                }
            } else {
                return redirect()->route('dash.calendar')->with('successMessage', 'Your request to join vacation has been submitted successful.');
            }
        }

//        $this->emitSelf('toggle', false);
//        if (!$this->vacation->VacationId) {
//            $this->success('Your request to use vacation home has been submitted successful.');
//        }else{
//            $this->success('Your request to join vacation has been submitted successful.');
//        }

    }

    public function render()
    {
        return view('dash.settings.vacations.request-to-join-vacation-form');
    }



    public function saveVacationSchedule(){

        $startDatetime = Carbon::parse($this->state['start_datetime']);
        $endDatetime = Carbon::parse($this->state['end_datetime']);

        $vacStartDate = $startDatetime->format('m-d-Y H:i');;
        $vacEndDate = $endDatetime->format('m-d-Y H:i');

        $this->syncCalendar($startDatetime, $endDatetime, $startDate, $startTime, $endDate, $endTime);

        $this->vacation->fill([
            'HouseId' => $this->user->HouseId,
            'OwnerId' => $this->user->user_id,
            'BackGrndColor' => '#CCCCCC',
            'FontColor' => '#ffffff',
            'VacationName' => $this->state['guest_vacation'],
            'recurrence' => null,
            'StartDateId' => $startDate->DateId,
            'StartTimeId' => $startTime->timeid,
            'EndDateId' => $endDate->DateId,
            'EndTimeId' => $endTime->timeid,
            'repeat_interval' => 0,
            'book_rooms' => 0,
            'is_vac_approved' => 0,
            'original_owner' => $this->user->user_id,
        ])->save();

        $guestContact = GuestContact::firstOrNew(['house_id'=> $this->user->HouseId,'guest_id'=> $this->user->user_id,'guest_email'=>$this->state['email'],'guest_vac_id' => $this->vacation->VacationId,]);
        if ($guestContact && $guestContact->id) {
            $guestContact->update(
                [
                    'guest_name' => $this->state['name'],
                ]
            );
        } else {
            $guestContact->fill([
                'guest_id' => $this->user->user_id,
                'house_id' => $this->user->HouseId,
                'guest_vac_id' => $this->vacation->VacationId,
                'guest_vac_color' => '#CCCCCC',
                'guest_name' => $this->state['name'],
                'guest_email' => $this->state['email']
            ])->save();
        }

        try {

            $currentUrl = url('/');
            $fullUrl = $currentUrl . '/settings/vacation-request-approval';

            $vacName = $this->state['guest_vacation'];
            $createdHouseName = $this->user->house->HouseName;
            $ccList = [];
            if (isset($this->state['email'])) {
                $ccList[] = $this->state['email'];
            }
            if (!is_null($this->user->house->request_to_use_house_email_list) && !empty($this->user->house->request_to_use_house_email_list)) {

                $CalEmailList = explode(',', $this->user->house->request_to_use_house_email_list);
                $CalEmailList = array_merge($CalEmailList, $ccList);
                $CalEmailList = array_unique(array_filter($CalEmailList));

                if (count($CalEmailList) > 0 && !empty($CalEmailList)) {
                    $users = User::whereIn('email', $CalEmailList)->where('HouseId', $this->user->HouseId)->get();
                    foreach ($users as $user) {
                        $user->notify(new RequestToUseVacationHomeNotification2($vacName,$ccList,$this->state['name'],$this->state['email'], $createdHouseName, $vacStartDate, $vacEndDate));
                    }
//                    $CalEmailList = array_diff($CalEmailList, $users->pluck('email')->toArray());

                    if (count($CalEmailList) > 0) {
                        Notification::route('mail', $CalEmailList)
                            ->notify(new RequestToUseVacationHomeNotification2($vacName,$ccList,$this->state['name'],$this->state['email'], $createdHouseName, $vacStartDate, $vacEndDate));
                    }

                }
            }

            if (!is_null($this->user->house->vacation_approval_email_list) && !empty($this->user->house->vacation_approval_email_list)) {

                $this->siteUrl = route('dash.settings.vacation-request-approval');

                $CalEmailList = explode(',', $this->user->house->vacation_approval_email_list);
                $CalEmailList = array_merge($CalEmailList, $ccList);
                $CalEmailList = array_unique(array_filter($CalEmailList));

                if (count($CalEmailList) > 0 && !empty($CalEmailList)) {
                    $users = User::whereIn('email', $CalEmailList)->where('HouseId', $this->user->HouseId)->get();
                    foreach ($users as $user) {
                        $user->notify(new RequestToApproveVacationEmailNotification($vacName,$this->siteUrl,$ccList,$this->state['name'],$this->state['email'], $createdHouseName, $vacStartDate, $vacEndDate));
                    }
//                    $CalEmailList = array_diff($CalEmailList, $users->pluck('email')->toArray());

                    if (count($CalEmailList) > 0) {
                        Notification::route('mail', $CalEmailList)
                            ->notify(new RequestToApproveVacationEmailNotification($vacName,$this->siteUrl,$ccList,$this->state['name'],$this->state['email'], $createdHouseName, $vacStartDate, $vacEndDate));
                    }

                }
            }




        } catch (Exception $e) {

        }

        return redirect()->route('guest.guest-calendar')->with('successMessage', 'Your vacation has been created successful.');


    }


    public function syncCalendar($startDatetime, $endDatetime, &$startDate, &$startTime, &$endDate, &$endTime)
    {
        // Start Datetime
        $startDay = $startDatetime->day;
        $startMonth = $startDatetime->month;
        $startYear = $startDatetime->year;
        $stDate = $startDatetime->format('Y-m-d');
        $stTime = $startDatetime->format('H:i');

        $startDate = Calendar::firstOrNew([
            'Day' => $startDay,
            'Month' => $startMonth,
            'Year' => $startYear,
            'RealDate' => $stDate,
        ]);

        $startTime = Time::firstOrNew([
            'time' => $stTime,
        ]);

        if (!$startDate->exists) $startDate->save();
        if (!$startTime->exists) $startTime->save();

        // End Datetime

        $endDay = $endDatetime->day;
        $endMonth = $endDatetime->month;
        $endYear = $endDatetime->year;
        $enDate = $endDatetime->format('Y-m-d');
        $enTime = $endDatetime->format('H:i');

        $endDate = Calendar::firstOrNew([
            'Day' => $endDay,
            'Month' => $endMonth,
            'Year' => $endYear,
            'RealDate' => $enDate,
        ]);

        $endTime = Time::firstOrNew([
            'time' => $enTime,
        ]);

        if (!$endDate->exists) $endDate->save();
        if (!$endTime->exists) $endTime->save();
    }




}
