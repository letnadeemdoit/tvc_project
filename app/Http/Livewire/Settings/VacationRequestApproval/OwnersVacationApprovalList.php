<?php

namespace App\Http\Livewire\Settings\VacationRequestApproval;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\User;
use App\Models\Vacation;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class OwnersVacationApprovalList extends Component
{
    use WithPagination;
    use Destroyable;

    public $user;

    public $search = '';
    public $page = 1;
    public $per_page = 15;

    public $from;
    public $to;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'per_page' => ['except' => 15],
        'from',
        'to'
    ];

    protected $paginationTheme = 'bootstrap';


    public function mount()
    {
        $this->model = Vacation::class;
        $this->from = $this->from ?? now()->format('d-m-Y');
        $this->to = $this->to ?? now()->addDays(30)->format('d-m-Y');
    }

    public function render()
    {
        $houseId = $this->user->HouseId;
        $data = Vacation::when($this->user->is_owner_only, function ($query) {
            $query->where('HouseId', $this->user->HouseId)->where('OwnerId', $this->user->user_id);
        })->when($this->user->is_guest, function ($query) {
            $query->where('HouseId', $this->user->HouseId);
        })
            ->when($this->search !== '', function ($query) {
                $query->where(function ($query) {
                    $query
                        ->where('VacationName', 'LIKE', "%$this->search%");
                });
            })
            ->whereIn('OwnerId', function ($query) use ($houseId) {
                $query->select('user_id')
                    ->from('users')
                    ->where('HouseId', $houseId)
                    ->whereIn('role', ['Owner', 'Guest']);
            })
            ->where('is_vac_approved', 0)
            ->whereHas('startDate', function ($query) {
                $query->whereDate('RealDate', '>=', Carbon::parse($this->from)->format('Y-m-d'));
            })
            ->whereHas('endDate', function ($query) {
                $query->whereDate('RealDate', '<=', Carbon::parse($this->to)->format('Y-m-d'));
            })
            ->with('owner')
            ->orderBy('VacationId', 'DESC')
            ->paginate($this->per_page);
        return view('dash.settings.vacation-request-approval.owners-vacation-approval-list', compact('data'));
    }

    public function isVacApproved($toggle, Vacation $vacation)
    {
        $vacation->update(
            [
                'is_vac_approved' => !!$toggle,
                'OwnerId' => $vacation->owner->role === 'Guest' ? primary_user()->user_id : $vacation->owner->user_id,
                'BackGrndColor' => $vacation->owner->role === 'Guest' ? '#FF5733' : $vacation->BackGrndColor
            ]
        );

        $this->emitSelf('user-cu-successfully');
        $this->emitSelf('saved-' . $vacation->VacationId);
    }


}
