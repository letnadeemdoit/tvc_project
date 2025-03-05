<?php

namespace App\Http\Controllers\AppControllers;

use App\Http\Controllers\Controller;
use App\Models\GuestContact;
use App\Models\User;
use App\Models\Vacation;
use App\Notifications\GuestVacationApprovedNotification;
use App\Notifications\VacationDeniedEmailNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class VacationApprovalController extends BaseController
{

    public $user;
    public $house;
    public $limit;
    public $offSet;
    public $search;
    public $from;
    public $to;
    public $isApproved;
    public $notificationEmail = null;

    public $startDate = null;
    public $endDate = null;

    public ?Vacation $vacation;

    /**
     * Get Vacations api
     *
     * @return \Illuminate\Http\Response
     */
    public function getVacationList(Request $request)
    {
        try {
            $this->user = Auth::user();
            $this->search = $request->search ?? '';
            $this->limit = $request->limit ?? 5;
            $this->offSet = $request->offSet ?? 0;
            $this->from = $request->from;
            $this->to = $request->to;
            $this->isApproved = $request->isApproved;

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
                ->where('is_vac_approved', $this->isApproved === 'unapproved' ? 0 : 1)
                ->where('is_calendar_task', 0)
                ->whereHas('startDate', function ($query) {
                    $query->whereDate('RealDate', '>=', Carbon::parse($this->from)->format('Y-m-d'));
                })
                ->whereHas('endDate', function ($query) {
                    $query->whereDate('RealDate', '<=', Carbon::parse($this->to)->format('Y-m-d'));
                })
                ->with('owner')
                ->orderBy('VacationId', 'DESC')
                ->skip($this->offSet)
                ->take($this->limit)
                ->get();

            // Iterate over the data to exclude based on role and original_owner
            foreach ($data as $key => $d) {
                $ownerRole = $d->owner->role ?? '';
                $originalOwner = $d->original_owner;
                if ($ownerRole === 'Administrator' && is_null($originalOwner) && $this->isApproved === 'unapproved' && $d->is_vac_approved === 0) {
                    unset($data[$key]);
                }
            }


            $response = [
                'success' => true,
                'data' => [
                    'vacations' => $data,
                ],
                'message' => 'Data fetched successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }


    /**
     * Vacation Approval api
     *
     * @return \Illuminate\Http\Response
     */
    public function approveVacation(Request $request)
    {
        try {
            $this->user = Auth::user();
            $inputs = $request->all();
            $validator = Validator::make($inputs, [
                'vacationId' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation error', $validator->errors(), 422);
            }
            $vacationId = $inputs['vacationId'];
            $vacation = Vacation::where('VacationId', $vacationId)->first();
            $owner = User::where('user_id', $vacation->OwnerId)->first();
            $ownerRole = optional($owner)->role;
            $isApproved = $vacation->is_vac_approved;
            $guestContact = null;

            $vacation->update(
                [
                    'is_vac_approved' => $isApproved === 0 ? 1 : 0,
                    'OwnerId' => $ownerRole === 'Guest' ? primary_user()->user_id : ($ownerRole === 'Administrator' ? $vacation->original_owner : $owner->user_id),
                    'BackGrndColor' => $ownerRole === 'Guest' ? '#FF5733' : ($ownerRole === 'Administrator' ? '#CCCCCC' : $vacation->BackGrndColor),
                ]
            );
            $recurringVacations = $vacation->recurrings;
            if (count($recurringVacations) > 0) {
                foreach ($recurringVacations as $recurringVacation) {
                    $recurringVacation->update([
                        'is_vac_approved' => $isApproved === 0 ? 1 : 0,
                        'OwnerId' => $ownerRole === 'Guest' ? primary_user()->user_id : ($ownerRole === 'Administrator' ? $vacation->original_owner : $owner->user_id),
                        'BackGrndColor' => $ownerRole === 'Guest' ? '#FF5733' : ($ownerRole === 'Administrator' ? '#CCCCCC' : $vacation->BackGrndColor),
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
                        'guest_vac_color' => $ownerRole === 'Guest' ? '#FF5733' : '#CCCCCC',
                        'is_approved' => $ownerRole === 'Guest' ? 1 : 0,
                    ]);

                }

            }

            // Approve vacation email
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
                } elseif ($vac_owner->role === 'Owner') {
                    $vacContent = $vacation->is_vac_approved === true ? 'Approved' : 'Unapproved';
                    $name = $vac_owner->first_name . ' ' . $vac_owner->last_name;
                    $email = $vac_owner->email;
                    $isApproved = $vacation->is_vac_approved === true ? 1 : 0;
                    $ccList[] = $email;
                    $ccList = array_unique(array_filter($ccList));

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
                return $this->sendError($e->getMessage(), []);
            }

            $response = [
                'success' => true,
                'data' => [
                    'vacations' => $vacation,
                ],
                'message' => $vacation->is_vac_approved === 1 ? 'Vacation approved successfully' : 'Vacation unapproved successfully',
            ];
            return response()->json($response, 200);


        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }
    }


    /**
     * Reject Vacation api
     *
     * @return \Illuminate\Http\Response
     */
    public function rejectVacation(Request $request)
    {
        try {
            $this->user = Auth::user();
            $vacationId = $request->vacationId;
            $vacation = Vacation::find($vacationId);
            if (!$vacation) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vacation not found or access denied.',
                ], 404);
            }

            $events = Vacation::where('VacationId', $vacationId)
                ->orWhere('parent_id', $vacationId)
                ->get();

            // Delete all the retrieved events
            foreach ($events as $event) {
                $event->delete();
            }

            // Reject Vacation Email
            $owner = User::where('user_id', $vacation->OwnerId)->first();
            $ownerRole = optional($owner)->role;
            $vacName = $vacation->VacationName;
            $this->startDate = $vacation->start_datetime->format('m-d-Y H:i');
            $this->endDate = $vacation->end_datetime->format('m-d-Y H:i');
            $name = null;
            $email = null;
            if ($ownerRole === 'Guest'){
                $guestContact = GuestContact::where([
                    'guest_id' => $vacation->original_owner,
                    'guest_vac_id' => $vacation->VacationId,
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

            $ccList = [];
            if ($this->user && primary_user()->email !== $this->user->email) {
                $ccList[] = $this->user->email;
            }
            $houseName = $owner->house->HouseName;
            $admin = $this->user;
            $ccList[] = $this->notificationEmail;
            $ccList = array_unique(array_filter($ccList));

            if ($this->notificationEmail){
                Notification::route('mail', $ccList)
                    ->notify(new VacationDeniedEmailNotification($ccList,$name,$email,$vacName,$admin,$houseName,$this->startDate,$this->endDate));
            }

            return response()->json([
                'success' => true,
                'message' => 'Vacation rejected successfully',
            ], 200);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), []);
        }

    }


}
