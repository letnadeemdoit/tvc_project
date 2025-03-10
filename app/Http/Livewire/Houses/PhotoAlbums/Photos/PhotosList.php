<?php

namespace App\Http\Livewire\Houses\PhotoAlbums\Photos;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\Photo\Album;
use App\Models\Photo\Photo;
use App\Models\User;
use App\Notifications\DeleteNotification;
use App\Notifications\DeletePhotoEmailNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class PhotosList extends Component
{
    use WithPagination;
    use Destroyable;

    public $user;
    public $siteUrl = null;

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
        'swapPhotos' => 'swapPhotos',
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
            ->orderBy('created_at', 'ASC')
            ->get();
        return view('dash.houses.photo-albums.photos.photos-list',compact('data'));
    }

    public function swapPhotos($index1, $index2)
    {
        $photos = Photo::where('album_id', $this->album->id)
            ->orderBy('created_at', 'ASC')
            ->get();

        if ($index1 < 0 || $index2 < 0 || $index1 >= $photos->count() || $index2 >= $photos->count()) {
            return;
        }

        $photo1 = $photos[$index1];
        $photo2 = $photos[$index2];

        // Swap all columns
        $tempHouseId = $photo1->HouseId;
        $photo1->HouseId = $photo2->HouseId;
        $photo2->HouseId = $tempHouseId;

        $tempAlbumId = $photo1->album_id;
        $photo1->album_id = $photo2->album_id;
        $photo2->album_id = $tempAlbumId;

        $tempSortOrder = $photo1->sort_order;
        $photo1->sort_order = $photo2->sort_order;
        $photo2->sort_order = $tempSortOrder;

        $tempDescription = $photo1->description;
        $photo1->description = $photo2->description;
        $photo2->description = $tempDescription;

        $tempPath = $photo1->path;
        $photo1->path = $photo2->path;
        $photo2->path = $tempPath;

//        $tempCreatedAt = $photo1->created_at;
//        $photo1->created_at = $photo2->created_at;
//        $photo2->created_at = $tempCreatedAt;
//
//        $tempUpdatedAt = $photo1->updated_at;
//        $photo1->updated_at = $photo2->updated_at;
//        $photo2->updated_at = $tempUpdatedAt;

        // Save changes
        $photo1->save();
        $photo2->save();

        $this->render();
    }

    public function destroyedSuccessfully($data)
    {
        $this->dispatchBrowserEvent('refresh-photos-list-in-album');
        $this->siteUrl = route('guest.photo-album.index', ['parent_id' => $data['album_id']]);

        $owner = null;
        if (!empty($data['OwnerId'])) {
            $owner = User::where('user_id', $data['OwnerId'])->first();
        }

        $ccList = [];
        if ($owner && primary_user()->email !== $owner->email) {
            $ccList[] = $owner->email;
        }
        $createdHouseName = $this->user->house->HouseName;

        $album = Album::where('id', $data['album_id'])->first();


        $dataObject = null;
//        $photo = Photo::where('PhotoId', $data['PhotoId'])->first();
//        if ($photo && $photo->path){
//            $dataObject = $photo->getFileUrl('path');
//        }


        try {
//            $users = User::where('HouseId', $this->user->HouseId)->where('role', 'Administrator')->where('is_confirmed', 1)->get();
//
//            foreach ($users as $user) {
//                $user->notify(new DeleteNotification($name,$isAction,$createdHouseName,$isModel));
//            }

            if (!is_null($this->user->house->photo_email_list) && !empty($this->user->house->photo_email_list)) {

                $photoEmailsList = explode(',', $this->user->house->photo_email_list);
                $photoEmailsList = array_merge($photoEmailsList, $ccList);
                $photoEmailsList = array_unique(array_filter($photoEmailsList));

                if (count($photoEmailsList) > 0 && !empty($photoEmailsList)) {

                    $users = User::whereIn('email', $photoEmailsList)->where('HouseId', $this->user->HouseId)->get();

                    foreach ($users as $user) {
                        $user->notify(new DeletePhotoEmailNotification($ccList, $this->siteUrl,$dataObject,$album['name'],$this->user, $createdHouseName));
                    }
//
//                    $photoEmailsList = array_diff($photoEmailsList, $users->pluck('email')->toArray());

                    if (count($photoEmailsList) > 0) {

                        Notification::route('mail', $photoEmailsList)
                            ->notify(new DeletePhotoEmailNotification($ccList, $this->siteUrl,$dataObject,$album['name'],$this->user, $createdHouseName));

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
