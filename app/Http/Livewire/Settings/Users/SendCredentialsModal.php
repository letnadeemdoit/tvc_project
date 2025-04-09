<?php

namespace App\Http\Livewire\Settings\Users;

use App\Http\Livewire\Traits\Toastr;
use App\Models\House;
use App\Models\User;
use App\Notifications\SendCredentialMailNotification;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;

class SendCredentialsModal extends Component
{
    use Toastr;

    public $user;

    public $state = [];
    public $siteUrl;
    public ?User $userCU;

    public $isCreating = false;

    protected $listeners = [
        'showSendCredentialsUserCUModal'
    ];

    public function render()
    {
        return view('dash.settings.users.send-credentials-modal');
    }


    public function showSendCredentialsUserCUModal($toggle, ?User $userCU)
    {
//        if (! Gate::any(['create', 'update'], $userCU)) {
//            abort(403);
//        }

        $this->emitSelf('toggle', $toggle);
        $this->userCU = $userCU;
        $this->reset('state');

        if ($userCU->user_id) {
            $this->isCreating = false;
            $this->state = [
                'user_name' => $userCU->user_name,
                'first_name' => $userCU->first_name,
                'last_name' => $userCU->last_name,
                'email' => $userCU->email,
                'role' => $userCU->role,
            ];
        } else {
            $this->isCreating = true;
            $this->state = [
                'role' => User::ROLE_OWNER,
            ];
        }
    }


    public function sendMailUserCU()
    {
        $this->resetErrorBag();

        Validator::make($this->state, [

            'password' => ['required', 'string', 'min:8', 'max:50'],

        ])->validateWithBag('sendMailUserCU');


        try {

            if (isset($this->state['password'])) {
                $sendPasswordToMail = $this->state['password'];

                $sendmail = $this->state['email'];

                $user = User::where('email', $this->state['email'])->first();
                $house = House::where('HouseID', $user->HouseId)->first();
                $houseName = $house->HouseName;
                $houseId = $house->HouseID;
                $this->siteUrl = route('login', ['houseId' => $houseId]);

//                $this->userCU->notify(new SendCredentialMailNotification($sendPasswordToMail, $user, $houseName, $this->siteUrl));

                if ($this->userCU && $this->userCU->email) {
                    Notification::route('mail', $this->userCU->email)
                        ->notify(new SendCredentialMailNotification($sendPasswordToMail, $user, $houseName, $this->siteUrl));
                }

            }
        } catch (Exception $e) {
            Log::error('Error sending email:', [
                'message' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);
        }

        $this->emitSelf('toggle', false);

        $this->emit('user-cu-successfully');

        $this->success('Email Sent successfully');
    }



}
