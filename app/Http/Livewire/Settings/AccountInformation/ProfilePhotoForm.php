<?php

namespace App\Http\Livewire\Settings\AccountInformation;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfilePhotoForm extends Component
{
    use WithFileUploads;

    public $user;
    public $photo;

    public function render()
    {
        return view('dash.settings.account-information.profile-photo-form');
    }

    public function save()
    {
        $this->resetErrorBag();

        Validator::make(['photo' => $this->photo], [
            'photo' => ['required', 'mimes:jpg,jpeg,png', 'max:20480'],
        ])->validate();

        $this->user->updateProfilePhoto($this->photo);

        $this->emit('saved');
        $this->reset('photo');
        $this->dispatchBrowserEvent('refresh-avatar', [
            'profile_photo_url' => $this->user->profile_photo_url
        ]);
    }
}
