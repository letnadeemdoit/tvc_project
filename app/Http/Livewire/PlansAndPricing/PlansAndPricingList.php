<?php

namespace App\Http\Livewire\PlansAndPricing;

use App\Models\Subscription;
use Livewire\Component;

class PlansAndPricingList extends Component
{
    public $user;

    public function render()
    {
        $subscription = $this->user->subscription;

        return view('dash.plans-and-pricing.plans-and-pricing-list', compact('subscription'));
    }

    public function cancelSubscription() {
        $this->user->subscription->cancel();
    }
}
