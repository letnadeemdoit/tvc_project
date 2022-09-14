<?php

namespace App\Http\Livewire\Settings\AdditionalHouses;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\House;
use App\Models\User;
use App\Notifications\DeleteNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class HousesList extends Component
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
        'destroyed-successfully' => 'destroyedSuccessfully',
        'additional-house-cu-successfully' => '$refresh',

    ];

    public function mount()
    {
        $this->model = House::class;
    }

    public function render()
    {
        $data = House::whereHas('users', function ($query) {
            $query->where('email', $this->user->email)
                ->where('HouseId', '<>', $this->user->HouseId);
        })
            ->when($this->search !== '', function ($query) {
                $query->where(function ($query) {
                    $query->where('HouseName', 'LIKE', "%$this->search%");
                });
            })
            ->orderBy('HouseID', 'DESC')
            ->paginate($this->per_page);

        return view('dash.settings.additional-houses.houses-list', compact('data'));
    }


    public function destroyedSuccessfully($data)
    {
        $this->emitSelf('additional-house-cu-successfully');

        try {

            User::where('HouseId', $data['HouseID'])->delete();

        } catch (\Exception $e) {

        }

    }


}
