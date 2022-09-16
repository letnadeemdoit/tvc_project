<?php

namespace App\Http\Livewire\Settings\Vacations;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\User;
use App\Models\Vacation;
use App\Notifications\DeleteNotification;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class VacationsList extends Component
{
    use WithPagination;
    use Destroyable;

    public $user;

    public $search = '';
    public $page = 1;
    public $per_page = 15;
    public $owner = null;

    public $from;
    public $to;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'per_page' => ['except' => 15],
        'owner' => ['except' => null],
        'from',
        'to'
    ];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'destroy-vacation' => 'destroy',
        'vacation-schedule-successfully' => '$refresh',
        'destroyed-successfully' => 'destroyedSuccessfully',
        'destroyed-scheduled-successfully' => 'destroyedSuccessfully',
    ];

    public function mount()
    {
        $this->model = Vacation::class;

        $this->from = $this->from ?? now()->format('d-m-Y');
        $this->to = $this->to ?? now()->addDays(30)->format('d-m-Y');
    }

    public function render()
    {
        $data = Vacation::where('HouseId', $this->user->HouseId)
            ->when($this->user->is_owner_only, function ($query) {
                $query->where('OwnerId', $this->user->user_id);
            })
            ->when($this->search !== '', function ($query) {
                $query->where(function ($query) {
                    $query
                        ->where('VacationName', 'LIKE', "%$this->search%")
                        ->orWhereHas('house', function ($query) {
                            $query->where('HouseName', 'LIKE', "%$this->search%")
                                ->orWhere('primary_house_name', 'LIKE', "%$this->search%");
                        });
                });
            })
            ->where('OwnerId', $this->owner ?: $this->user->user_id)
            ->whereHas('startDate', function ($query) {
                $query->whereDate('RealDate', '>=', Carbon::parse($this->from)->format('Y-m-d'));
            })
            ->whereHas('endDate', function ($query) {
                $query->whereDate('RealDate', '<=', Carbon::parse($this->to)->format('Y-m-d'));
            })
//            ->whereHas('startTime', function ($query) {
//                $query->whereRaw('CAST(`time` AS time) <= "' . Carbon::parse($this->from)->format('HH:mm') . '"');
//            })
//            ->whereHas('endTime', function ($query) {
//                $query->whereRaw('CAST(`time` AS time) <= "' . Carbon::parse($this->to)->format('HH:mm') . '"');
//            })
            ->orderBy('VacationId', 'DESC')
            ->paginate($this->per_page);
        return view('dash.settings.vacations.vacations-list', compact('data'));
    }

    public function getOwnersProperty()
    {
        return User::where('HouseId', $this->user->HouseId)->where('role', '<>', User::ROLE_GUEST)->where('user_id', '<>', $this->user->user_id)->get();
    }

    public function destroyedSuccessfully($data)
    {
        $this->emitSelf('vacation-schedule-successfully');

        $name = $data['VacationName'];
        $deleteType = 'Vacation';

        try {

            if (!is_null($this->user->house->CalEmailList) && !empty($this->user->house->CalEmailList)) {

                $CalEmailList = explode(',', $this->user->house->CalEmailList);

                if (count($CalEmailList) > 0 && !empty($CalEmailList)) {

                    $users = User::whereIn('email', $CalEmailList)->where('HouseId', $this->user->HouseId)->get();

                    foreach ($users as $user) {
                        $user->notify(new DeleteNotification($name, $deleteType));
                    }

                    $CalEmailList = array_diff($CalEmailList, $users->pluck('email')->toArray());

                    if (count($CalEmailList) > 0) {

                        Notification::route('mail', $CalEmailList)
                            ->notify(new DeleteNotification($name, $deleteType));

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
