<?php

namespace App\Http\Livewire\Houses\PhotoAlbums\Photos;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\Photo\Photo;
use App\Models\User;
use App\Notifications\DeleteNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class PhotosList extends Component
{
    use WithPagination;
    use Destroyable;

    public $user;

    public $album;

    public $search = '';

    public $page = 1;

    public $per_page = 15;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'per_page' => ['except' => 15],
    ];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
//        'destroyed-successfully' => '$refresh',
        'photo-cu-successfully' => '$refresh',
        'destroyed-successfully' => 'destroyedSuccessfully',
    ];

    public function mount()
    {
        $this->model = Photo::class;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $data = Photo::where('album_id', $this->album->id)->orderBy('sort_order', 'ASC')
            ->get();
        return view('dash.houses.photo-albums.photos.photos-list',compact('data'));
    }

    public function destroyedSuccessfully($data)
    {
        $this->emitSelf('photo-cu-successfully');

        $name = 'Photo';
        $isAction = 'Deleted';
        $createdHouseName = $this->user->house->HouseName;
        $isModel = 'Photo';

        try {
//            $users = User::where('HouseId', $this->user->HouseId)->where('role', 'Administrator')->where('is_confirmed', 1)->get();
//
//            foreach ($users as $user) {
//                $user->notify(new DeleteNotification($name,$isAction,$createdHouseName,$isModel));
//            }

            if (!is_null($this->user->house->photo_email_list) && !empty($this->user->house->photo_email_list)) {

                $photoEmailsList = explode(',', $this->user->house->photo_email_list);

                if (count($photoEmailsList) > 0 && !empty($photoEmailsList)) {

                    $users = User::whereIn('email', $photoEmailsList)->where('HouseId', $this->user->HouseId)->get();

                    foreach ($users as $user) {
                        $user->notify(new DeleteNotification($name, $isAction, $createdHouseName, $isModel));
                    }

                    $photoEmailsList = array_diff($photoEmailsList, $users->pluck('email')->toArray());

                    if (count($photoEmailsList) > 0) {

                        Notification::route('mail', $photoEmailsList)
                            ->notify(new DeleteNotification($name, $isAction, $createdHouseName, $isModel));

                    }
                }
            }
        } catch (Exception $e) {

        }
    }

    public function destroy($id)
    {
        if ($this->model) {
            $deletableModel = app($this->model)->findOrFail($id);
            $this->emit(
                'destroyable-confirmation-modal',
                $this->model,
                $id,
                $this->destroyableConfirmationContent
            );
        }
    }

}
