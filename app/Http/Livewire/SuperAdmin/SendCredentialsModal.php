<?php

namespace App\Http\Livewire\SuperAdmin;

use App\Http\Livewire\Traits\Toastr;
use App\Models\User;
use App\Notifications\SendCredentialMailNotification;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;


class SendCredentialsModal extends Component
{
    use Toastr;

    public $user;

    public $state = [];

    public ?User $userCU;

    public $isCreating = false;

    protected $listeners = [
        'showSendCredentialsUserCUModal'
    ];

    public function render()
    {
        return view('dash.super-admin.send-credentials-modal');
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

            'password' => ['required', 'string','min:8' ,'max:50'],

        ])->validateWithBag('sendMailUserCU');

        if (isset($this->state['password'])) {
            $sendPasswordToMail = $this->state['password'];

            $userDetails = $this->state;

            $sendmail = $this->state['email'];

            $this->userCU->notify(new SendCredentialMailNotification($sendmail,$sendPasswordToMail,$userDetails));

        }

        $this->emitSelf('toggle', false);

        $this->emit('user-cu-successfully');

        $this->success( 'Email Sent successfully');
    }



}
