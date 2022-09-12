<?php

namespace App\Http\Livewire\Settings\Vacations;

use App\Http\Livewire\Traits\Toastr;
use App\Models\Calendar;
use App\Models\Time;
use App\Models\User;
use App\Models\Vacation;
use App\Notifications\CalendarEmailNotification;
use App\Notifications\RequestToJoinCalendarNotification;
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

    public $house = null;
    public $owner = null;
    protected $queryString = [
        'house' => ['except' => null],
        'owner' => ['except' => null],
    ];

    protected $listeners = [
        'showRequestToJoinVacationModal'
    ];

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
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'string', 'max:255'],
            'start_datetime' => [
                'required',
//                new VacationSchedule($this->state['end_datetime'] ?? null, $this->user, $this->vacation)
            ],
        ], [
            'start_datetime.required' => 'The start & end datetime field is required'
        ])->validateWithBag('saveVacationSchedule');

        if (!$this->vacation->VacationId) {
            try {
                $house = $this->user->house;

                if ($house && !is_null($house->CalEmailList) && !empty($house->CalEmailList)) {

                    $CalEmailList = explode(',', $this->user->house->CalEmailList);

                    if (count($CalEmailList) > 0 && !empty($CalEmailList)) {
                        $users = User::whereIn('email', $CalEmailList)->where('HouseId', $this->user->HouseId)->get();
                        foreach ($users as $user) {
                            $user->notify(new RequestToJoinCalendarNotification($this->state['name'],$this->state['email'], $house->HouseName, $this->state['start_datetime'], $this->state['end_datetime']));
                        }
                        $CalEmailList = array_diff($CalEmailList, $users->pluck('email')->toArray());
                        if (count($CalEmailList) > 0) {
                            Notification::route('mail', $CalEmailList)
                                ->notify(new RequestToJoinCalendarNotification($this->state['name'],$this->state['email'], $house->HouseName, $this->state['start_datetime'], $this->state['end_datetime']));
                        }

                    }
                }

            } catch (Exception $e) {

            }
        } else {

            $owner = $this->vacation->VacationId && $this->vacation->owner ? $this->vacation->owner : User::where(['HouseId' => $this->user->HouseId, 'role' => User::ROLE_ADMINISTRATOR])->first();
            try {
                Mail::send([], [], function (Message $message) use ($owner) {
                    $message->to($this->state['email'])
                        ->replyTo('NoReply@theVacationCalendar.com', config('app.name'))
                        ->subject('The Vacation Calendar Vacation Request Confirmation')
                        ->Html(
                            "<div style='padding: 10px; 20px'>" .
                            "<h2>{$this->state['name']}</h2>" .
                            "<p>You have requested to join $owner->first_name $owner->last_name's vacation from {$this->state['start_datetime']} to {$this->state['end_datetime']}<p/>" .
                            "</div>", 'text/plain'
                        );
                });
            } catch (\Exception $e) {

            }

            if ($owner) {
                try {
                    Mail::send([], [], function (Message $message) use ($owner) {
                        $message->to($owner->email)
                            ->replyTo('NoReply@theVacationCalendar.com', config('app.name'))
                            ->subject('The Vacation Calendar Vacation Request')
                            ->Html(
                                "<div style='padding: 10px; 20px'>" .
                                "<h2>{$owner->first_name} {$owner->last_name},</h2>" .
                                "<p>{$this->state['name']} has requested to join your vacation from {$this->state['start_datetime']} to {$this->state['end_datetime']}<p/>" .
                                "<p>They can be reached at the following email address: {$this->state['email']}<p/>" .
                                "</div>", 'text/plain'
                            );
                    });
                } catch (\Exception $e) {

                }
            }
        }

        $this->emitSelf('toggle', false);
        $this->success('Your request to join vacation has been submitted successful.');
    }

    public function render()
    {
        return view('dash.settings.vacations.request-to-join-vacation-form');
    }
}
