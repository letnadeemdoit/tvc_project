<?php

namespace App\Http\Livewire\PlansAndPricing;

use App\Models\Audit\User;
use App\Models\Subscription;
use Livewire\Component;

class PlansAndPricingList extends Component
{
    public $user;

    public $subscription;

    public function mount()
    {
        $this->subscription = Subscription::where([
            'user_id' => $this->user->user_id,
            'house_id' => $this->user->HouseId,
            ['status', '<>', 'CANCELLED']
        ])->latest()->first();
    }

    public function render()
    {
        return view('dash.plans-and-pricing.plans-and-pricing-list');
    }

    public function getApprovalPendingSubscriptionProperty() {

    }

    public function cancelSubscription()
    {
        $this->subscription->cancel();

        session()->flash('status', 'You have been unsubscribed successfully. You may see the status is not changed as soon as verified from paypal it will update automatically.');
        $this->redirect(route('dash.plans-and-pricing'));
    }
}
