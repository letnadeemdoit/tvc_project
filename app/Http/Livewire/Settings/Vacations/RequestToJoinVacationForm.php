<?php

namespace App\Http\Livewire\Settings\Vacations;

use App\Http\Livewire\Traits\Toastr;
use App\Models\Calendar;
use App\Models\Time;
use App\Models\User;
use App\Models\Vacation;
use App\Notifications\CalendarEmailNotification;
use App\Rules\VacationSchedule;
use Carbon\Carbon;
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
                'start_end_datetime' => $this->vacation->start_datetime->format('m/d/Y h:i') .' - '.$this->vacation->end_datetime->format('m/d/Y h:i')
            ];
        } else {
            $this->state = [];

            if ($initialDate) {
                try {
                    $initialDatetime = Carbon::parse($initialDate);
                    $this->state['start_datetime'] = $initialDatetime->format('m/d/Y h:i');
                    $this->state['end_datetime'] = $initialDatetime->format('m/d/Y h:i');
                    $this->state['start_end_datetime'] = $initialDatetime->format('m/d/Y h:i') . ' - ' .$initialDatetime->format('m/d/Y h:i');
                } catch (\Exception $e) {

                }
            }
        }
    }

    public function sendRequestToJoinVacation()
    {
        $this->resetErrorBag();

        Validator::make($this->state, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'string', 'max:255'],
            'start_datetime' => ['required', new VacationSchedule($this->state['end_datetime'] ?? null, $this->user, $this->vacation)],
        ], [
            'start_datetime.required' => 'The start & end datetime field is required'
        ])->validateWithBag('saveVacationSchedule');

        $owner = $this->vacation->owner ?? new User();
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

        if ($this->vacation->owner) {
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

        $this->emitSelf('toggle', false);
        $this->success('Your request to join vacation has been submitted successful.');
    }

    public function render()
    {
        return view('dash.settings.vacations.request-to-join-vacation-form');
    }
}
