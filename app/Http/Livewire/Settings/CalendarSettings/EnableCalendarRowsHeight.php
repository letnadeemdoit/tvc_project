<?php

namespace App\Http\Livewire\Settings\CalendarSettings;

use App\Models\CalendarSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class EnableCalendarRowsHeight extends Component
{

    public $user;
    public $state = [];
    public $calendarRowsHeight = null;

    public function mount()
    {
        $this->calendarRowsHeight = CalendarSetting::firstOrCreate(['house_id' => $this->user->HouseId, 'user_id' => $this->user->user_id]);
        $this->state = [
            'calendar_height' => $this->calendarRowsHeight->calendar_height === 'dynamic' ? true : false,
        ];
    }

    public function render()
    {
        return view('dash.settings.calendar-settings.enable-calendar-rows-height');
    }

    public function updateCalendarRowsHeight()
    {
        $this->resetErrorBag();

        Validator::make($this->state, [
            'calendar_height' => ['nullable', 'boolean'],
        ])->validateWithBag('updateCalendarRowsHeight');

        $data = [
            'calendar_height' => $this->state['calendar_height'] ? 'dynamic' : 'fixed',
        ];

        if (!$this->calendarRowsHeight->id) {
            $data['user_id'] = $this->user->user_id;
            $data['house_id'] = $this->user->HouseId;
        }

        $this->calendarRowsHeight->update($data);

        $this->emit('saved');
    }

}
