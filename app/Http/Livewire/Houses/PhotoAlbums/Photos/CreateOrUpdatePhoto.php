<?php

namespace App\Http\Livewire\Houses\PhotoAlbums\Photos;

use App\Http\Livewire\Traits\Toastr;
use App\Models\Photo\Album;
use App\Models\Photo\Photo;
use App\Models\User;
use App\Notifications\PhotoAlbumNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateOrUpdatePhoto extends Component
{

    use WithFileUploads;
    use Toastr;

    public $album;

    public $user;

    public $isCreating = false;

    public $isShowingModal = false;
    public $isPhotoOrder = false;
    public $isChangeAlbumOrder = false;

    public $state = [];

    public $file;

    public ?Photo $photo;

    protected $listeners = [
        'showPhotoCUModal',
    ];

    public function render()
    {
        $albumCategory = Album::where('house_id', $this->user->HouseId)
//            ->when($this->user->is_owner_only, function ($query){
//                $query->where('user_id', $this->user->user_id);
//            })
//            ->where(function ($query){
//                $query->whereDoesntHave('parentAlbum')
//                    ->orWhereHas('parentAlbum', function ($query) {
//                        $query->whereDoesntHave('parentAlbum');
//                    });
//            })
            ->get();

        $albumPhotosOrder = range(1, 100);

        return view('dash.houses.photo-albums.photos.create-or-update-photo', compact('albumCategory', 'albumPhotosOrder'));

    }

    public function hydrate()
    {
        $this->dispatchBrowserEvent('modal-is-shown');
    }

    public function showPhotoCUModal($toggle, ?Photo $photo)
    {
        $this->emitSelf('toggle', $toggle);
        $this->photo = $photo;
        $this->reset(['state', 'file']);

        if ($photo->PhotoId) {
            $this->isCreating = false;
            $this->state = \Arr::only($photo->toArray(), ['HouseId', 'album_id','sort_order', 'description', 'path']);
        } else {
            $this->isCreating = true;
        }
    }

    public function savePhotoCU()
    {
        $this->resetErrorBag();

        $inputs = $this->state;

        if ($this->file) {
            $inputs['image'] = $this->file;
        }

        Validator::make($inputs, [
            'image' => [
                $this->isCreating ? 'required' : 'nullable',
                'mimes:png,jpg,gif,tiff'
            ],
            'description' => 'nullable|string|max:255',
        ])->validateWithBag('savePhotoCU');

        $this->photo->fill([
            'HouseId' => auth()->user()->HouseId,
            'album_id' => $this->isCreating ? $this->album->id : $inputs['album_id'],
            'description' => $inputs['description'] ?? null,
        ])->save();

        if ($this->file) {
            $this->photo->updateFile($this->file, 'path');
        }

        if (!$this->isCreating && isset($inputs['sort_order'])){
            $sortOrder = (int) $inputs['sort_order'];
            $this->photo->update(['sort_order' => $sortOrder]);
        }

        try {
            $items = $this->photo;
            $createdHouseName = $this->user->house->HouseName;
            $isAction = $this->isCreating ? 'created' : 'updated';

            if (!is_null($this->user->house->photo_email_list) && !empty($this->user->house->photo_email_list)) {

                $photoEmailsList = explode(',', $this->user->house->photo_email_list);
                if (count($photoEmailsList) > 0 && !empty($photoEmailsList)) {
                    $users = User::whereIn('email', $photoEmailsList)->where('HouseId', $this->user->HouseId)->get();

                    foreach ($users as $user) {
                        $user->notify(new PhotoAlbumNotification($items, $isAction, $createdHouseName));
                    }
//                Notification::send($users, new BlogNotification($items,$blogUrl,$createdHouseName));
                    $photoEmailsList = array_diff($photoEmailsList, $users->pluck('email')->toArray());
                    if (count($photoEmailsList) > 0) {
                        Notification::route('mail', $photoEmailsList)
                            ->notify(new PhotoAlbumNotification($items, $isAction, $createdHouseName));
                    }
                }
            }
        } catch (Exception $e) {

        }

//        try {
//            $items = $this->photo;
//            $createdHouseName = auth()->user()->house->HouseName;
//            $isAction = $this->isCreating ? 'created' : 'updated';
//
//            $users = User::where('HouseId', $this->user->HouseId)->where('role', 'Administrator')->where('is_confirmed', 1)->get();
//
//            foreach ($users as $user) {
//                $user->notify(new PhotoAlbumNotification($items, $isAction, $createdHouseName));
//            }
//
//        } catch (Exception $e) {
//
//        }

        $this->emitSelf('toggle', false);

        $this->dispatchBrowserEvent('refresh-photos-list-in-album');
        $this->emit('photo-cu-successfully');

        $this->success('Photo ' . ($this->isCreating ? 'created' : 'updated') . ' successfully.');
    }

    public function updatedFile()
    {
        $this->validateOnly('file', ['file' => 'required|mimes:png,jpg,gif,tiff']);
    }

    public function deleteFile()
    {
        if ($this->photo->id) {
            $this->photo->deleteFile();
            $this->emit('photo-cu-successfully');
        }
    }

    public function onChangePhotosAlbum(){
        $this->isChangeAlbumOrder = true;
    }
    public function onReorderPhotos(){
        $this->isPhotoOrder  = true;
    }


}
