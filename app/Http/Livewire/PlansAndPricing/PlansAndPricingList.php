<?php

namespace App\Http\Livewire\PlansAndPricing;

use App\Models\Subscription;
use Livewire\Component;

class PlansAndPricingList extends Component
{
    public $user;

    public $subscription;

    public function mount()
    {
        $this->subscription = $this->user->subscription;
    }

    public function render()
    {
        return view('dash.plans-and-pricing.plans-and-pricing-list');
    }

    public function cancelSubscription()
    {
        $this->subscription->cancel();

        session()->flash('status', 'You have been unsubscribed successfully.');
        $this->redirect(route('dash.plans-and-pricing'));
    }
}
