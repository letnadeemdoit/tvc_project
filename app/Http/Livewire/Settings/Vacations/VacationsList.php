<?php

namespace App\Http\Livewire\Settings\Vacations;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\House;
use App\Models\User;
use App\Models\Vacation;
use App\Notifications\DeleteNotification;
use App\Notifications\DeleteVacationNotification;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
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

    public $startDatetimeOfDelVacation;

    public $endDatetimeOfDelVacation;
    public $selectedHouses = [];
    public $properties = null;

    public $from;
    public $to;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'per_page' => ['except' => 15],
        'owner' => ['except' => null],
        'properties' => ['except' => null],
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

        if ($this->user->is_admin) {
            if ($this->properties) {
                $this->selectedHouses = explode(',', $this->properties);
            }
        }

        $this->from = $this->from ?? now()->format('d-m-Y');
        $this->to = $this->to ?? now()->addDays(30)->format('d-m-Y');
    }

    public function render()
    {
        $data = Vacation::when($this->user->is_owner_only, function ($query) {
                $query->where('HouseId', $this->user->HouseId)->where('OwnerId', $this->user->user_id);
            })->when($this->user->is_admin, function ($query) {
                $query->where('HouseId', $this->properties ? $this->selectedHouses : $this->user->HouseId);
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
            ->where('is_calendar_task', 0)
            ->where('OwnerId', $this->owner ?: $this->user->user_id)
//            ->whereNotIn('OwnerId', User::where('HouseId', primary_user()->HouseId)
//                ->where('role', 'Guest')
//                ->pluck('user_id')
//                ->toArray())
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

    public function setProperty($property = null)
    {
        if ($property) {
            $this->properties = implode(',', $this->selectedHouses);
        } else {
            $this->properties = null;
        }
    }

    public function getHousesProperty()
    {
        return House::whereHas('users', function ($query) {
            $query->where([
                'role' => User::ROLE_ADMINISTRATOR,
            ])->where(function ($query) {
                $query->where('email', $this->user->email)
                    ->when($this->user->primary_account, function ($query) {
                        $query->orWhere('parent_id', $this->user->user_id);
                    })
                    ->when(!$this->user->primary_account, function ($query) {
                        $query->orWhere(function ($query) {
                            $query->where('parent_id', $this->user->user_id)
                                ->orWhere('user_id', $this->user->user_id);
                        });
                    });
            });
        })->get();
    }

    public function getOwnersProperty()
    {
        return User::where('HouseId', $this->user->HouseId)->where('role', '<>', User::ROLE_GUEST)->where('user_id', '<>', $this->user->user_id)->get();
    }

    public function destroyedSuccessfully($data)
    {

        if (session()->has('startDatetimeOfVacation')) {
            $this->startDatetimeOfDelVacation = session()->get('startDatetimeOfVacation');
            session()->forget('startDatetimeOfVacation');
        }
        if (session()->has('endDatetimeOfVacation')) {
            $this->endDatetimeOfDelVacation = session()->get('endDatetimeOfVacation');
            session()->forget('endDatetimeOfVacation');
        }

        $this->emitSelf('vacation-schedule-successfully');

        Vacation::where('parent_id', $data['VacationId'])->delete();
        $vac_owner = User::where('user_id', $data['OwnerId'])->first();
        $name = $data['VacationName'];

        $ccList = [];
        if (!is_null($vac_owner) && primary_user()->email !== $vac_owner->email) {
            $ccList[] = $vac_owner->email;
        }

        try {
            $createdHouseName = $this->user->house->HouseName;
            $isAction = 'Deleted';
            $isModal = 'Vacation';

            if (!is_null($this->user->house->CalEmailList) && !empty($this->user->house->CalEmailList)) {

                $CalEmailList = explode(',', $this->user->house->CalEmailList);
                $CalEmailList = array_merge($CalEmailList, $ccList);
                $CalEmailList = array_unique(array_filter($CalEmailList));

                if (count($CalEmailList) > 0 && !empty($CalEmailList)) {

//                    $users = User::whereIn('email', $CalEmailList)->where('HouseId', $this->user->HouseId)->get();
//
//                    foreach ($users as $user) {
//                        $user->notify(new DeleteVacationNotification($name,$this->user,$this->startDatetimeOfDelVacation,$this->endDatetimeOfDelVacation, $isAction,$createdHouseName,$isModal));
//                    }
//
//                    $CalEmailList = array_diff($CalEmailList, $users->pluck('email')->toArray());

                    if (count($CalEmailList) > 0) {

                        Notification::route('mail', $CalEmailList)
                            ->notify(new DeleteVacationNotification($name,$this->user,$vac_owner,$ccList,$this->startDatetimeOfDelVacation,$this->endDatetimeOfDelVacation, $isAction,$createdHouseName,$isModal));

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
            Session::put('startDatetimeOfVacation', $deletableModel->start_datetime->format('m/d/Y H:i'));
            Session::put('endDatetimeOfVacation', $deletableModel->end_datetime->format('m/d/Y H:i'));
            $this->emit(
                'destroyable-confirmation-modal',
                $this->model,
                $id,
                $this->destroyableConfirmationContent
            );
        }
    }
}
