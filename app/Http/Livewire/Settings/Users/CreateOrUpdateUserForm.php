<?php

namespace App\Http\Livewire\Settings\Users;

use App\Http\Livewire\Traits\Toastr;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class CreateOrUpdateUserForm extends Component
{
    use AuthorizesRequests;
    use Toastr;

    public $user;

    public $state = [];

    public ?User $userCU;

    public $isCreating = false;

    protected $listeners = [
        'showUserCUModal'
    ];

    public function render()
    {
        $isGuestAlreadyExists = User::where([
            'role' => User::ROLE_GUEST,
            'HouseId' => $this->user->HouseId
        ])
            ->exists();
        return view('dash.settings.users.create-or-update-user-form', compact('isGuestAlreadyExists'));
    }

    public function showUserCUModal($toggle, ?User $userCU)
    {
        if (! Gate::any(['create', 'update'], $userCU)) {
            abort(403);
        }

        $this->emitSelf('toggle', $toggle);
        $this->userCU = $userCU;
        $this->reset('state');

        if ($userCU->user_id) {
            $this->isCreating = false;
            $this->state = [
                'user_name' => $userCU->user_name,
                'first_name' => $userCU->first_name,
                'last_name' => $userCU->last_name,
                'email' => $userCU->email,
                'role' => $userCU->role,
            ];
        } else {
            $this->isCreating = true;
            $this->state = [
                'role' => User::ROLE_OWNER,
            ];
        }
    }

    public function saveUserCU()
    {
        $this->resetErrorBag();

        Validator::make($this->state, [
            'user_name' => [
                'required',
                $this->userCU && $this->userCU->user_name ? Rule::unique('users', 'user_name')->where(function ($query) {
                    $query->where('HouseId', $this->user->HouseId);
                })->ignore($this->userCU->user_id, 'user_id') : Rule::unique('users', 'user_name')->where(function ($query) {
                    $query->where('HouseId', $this->user->HouseId);
                })],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                $this->userCU && $this->userCU->user_name ? Rule::unique('users')->where(function ($query) {
                    $query->where('HouseId', $this->user->HouseId);
                })->ignore($this->userCU->user_id, 'user_id') : Rule::unique('users')->where(function ($query) {
                    $query->where('HouseId', $this->user->HouseId);
                })
            ],
            'role' => ['required'],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'password' => [$this->userCU && $this->userCU->user_name ? 'nullable' : 'required', (new \Laravel\Fortify\Rules\Password)->requireNumeric()->requireUppercase()->requireSpecialCharacter(), 'confirmed'],
        ])->validateWithBag('saveUserCU');

        if (isset($this->state['password'])) {
            $this->userCU->password = \Hash::make($this->state['password']);
            $this->userCU->old_password = \Hash::make($this->state['password']);
        }

        $this->userCU->fill([
            'user_name' => $this->state['user_name'],
            'email' => $this->state['email'],
            'role' => $this->state['role'],
            'first_name' => $this->state['first_name'],
            'last_name' => $this->state['last_name'],
            'HouseId' => $this->user->HouseId,
        ])->save();

        $this->emitSelf('toggle', false);
        $this->emit('user-cu-successfully');

        $this->success( 'User ' .($this->isCreating ? 'created' : 'updated'). ' successfully.');
    }
}
