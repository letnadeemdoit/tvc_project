<?php

namespace App\Http\Livewire\Settings\Users;
use App\Http\Livewire\Traits\Toastr;
use App\Http\Livewire\Traits\Destroyable;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;


class UsersList extends Component
{
    use WithPagination;
    use Destroyable;
    use Toastr;

    public $user;

    public $deletedUserId = null;
    public $houseIds = null;
    public $currentProperty = null;
    public $isUserMultiplePropertiies = false;

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
        'destroyed-successfully' => '$refresh',
        'user-cu-successfully' => '$refresh',
    ];

    public function mount()
    {
        $this->model = User::class;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function isConfirmed($toggle, User $user) {
//        $usersOwner = User::where('parent_id', $user->parent_id)->where('email', $user->email)->where('role', 'Owner')->get();
        $usersOwner = User::where('parent_id', $user->parent_id)->where('email', $user->email)->whereIn('role', ['Administrator','Owner'])->get();
        if (count($usersOwner) > 0){
            foreach ($usersOwner as $owner){
                $owner->update(['is_confirmed' => !!$toggle]);
            }
        }
        else{
            $guestUser = User::where('parent_id', $user->parent_id)->where('HouseId', $user->HouseId)->where('role', 'Guest')->first();
            $guestUser->update(['is_confirmed' => !!$toggle]);
        }
        $this->emitSelf('user-cu-successfully');
        $this->emitSelf('saved-' . $user->user_id);
    }


//    public function render()
//    {
//        $data = User::whereIn('HouseId', [$this->user->HouseId, ...$this->user->additional_houses->pluck('HouseID')->toArray()])
////            ->where('user_id', '<>', $this->user->user_id)
//            ->where('email', '<>', primary_user()->email)
//            ->when($this->search !== '', function ($query) {
//                $query->where(function ($query) {
//                    $query
//                        ->where('user_name', 'LIKE', "%$this->search%")
//                        ->orWhere('first_name', 'LIKE', "%$this->search%")
//                        ->orWhere('last_name', 'LIKE', "%$this->search%")
//                        ->orWhere('email', 'LIKE', "%$this->search%");
//                });
//            })
//            ->orderBy('created_at', 'DESC')
//            ->groupBy('email')   //Aditional
//            ->paginate($this->per_page);
//        return view('dash.settings.users.users-list', compact('data'));
//    }

    public function render()
    {
        // Fetch all users excluding guests
        $users = User::whereIn('HouseId', [$this->user->HouseId, ...$this->user->additional_houses->pluck('HouseID')->toArray()])
            ->where('email', '<>', primary_user()->email)
            ->where('role', '<>', 'Guest')
            ->when($this->search !== '', function ($query) {
                $query->where(function ($query) {
                    $query
                        ->where('user_name', 'LIKE', "%$this->search%")
                        ->orWhere('first_name', 'LIKE', "%$this->search%")
                        ->orWhere('last_name', 'LIKE', "%$this->search%")
                        ->orWhere('email', 'LIKE', "%$this->search%");
                });
            })
            ->groupBy('email')
            ->get();

        // Fetch all guests
        $guests = User::whereIn('HouseId', [$this->user->HouseId, ...$this->user->additional_houses->pluck('HouseID')->toArray()])
            ->where('email', '<>', primary_user()->email)
            ->where('role', 'Guest')
            ->when($this->search !== '', function ($query) {
                $query->where(function ($query) {
                    $query
                        ->where('user_name', 'LIKE', "%$this->search%")
                        ->orWhere('email', 'LIKE', "%$this->search%");
                });
            })
            ->get();

        // Merge and sort data by creation date
        $mergedData = $users->merge($guests)->sortByDesc('created_at')->values();

        // Implement pagination
        $currentPage = $this->page;
        $perPage = $this->per_page;
        $total = $mergedData->count();
        $currentPageItems = $mergedData->slice(($currentPage - 1) * $perPage, $perPage);

        $data = new LengthAwarePaginator(
            $currentPageItems,
            $total,
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('dash.settings.users.users-list', compact('data'));
    }
    public function confirmProperty($id){
        $this->deletedUserId = $id;
        $deletedUser = User::where('user_id', $id)->first();
        $this->currentProperty = $deletedUser->house->HouseName;
        $this->houseIds = User::where('email', $deletedUser->email)->where('role', $deletedUser->role)->get()->pluck('HouseId');
        if (count($this->houseIds) > 1){

            $this->isUserMultiplePropertiies = true;
        }
        $this->dispatchBrowserEvent('sure-to-delete',['data' => null]);
    }
    public function deleteCurrent(){
        if ($this->model) {
            $deletedUser = User::where('user_id', $this->deletedUserId)->first();
            User::where('HouseId', $deletedUser->HouseId)->where('email', $deletedUser->email)->delete();
            $this->emitSelf('toggle', false);
            $this->emitSelf('user-cu-successfully');
            $this->dispatchBrowserEvent('confirm-deleted',['data' => null]);
            $this->success('Deleted successfully.');
        }
    }

    public function deleteAllProperties(){
        if ($this->model && count($this->houseIds) > 0) {
            $deletedUser = User::where('user_id', $this->deletedUserId)->first();
            User::whereIn('HouseId', $this->houseIds)->where('email', $deletedUser->email)->delete();
            $this->emitSelf('toggle', false);
            $this->emitSelf('user-cu-successfully');
            $this->dispatchBrowserEvent('confirm-deleted',['data' => null]);
            $this->success('Deleted successfully.');
        }
    }

}
