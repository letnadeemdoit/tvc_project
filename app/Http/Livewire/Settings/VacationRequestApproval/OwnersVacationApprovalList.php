<?php

namespace App\Http\Livewire\Settings\VacationRequestApproval;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\GuestContact;
use App\Models\User;
use App\Models\Vacation;
use App\Notifications\DeleteNotification;
use App\Notifications\GuestVacationApprovedNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class OwnersVacationApprovalList extends Component
{
    use WithPagination;
    use Destroyable;

    public $user;
    public $notificationEmail = null;

    public $search = '';
    public $page = 1;
    public $per_page = 15;

    public $start_date = null;
    public $end_date = null;

    public $from;
    public $to;
    public $vacations = 'unapproved';

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'per_page' => ['except' => 15],
        'from',
        'to',
        'vacations' => ['except' => '']
    ];

    protected $listeners = [
        'destroyed-successfully' => 'destroyedSuccessfully',
    ];

    protected $paginationTheme = 'bootstrap';


    public function mount()
    {
        $this->model = Vacation::class;
        $this->from = $this->from ?? now()->format('d-m-Y');
        $this->to = $this->to ?? now()->addMonths(5)->format('d-m-Y');
    }

    public function toggleVacations()
    {
        if ($this->vacations === 'approved') {
            $this->vacations = 'unapproved';
        } else {
            $this->vacations = 'approved';
        }

        $this->resetPage(); // Reset pagination to the first page
        $this->emit('updateUrl', ['vacations' => $this->vacations]);
    }

    public function render()
    {
        $houseId = $this->user->HouseId;
        $roles = ['Owner'];
        if ($this->user->is_admin && $this->user->primary_account) {
            $roles[] = 'Guest';
        }

        $data = Vacation::when($this->user->is_owner_only, function ($query) {
            $query->where('HouseId', $this->user->HouseId)->where('OwnerId', $this->user->user_id);
        })->when($this->user->is_admin, function ($query) {
            $query->where('HouseId', $this->user->HouseId);
        })
            ->when($this->search !== '', function ($query) {
                $query->where(function ($query) {
                    $query
                        ->where('VacationName', 'LIKE', "%$this->search%");
                });
            })
            ->whereIn('OwnerId', function ($query) use ($houseId,$roles) {
                $query->select('user_id')
                    ->from('users')
                    ->where('HouseId', $houseId)
                    ->whereIn('role', $roles);
            })
            ->where('is_vac_approved', $this->vacations === 'unapproved' ? 0 : 1)
            ->where('is_calendar_task', 0)
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
        $adminUser = primary_user();
        $owner = User::where('user_id', $vacation->OwnerId)->first();
        $ownerRole = optional($owner)->role;

        $vacation->update(
            [
                'is_vac_approved' => !!$toggle,
                'OwnerId' => $ownerRole === 'Guest' ? primary_user()->user_id : $owner->user_id,
                'HouseId' => $ownerRole === 'Guest' ? primary_user()->HouseId : $owner->HouseId,
                'BackGrndColor' => $ownerRole === 'Guest' ? '#FF5733' : $vacation->BackGrndColor
            ]
        );
        $recurringVacations = $vacation->recurrings;
        if (count($recurringVacations) > 0){
            foreach ($recurringVacations as $recurringVacation) {
                $recurringVacation->update([
                    'is_vac_approved' => !!$toggle,
                    'OwnerId' => $ownerRole === 'Guest' ? primary_user()->user_id : $owner->user_id,
                    'BackGrndColor' => $ownerRole === 'Guest' ? '#FF5733' : $vacation->BackGrndColor
                ]);
            }
        }

        try {
            if ($ownerRole === 'Guest'){
                $guestContact = GuestContact::where('house_id', $owner->HouseId)->where('guest_id', $owner->user_id)->first();
                $guestEmail = $guestContact->guest_email;
                $houseName = $guestContact->house->HouseName;

                Notification::route('mail', $guestEmail)
                    ->notify(new GuestVacationApprovedNotification($guestContact,$adminUser,$vacation,$houseName));
            }

        } catch (\Exception $e) {

        }

        $this->emitSelf('user-cu-successfully');
        $this->emitSelf($toggle === 1 ? 'approved-' . $vacation->VacationId : 'unapproved-' . $vacation->VacationId);

//        $this->emitSelf('saved-' . $vacation->VacationId);
    }

    public function destroyedSuccessfully($data)
    {
        Vacation::where('parent_id', $data['VacationId'])->delete();
        $vacationName = $data['VacationName'];
        $owner = User::where('user_id', $data['OwnerId'])->first();
        $ownerRole = optional($owner)->role;

        try {
            if ($ownerRole === 'Guest'){
                $guestContact = GuestContact::where('house_id', $owner->HouseId)->where('guest_id', $owner->user_id)->first();
                $this->notificationEmail = $guestContact->guest_email;
            }
            else{
                $this->notificationEmail = $owner->email;
            }

            $createdHouseName = $owner->house->HouseName;
            $isAction = 'Rejected';
            $isModal = 'Vacation';
            Notification::route('mail', $this->notificationEmail)
                ->notify(new DeleteNotification($vacationName, $isAction,$createdHouseName,$isModal));

        } catch (Exception $e) {

        }

        $this->emitSelf('user-cu-successfully');

    }
        public function destroy($id)
    {
        $rejected = 'rejected';
        if ($this->model) {
            $deletableModel = app($this->model)->findOrFail($id);
            $this->emit(
                'destroyable-confirmation-modal',
                $this->model,
                $id,
                $this->destroyableConfirmationContent,
                $rejected
            );
        }
    }


}
