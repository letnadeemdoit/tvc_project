<?php

namespace App\Http\Livewire\Settings\LocalGuide;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\LocalGuide;
use App\Models\LocalGuideCategory;
use App\Notifications\DeleteLocalGuideEmailNotification;
use App\Notifications\DeleteNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class LocalGuideList extends Component
{
    use WithPagination;
    use Destroyable;

    public $user;

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
        'local-guide-cu-successfully' => '$refresh',
        'destroyed-successfully' => 'destroyedSuccessfully',
//        'destroyed-successfully' => '$refresh',
    ];

    public function mount()
    {
        $this->model = LocalGuide::class;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $data = LocalGuide::where('house_id', $this->user->HouseId)
            ->when($this->user->is_owner_only, function ($query) {
                $query->where('user_id', $this->user->user_id);
            })
            ->when($this->search !== '', function ($query) {
                $query->where(function ($query) {
                    $query
                        ->where('title', 'LIKE', "%$this->search%")
                        ->orWhere('address', 'LIKE', "%$this->search%")
                        ->orWhere('datetime', 'LIKE', "%$this->search%");
                });
            })

            ->orderBy('id', 'DESC')
            ->paginate($this->per_page);

        return view('dash.settings.local-guide.local-guide-list',compact('data'));
    }

    public function destroyedSuccessfully($data)
    {
        $this->emitSelf('local-guide-cu-successfully');

        $title = $data['title'];
        $createdHouseName = $this->user->house->HouseName;

        $owner = null;
        if (!empty($data['user_id'])) {
            $owner = User::where('user_id', $data['user_id'])->first();
        }
        $ccList = [];
        if ($owner && $owner->email) {
            $ccList[] = $owner->email;
        }


        try {
//            $users = User::where('HouseId', $this->user->HouseId)->where('role', 'Administrator')->where('is_confirmed', 1)->get();
//            foreach ($users as $user) {
//                $user->notify(new DeleteNotification($name,$isAction,$createdHouseName,$isModel));
//            }

            if (!is_null($this->user->house->local_guide_email_list) && !empty($this->user->house->local_guide_email_list)) {

                $localGuideEmailsList = explode(',', $this->user->house->local_guide_email_list);

                if (count($localGuideEmailsList) > 0 && !empty($localGuideEmailsList)) {

                    $users = User::whereIn('email', $localGuideEmailsList)->where('HouseId', $this->user->HouseId)->get();

                    foreach ($users as $user) {
                        $user->notify(new DeleteLocalGuideEmailNotification($ccList,$title,$this->user,$createdHouseName));
                    }

                    $localGuideEmailsList = array_diff($localGuideEmailsList, $users->pluck('email')->toArray());

                    if (count($localGuideEmailsList) > 0) {

                        Notification::route('mail', $localGuideEmailsList)
                            ->notify(new DeleteLocalGuideEmailNotification($ccList,$title,$this->user,$createdHouseName));

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
