<?php

namespace App\Http\Livewire\Settings\VacationRequestApproval;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\GuestContact;
use App\Models\User;
use App\Models\Vacation;
use App\Notifications\DeleteNotification;
use App\Notifications\GuestVacationApprovedNotification;
use App\Notifications\VacationDeniedEmailNotification;
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


    public $startDate = null;
    public $endDate = null;


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
        if ($this->user->is_admin) {
            $roles[] = 'Guest';
            $roles[] = 'Administrator';
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
            ->whereIn('OwnerId', function ($query) use ($houseId, $roles) {
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

        // Iterate over the data to exclude based on role and original_owner
        foreach ($data as $key => $d) {
            $ownerRole = $d->owner->role ?? '';
            $originalOwner = $d->original_owner;
            if ($ownerRole === 'Administrator' && is_null($originalOwner) && $this->vacations === 'unapproved' && $d->is_vac_approved === 0) {
                unset($data[$key]);
            }
        }

        return view('dash.settings.vacation-request-approval.owners-vacation-approval-list', compact('data'));
    }

    public function isVacApproved($toggle, Vacation $vacation)
    {
        $adminUser = primary_user();
        $owner = User::where('user_id', $vacation->OwnerId)->first();
        $ownerRole = optional($owner)->role;
        $guestContact = null;

        $vacation->update(
            [
                'is_vac_approved' => !!$toggle,
                'OwnerId' => $ownerRole === 'Guest' ? primary_user()->user_id : ($ownerRole === 'Administrator' ? $vacation->original_owner : $owner->user_id),
//                'HouseId' => $ownerRole === 'Guest' ? $vacation->HouseId : ($ownerRole === 'Administrator' ? $vacation->HouseId : $owner->HouseId),
                'BackGrndColor' => $ownerRole === 'Guest' ? '#E8604C' : ($ownerRole === 'Administrator' ? '#CCCCCC' : $vacation->BackGrndColor),
            ]
        );
        $recurringVacations = $vacation->recurrings;
        if (count($recurringVacations) > 0) {
            foreach ($recurringVacations as $recurringVacation) {
                $recurringVacation->update([
                    'is_vac_approved' => !!$toggle,
                    'OwnerId' => $ownerRole === 'Guest' ? primary_user()->user_id : ($ownerRole === 'Administrator' ? $vacation->original_owner : $owner->user_id),
                    'BackGrndColor' => $ownerRole === 'Guest' ? '#E8604C' : ($ownerRole === 'Administrator' ? '#CCCCCC' : $vacation->BackGrndColor),
                ]);
            }
        }


        if ($ownerRole !== 'Owner') {

            // Send notifications and update guest contacts
            $guestContact = GuestContact::where([
                'house_id' => $vacation->HouseId,
                'guest_id' => $vacation->original_owner,
                'guest_vac_id' => $vacation->VacationId,
            ])->first();


            if ($guestContact && $guestContact->guest_id) {
                $guestContact->update([
                    'guest_vac_color' => $ownerRole === 'Guest' ? '#E8604C' : '#CCCCCC',
                    'is_approved' => $ownerRole === 'Guest' ? 1 : 0,
                ]);

            }

        }
        // Previous Code
//            if ($ownerRole === 'Guest') {
//                $guestContacts = GuestContact::where([
//                    'house_id' => $owner->HouseId,
//                    'guest_id' => $owner->user_id,
//                    'is_approved' => 0
//                ])->get();
//                if (count($guestContacts) > 0) {
//                    foreach ($guestContacts as $guestContact) {
//                        $guestContact->update(
//                            [
//                                'guest_vac_color' => $vacation->BackGrndColor,
//                                'is_approved' => 1,
//                            ]
//                        );
//                        $guestName = $guestContact->guest_name;
//                        $guestEmail = $guestContact->guest_email;
//                        $houseName = $guestContact->house->HouseName;
//                        Notification::route('mail', $guestEmail)
//                            ->notify(new GuestVacationApprovedNotification($guestName, $guestContact, $adminUser, $vacation, $houseName));
//                    }
//                }
//            }

        try {
            $vac_owner = User::where('user_id', $vacation->OwnerId)->first();
            $startDate = $vacation->start_datetime->format('m-d-Y H:i');
            $endDate = $vacation->end_datetime->format('m-d-Y H:i');
            $ccList = [];
            if (!is_null($this->user->house->CalEmailList) && !empty($this->user->house->CalEmailList)) {
                $CalEmailList = explode(',', $this->user->house->CalEmailList);
                $ccList = array_merge($ccList, $CalEmailList); // Merge emails into $ccList
                $ccList = array_unique(array_filter($ccList));
            }
            $houseName = $vac_owner->house->HouseName;

            if (($vac_owner->role === 'Guest' || $vac_owner->role === 'Administrator') && ($guestContact && $guestContact->guest_email)) {
                $vacContent = $guestContact->is_approved === 0 ? 'Unapproved' : 'Approved';
                $name = $guestContact->guest_name;
                $email = $guestContact->guest_email;
                $isApproved = $guestContact->is_approved;
                $ccList[] = $guestContact->guest_email;
                $ccList = array_unique(array_filter($ccList));

                if (!is_null($this->user->house->CalEmailList) && !empty($this->user->house->CalEmailList)) {
                    $CalEmailList = explode(',', $this->user->house->CalEmailList);
                    $users = User::whereIn('email', $CalEmailList)->where('HouseId', $this->user->HouseId)->get();
                    foreach ($users as $user) {
                        $user->notify(new GuestVacationApprovedNotification(
                            $ccList,
                            $vacContent,
                            $name,
                            $email,
                            $isApproved,
                            $vacation,
                            $houseName,
                            $startDate,
                            $endDate
                        ));
                    }
                }

                Notification::route('mail', $ccList)
                    ->notify(new GuestVacationApprovedNotification(
                        $ccList,
                        $vacContent,
                        $name,
                        $email,
                        $isApproved,
                        $vacation,
                        $houseName,
                        $startDate,
                        $endDate
                    ));
            }
            elseif ($vac_owner->role === 'Owner') {
                $vacContent = $vacation->is_vac_approved === true ? 'Approved' : 'Unapproved';
                $name = $vac_owner->first_name . ' ' . $vac_owner->last_name;
                $email = $vac_owner->email;
                $isApproved = $vacation->is_vac_approved === true ? 1 : 0;
                $ccList[] = $email;
                $ccList = array_unique(array_filter($ccList));

                if (!is_null($this->user->house->CalEmailList) && !empty($this->user->house->CalEmailList)) {
                    $CalEmailList = explode(',', $this->user->house->CalEmailList);
                    $users = User::whereIn('email', $CalEmailList)->where('HouseId', $this->user->HouseId)->get();
                    foreach ($users as $user) {
                        $user->notify(new GuestVacationApprovedNotification(
                            $ccList,
                            $vacContent,
                            $name,
                            $email,
                            $isApproved,
                            $vacation,
                            $houseName,
                            $startDate,
                            $endDate
                        ));
                    }
                }

                Notification::route('mail', $email)
                    ->notify(new GuestVacationApprovedNotification(
                        $ccList,
                        $vacContent,
                        $name,
                        $email,
                        $isApproved,
                        $vacation,
                        $houseName,
                        $startDate,
                        $endDate
                    ));

            }

        } catch (\Exception $e) {

        }

        $this->emitSelf('user-cu-successfully');
        $this->emitSelf($toggle === 1 ? 'approved-' . $vacation->VacationId : 'unapproved-' . $vacation->VacationId);
    }

    public function destroyedSuccessfully($data)
    {
        Vacation::where('parent_id', $data['VacationId'])->delete();
        $owner = User::where('user_id', $data['OwnerId'])->first();
        $ownerRole = optional($owner)->role;
        $vacName = $data['VacationName'];
        $name = null;
        $email = null;

        try {
            if ($ownerRole === 'Guest'){
                $guestContact = GuestContact::where([
                    'guest_id' => $data['original_owner'],
                    'guest_vac_id' => $data['VacationId'],
                ])->first();

                // Delete the guest contact if found
                if ($guestContact && $guestContact->guest_email) {
                    $this->notificationEmail = $guestContact->guest_email;
                    $name = $guestContact->guest_name;
                    $email = $guestContact->guest_email;
                    $guestContact->delete();
                }
            }
            else{
                $this->notificationEmail = $owner->email;
                $name = $owner->first_name . ' ' . $owner->last_name;
                $email = $owner->email;
            }

//            $startDate = $this->deletableModel->start_datetime->format('m-d-Y H:i');
//            $endDate = $this->deletableModel->end_datetime->format('m-d-Y H:i');

            $ccList = [];
            if ($this->user && primary_user()->email !== $this->user->email) {
                $ccList[] = $this->user->email;
            }
            $houseName = $owner->house->HouseName;
            $admin = $this->user;
            $ccList[] = $this->notificationEmail;
            $ccList = array_unique(array_filter($ccList));

            if (!is_null($this->user->house->CalEmailList) && !empty($this->user->house->CalEmailList)){
                $users = User::whereIn('email', $this->user->house->CalEmailList)->where('HouseId', $this->user->HouseId)->get();
                foreach ($users as $user) {
                    $user->notify(new VacationDeniedEmailNotification($ccList,$name,$email,$vacName,$admin,$houseName,$this->startDate,$this->endDate));
                }
            }

            if ($this->notificationEmail){
                Notification::route('mail', $ccList)
                    ->notify(new VacationDeniedEmailNotification($ccList,$name,$email,$vacName,$admin,$houseName,$this->startDate,$this->endDate));
            }

        } catch (Exception $e) {

        }

        $this->emitSelf('user-cu-successfully');

    }
    public function destroy($id)
    {
        $vacation = Vacation::where('VacationId', $id)->first();
        $this->startDate = $vacation->start_datetime->format('m-d-Y H:i');
        $this->endDate = $vacation->end_datetime->format('m-d-Y H:i');

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
