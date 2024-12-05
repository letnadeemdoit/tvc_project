<?php

namespace App\Http\Livewire\Settings\Users;

use App\Http\Livewire\Traits\Toastr;
use App\Models\House;
use App\Models\User;
use App\Notifications\CalendarEmailNotification;
use App\Notifications\CreateUserEmailNotification;
use App\Notifications\NewUserAccountNotification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class CreateOrUpdateUserForm extends Component
{
    use AuthorizesRequests;
    use Toastr;

    public $state = [];

    public ?User $userCU;

    public ?User $user;

    public $new_houseid = null;

    public $current_houses = null;

    public $isCreating = false;

    protected $listeners = [
        'showUserCUModal'
    ];

    public function render()
    {

        $isGuestAlreadyExists = User::where([
            'role' => User::ROLE_GUEST,
            'HouseId' => $this->state['house_id'] ?? $this->user->HouseId
        ])
            ->exists();
        return view('dash.settings.users.create-or-update-user-form', compact('isGuestAlreadyExists'));
    }

    public function showUserCUModal($toggle, $user = null)
    {
        $userCU = User::find($user);
        if ($user === null) {
            $userCU = new User();
        } else if (is_int($user) && $userCU === null) {
            $this->warning('Sorry! unable to find user. If you deleted the and see this message again and again please refresh the page.');
            return;
        }
        if (!Gate::any(['create', 'update'], $userCU)) {
            abort(403);
        }

        $this->emitSelf('toggle', $toggle);
        $this->userCU = $userCU;
        $this->reset('state');

        if ($userCU->user_id) {
            $this->isCreating = false;
            if ($userCU->role !== 'Guest'){
                $user = User::where('parent_id', $userCU->parent_id)->where('role', $userCU->role)->where('email', $userCU->email)->get();
//                $this->state = [
//                    'house_id' => $userCU->pluck('HouseId')->toArray(),
//                ];
                $this->state = [
                    'user_name' => $userCU->user_name,
                    'first_name' => $userCU->first_name,
                    'last_name' => $userCU->last_name,
                    'email' => $userCU->email,
                    'house_id' => $user->pluck('HouseId')->toArray(),
                    'role' => $userCU->role,
                ];
                $this->current_houses  = $user->pluck('HouseId')->toArray();
            }
            elseif ($userCU->role === 'Guest'){
                $this->state = [
                    'house_id' => $userCU->HouseId,
                    'role' => $userCU->role,
                ];
            }
//            elseif ($userCU->role === 'Administrator') {
//                $this->state = [
//                    'house_id' => $userCU->HouseId,
//                    'role' => $userCU->role,
//                    'user_name' => $userCU->user_name,
//                    'first_name' => $userCU->first_name,
//                    'last_name' => $userCU->last_name,
//                    'email' => $userCU->email,
//                ];
//            }
//            $this->state = [
//                'user_name' => $userCU->user_name,
//                'first_name' => $userCU->first_name,
//                'last_name' => $userCU->last_name,
//                'email' => $userCU->email,
//                'house_id' => $userCU->HouseId,
//                'role' => $userCU->role,
//            ];
        } else {
            $this->isCreating = true;
            $this->state = [
                'role' => User::ROLE_OWNER,
            ];
        }
    }
    public function confirmUserVac(){
        if (!$this->isCreating && $this->state['role'] !== User::ROLE_GUEST){
            $difference = array_diff($this->current_houses,$this->state['house_id']);
            $result = array_values($difference);
            if (count($result) > 0){
                if (array_diff( $result ,$this->current_houses)){
                    $this->saveUserCU();
                }else{
                    $this->dispatchBrowserEvent('sure-to-update',['data' => null]);
                }
            }else{
                $this->saveUserCU();
            }
        }
        else{
            $this->saveUserCU();
        }
    }

    public function saveUserCU()
    {
        $this->resetErrorBag();
        if (isset($this->state['role']) && $this->state['role'] === User::ROLE_GUEST) {
            $this->state['user_name'] = 'Guest';
            $this->state['first_name'] = 'House';
            $this->state['last_name'] = 'Guest';
            $this->state['email'] = 'guest@thevacationcalendar.com';
        }
        if (!$this->isCreating && isset($this->state['role']) && $this->state['role'] !== User::ROLE_GUEST) {
            $users = User::whereIn('HouseId', $this->state['house_id'])
                ->where([
                    'parent_id' => primary_user()->user_id,
                    'role' => $this->state['role'],
                    'email' => $this->userCU->email
                ])
                ->get();
            foreach ($users as $user){
                $this->new_houseid = $user->HouseId;
                Validator::make($this->state, [
                    'user_name' => [
                        'required',
                        $user && $user->user_name ? Rule::unique('users','user_name')->where(function ($query) {
                            $query->where('HouseId', $this->new_houseid);
                        })->ignore($user->user_id, 'user_id') : Rule::unique('users','user_name')->where(function ($query) {
                            $query->where('HouseId',$this->new_houseid);
                        })],
                    'email' => [
                        Rule::requiredIf(isset($this->state['role']) && $this->state['role'] !== User::ROLE_GUEST),
                        'string',
                        'email',
                        'max:255',
                        $user && $user->email ? Rule::unique('users')->where(function ($query) {
                            $query->where('HouseId', $this->new_houseid);
                        })->ignore($user->user_id, 'user_id') : Rule::unique('users')->where(function ($query) {
                            $query->where('HouseId',$this->new_houseid);
                        })
                    ],
                    'role' => ['required'],
                    'house_id' => ['required'],
                    'first_name' => ['required', 'string', 'max:100'],
                    'last_name' => ['required', 'string', 'max:100'],
                    'password' => [$this->userCU && $this->userCU->user_name ? 'nullable' : 'required', (new \Laravel\Fortify\Rules\Password)->requireNumeric()->requireUppercase()->requireSpecialCharacter(), 'confirmed'],
                ])->validateWithBag('saveUserCU');

            }
        }
        else if((!$this->isCreating && (isset($this->state['role']) && $this->state['role'] !== User::ROLE_GUEST)) || $this->isCreating){
            Validator::make($this->state, [
                'user_name' => [
                    'required',
                    $this->userCU && $this->userCU->user_name ? Rule::unique('users', 'user_name')->where(function ($query) {
                        $query->where('HouseId', $this->state['house_id'] ?? $this->user->HouseId);
                    })->ignore($this->user->user_id, 'user_id') : Rule::unique('users', 'user_name')->where(function ($query) {
                        $query->where('HouseId',$this->state['house_id'] ?? $this->user->HouseId);
                    })],
                'email' => [
                    Rule::requiredIf(isset($this->state['role']) && $this->state['role'] !== User::ROLE_GUEST),
                    'string',
                    'email',
                    'max:255',
                    $this->userCU && $this->userCU->user_name ? Rule::unique('users')->where(function ($query) {
                        $query->where('HouseId', $this->state['house_id'] ?? $this->user->HouseId);
                    })->ignore($this->userCU->user_id, 'user_id') : Rule::unique('users')->where(function ($query) {
                        $query->where('HouseId',$this->state['house_id'] ?? $this->user->HouseId);
                    })
                ],
                'role' => ['required'],
                'house_id' => ['required'],
                'first_name' => ['required', 'string', 'max:100'],
                'last_name' => ['required', 'string', 'max:100'],
                'password' => [$this->userCU && $this->userCU->user_name ? 'nullable' : 'required', (new \Laravel\Fortify\Rules\Password)->requireNumeric()->requireUppercase()->requireSpecialCharacter(), 'confirmed'],
            ])->validateWithBag('saveUserCU');
        }

        if (isset($this->state['password'])) {
            $sendPasswordToMail = $this->state['password'];
            $this->userCU->password = \Hash::make($this->state['password']);
            $this->userCU->old_password = \Hash::make($this->state['password']);
        }

        if ($this->user->primary_account == 1) {
            $this->userCU->parent_id = $this->user->user_id;
        } else {
            $this->userCU->parent_id = $this->user->parent_id;
        }
        if (isset($this->state['house_id']) && is_array($this->state['house_id']) && count($this->state['house_id']) > 0 && !$this->isCreating && (isset($this->state['role']) && $this->state['role'] !== User::ROLE_GUEST)){
            foreach ($this->state['house_id'] as $houseId) {
                $user = User::where([
                    'parent_id' => $this->userCU->parent_id,
                    'HouseId' => $houseId,
                ])
                    ->where(function ($query) {
                        $query->where('role', $this->state['role'])
                            ->orWhere('role', $this->userCU->role);
                    })
                    ->where(function ($query) {
                        $query->where('email', $this->state['email'])
                            ->orWhere('email', $this->userCU->email);
                    })
                    ->first();
                if (!$user) {
                    $newUser = new User();
                    $newUser->fill([
                        ...$this->userCU->toArray(),
                        'user_id' => null,
                        'password' => $this->userCU->password,
                        'HouseId' => $houseId,
                        'user_name' => $this->state['user_name'],
                        'email' => $this->state['email'] ?? null,
                        'role' => $this->state['role'],
                        'first_name' => $this->state['first_name'],
                        'last_name' => $this->state['last_name'],
                    ])->save();
                }
                else{
                    $user->update([
                        'user_name' => $this->state['user_name'],
                        'first_name' => $this->state['first_name'],
                        'last_name' => $this->state['last_name'],
                        'password' => $this->userCU->password,
                        'email' => $this->state['email'],
                        'role' => $this->state['role'],
                    ]);
                }
            }

                $users = User::whereNotIn('HouseId', $this->state['house_id'])
                    ->where([
                    'parent_id' => $this->userCU->parent_id,
                ])
                    ->where(function ($query) {
                        $query->where('role', $this->state['role'])
                            ->orWhere('role', $this->userCU->role);
                    })
                    ->where(function ($query) {
                        $query->where('email', $this->state['email'])
                            ->orWhere('email', $this->userCU->email);
                    })
                    ->get();
                if (count($users) > 0) {
                    foreach ($users as $user){
                        $user->delete();
                    }
                }

        }
        elseif (isset($this->state['house_id']) && is_array($this->state['house_id']) && count($this->state['house_id']) > 0 && $this->isCreating && (isset($this->state['role']) && $this->state['role'] !== User::ROLE_GUEST)){
            foreach ($this->state['house_id'] as $houseId) {
                $newUser = new User();
                $newUser->fill([
                    ...$this->userCU->toArray(),
                    'user_name' => $this->state['user_name'],
                    'password' => $this->userCU->password,
                    'email' => $this->state['email'] ?? null,
                    'role' => $this->state['role'],
                    'first_name' => $this->state['first_name'],
                    'last_name' => $this->state['last_name'],
                    'HouseId' => $houseId,
                ])->save();
            }

            if(is_array($this->state['house_id'])){
                $stateHouseId = $this->state['house_id'][0];
            }
            else{
                $stateHouseId = $this->state['house_id'];
            }

            $houseName = House::where('HouseID', $stateHouseId ?? $this->user->HouseId)->value('HouseName');

            $createUser = $newUser;

            try {
                if (isset($this->state['send_email']) && $this->state['send_email'] == 1) {
                    if (isset($sendPasswordToMail) && !is_null($sendPasswordToMail)) {

                        Notification::route('mail', $createUser['email'])
                            ->notify(new CreateUserEmailNotification($createUser, $sendPasswordToMail,$houseName));

//                        $createUser->notify(new CreateUserEmailNotification($createUser, $sendPasswordToMail,$houseName));
                    }
                }
            } catch (\Exception $e) {

            }


        }
        else{
            if(is_array($this->state['house_id'])){
                $stateHouseId = $this->state['house_id'][0];
            }
            else{
                $stateHouseId = $this->state['house_id'];
            }
            $this->userCU->fill([
//            'parent_id' => $this->user->primary_account ? $this->user->user_id : $this->user->parent_id,
                'user_name' => $this->state['user_name'],
                'password' => $this->userCU->password,
                'email' => $this->state['email'] ?? null,
                'role' => $this->state['role'],
                'first_name' => $this->state['first_name'],
                'last_name' => $this->state['last_name'],
//                'HouseId' => $this->state['house_id'][0] ?? $this->user->HouseId,
                'HouseId' => $stateHouseId ?? $this->user->HouseId,
            ])->save();

            $createUser = $this->userCU;

            $houseName = House::where('HouseID', $stateHouseId ?? $this->user->HouseId)->value('HouseName');

            try {
                if (isset($this->state['send_email']) && $this->state['send_email'] == 1) {
                    if (isset($sendPasswordToMail) && !is_null($sendPasswordToMail)) {
                        Notification::route('mail', $createUser['email'])
                            ->notify(new CreateUserEmailNotification($createUser, $sendPasswordToMail,$houseName));
//                        $createUser->notify(new CreateUserEmailNotification($createUser, $sendPasswordToMail,$houseName));
                    }
                }
            } catch (\Exception $e) {

            }
        }

//        $this->user = null;
        $this->userCU = null;

        $this->emitSelf('toggle', false);
        $this->emit('user-cu-successfully');

        $this->dispatchBrowserEvent('confirm-to-update',['data' => null]);
        $this->success('User ' . ($this->isCreating ? 'created' : 'updated') . ' successfully.');
    }
}
