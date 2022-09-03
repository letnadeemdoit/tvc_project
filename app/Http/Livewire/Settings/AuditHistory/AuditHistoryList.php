<?php

namespace App\Http\Livewire\Settings\AuditHistory;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\Board;
use Livewire\Component;
use Livewire\WithPagination;
use OwenIt\Auditing\Models\Audit;

class AuditHistoryList extends Component
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
        'audit-cu-successfully' => '$refresh',
    ];

    public function mount()
    {
        $this->model = Audit::class;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        $data = Audit::where('house_id', $this->user->HouseId)
            ->when($this->search !== '', function ($query) {
                $query->where(function ($query) {
                    $query
                        ->where('event', 'LIKE', "%$this->search%");
                });
            })
            ->latest()
            ->paginate($this->per_page);

        return view('dash.settings.audit-history.audit-history-list',compact('data'));

    }
}
