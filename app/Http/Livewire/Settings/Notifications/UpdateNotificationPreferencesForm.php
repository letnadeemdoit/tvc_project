<?php

namespace App\Http\Livewire\Settings\Notifications;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Spatie\ValidationRules\Rules\Delimited;

class UpdateNotificationPreferencesForm extends Component
{
    public $user;
    public $house;

    public $state = [];

    public function mount()
    {
        $this->house = $this->user->house;

        $this->state = [
            'calendar_email_list' => $this->house->CalEmailList,
            'blog_email_list' => $this->house->BlogEmailList,
        ];

    }

    public function render()
    {
        return view('dash.settings.notifications.update-notification-preferences-form');
    }

    public function updateNotificationPreferences()
    {
        $this->resetErrorBag();

        Validator::make($this->state, [
            'calendar_email_list' => [
                'nullable',
                (new Delimited('email'))
                    ->separatedBy(',')
                    ->max(50)
            ],
            'blog_email_list' => [
                'nullable',
                (new Delimited('email'))
                    ->separatedBy(',')
                    ->max(50)
            ],
        ])->validateWithBag('updateNotificationPreferences');

        $this->house->CalEmailList = $this->state['calendar_email_list'] ?? null;
        $this->house->BlogEmailList = $this->state['blog_email_list'] ?? null;
        $this->house->save();

        $this->emit('saved');
    }
}
