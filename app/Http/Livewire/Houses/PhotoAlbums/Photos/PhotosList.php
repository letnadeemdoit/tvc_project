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
        $data = Photo::where('album_id', $this->album->id)
            ->paginate($this->per_page);
        return view('dash.houses.photo-albums.photos.photos-list',compact('data'));
    }

    public function destroyedSuccessfully($data)
    {
        $this->emitSelf('photo-cu-successfully');

        $name = 'Photo';
        $isAction = 'Deleted';
        $createdHouseName = $this->user->house->HouseName;
        $isModel = '';

        try {

            if (!is_null(auth()->user()->house->request_to_use_house_email_list) && !empty(auth()->user()->house->request_to_use_house_email_list)) {

                $request_to_use_house_email_list = explode(',', auth()->user()->house->request_to_use_house_email_list);

                if (count($request_to_use_house_email_list) > 0 && !empty($request_to_use_house_email_list)) {

                    $users = User::whereIn('email', $request_to_use_house_email_list)->where('HouseId', auth()->user()->HouseId)->get();

                    foreach ($users as $user) {
                        $user->notify(new DeleteNotification($name,$isAction,$createdHouseName,$isModel));
                    }

//                  Notification::send($users, new BlogNotification($items,$blogUrl,$createdHouseName));
                    $request_to_use_house_email_list = array_diff($request_to_use_house_email_list, $users->pluck('email')->toArray());

                    if (count($request_to_use_house_email_list) > 0) {

                        Notification::route('mail', $request_to_use_house_email_list)
                            ->notify(new DeleteNotification($name,$isAction,$createdHouseName,$isModel));

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
