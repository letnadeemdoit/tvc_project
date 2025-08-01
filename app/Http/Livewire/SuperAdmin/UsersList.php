<?php

namespace App\Http\Livewire\SuperAdmin;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersList extends Component
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
        $user->update(['is_confirmed' => !!$toggle]);
        $this->emitSelf('user-cu-successfully');
        $this->emitSelf('saved-' . $user->user_id);
    }

    public function render()
    {
        $data = User::when($this->search !== '', function ($query) {
                $query->where(function ($query) {
                    $query
                        ->where('user_name', 'LIKE', "%$this->search%")
                        ->orWhere('first_name', 'LIKE', "%$this->search%")
                        ->orWhere('last_name', 'LIKE', "%$this->search%")
                        ->orWhere('email', 'LIKE', "%$this->search%");
                });
            })
            ->orderBy('created_at', 'DESC')
            ->paginate($this->per_page);

        return view('dash.super-admin.users-list', compact('data'));
    }
}
