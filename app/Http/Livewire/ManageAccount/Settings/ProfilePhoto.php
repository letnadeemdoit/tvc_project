<?php

namespace App\Http\Livewire\ManageAccount\Settings;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfilePhoto extends Component
{
    use WithFileUploads;

    public $user;
    public $photo;

    public function render()
    {
        return view('dash.manage-account.partials.settings.profile-photo');
    }

    public function save()
    {
        $this->resetErrorBag();

        Validator::make(['photo' => $this->photo], [
            'photo' => ['required', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validate();

        $this->user->updateProfilePhoto($this->photo);

        $this->emit('saved');

        $this->dispatchBrowserEvent('refresh-avatar', [
            'profile_photo_url' => $this->user->profile_photo_url
        ]);
    }
}
