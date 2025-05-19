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
            'vacation_approval_email_list' => $this->house->vacation_approval_email_list,
            'blog_email_list' => $this->house->BlogEmailList,
            'request_to_use_house_email_list' => $this->house->request_to_use_house_email_list,
            'local_guide_email_list' => $this->house->local_guide_email_list,
            'guest_book_email_list' => $this->house->guest_book_email_list,
            'photo_email_list' => $this->house->photo_email_list,
            'food_item_list' => $this->house->food_item_list,
        ];

    }

    public function render()
    {
        return view('dash.settings.notifications.update-notification-preferences-form');
    }

    protected function normalizeEmailList(?string $emailList): ?string
    {
        if (empty($emailList)) {
            return $emailList;
        }

        // Trim ends and remove spaces before and after commas
        return preg_replace('/\s*,\s*/', ',', trim($emailList));
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
            'vacation_approval_email_list' => [
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
            'request_to_use_house_email_list' => [
                'nullable',
                (new Delimited('email'))
                    ->separatedBy(',')
                    ->max(50)
            ],
            'local_guide_email_list' => [
                'nullable',
                (new Delimited('email'))
                    ->separatedBy(',')
                    ->max(50)
            ],
            'guest_book_email_list' => [
                'nullable',
                (new Delimited('email'))
                    ->separatedBy(',')
                    ->max(50)
            ],
            'photo_email_list' => [
                'nullable',
                (new Delimited('email'))
                    ->separatedBy(',')
                    ->max(50)
            ],
            'food_item_list' => [
                'nullable',
                (new Delimited('email'))
                    ->separatedBy(',')
                    ->max(50)
            ],
        ])->validateWithBag('updateNotificationPreferences');

        $this->house->CalEmailList                    = $this->normalizeEmailList($this->state['calendar_email_list'] ?? null);
        $this->house->vacation_approval_email_list    = $this->normalizeEmailList($this->state['vacation_approval_email_list'] ?? null);
        $this->house->BlogEmailList                   = $this->normalizeEmailList($this->state['blog_email_list'] ?? null);
        $this->house->request_to_use_house_email_list = $this->normalizeEmailList($this->state['request_to_use_house_email_list'] ?? null);
        $this->house->local_guide_email_list          = $this->normalizeEmailList($this->state['local_guide_email_list'] ?? null);
        $this->house->guest_book_email_list           = $this->normalizeEmailList($this->state['guest_book_email_list'] ?? null);
        $this->house->photo_email_list                = $this->normalizeEmailList($this->state['photo_email_list'] ?? null);
        $this->house->food_item_list                  = $this->normalizeEmailList($this->state['food_item_list'] ?? null);
        $this->house->save();

        $this->emit('saved');
    }
}
