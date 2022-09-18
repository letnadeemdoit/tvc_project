<?php

namespace App\Http\Livewire\Settings\Billing;

use App\Http\Livewire\Traits\Destroyable;
use App\Models\Subscription;
use Livewire\Component;
use Livewire\WithPagination;

class BillingList extends Component
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


    public function render()
    {
        $data = Subscription::where('house_id', $this->user->HouseId)
            ->when($this->search !== '', function ($query) {
                $query->where(function ($query) {
                    $query
                        ->where('plan', 'LIKE', "%$this->search%")
                        ->orWhere('period', 'LIKE', "%$this->search%")
                        ->orWhere('status', 'LIKE', "%$this->search%");
                });
            })
            ->latest()
            ->paginate($this->per_page);

        return view('dash.settings.billing.billing-list',compact('data'));
    }


}
