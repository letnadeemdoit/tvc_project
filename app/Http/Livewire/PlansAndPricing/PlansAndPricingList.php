<?php

namespace App\Http\Livewire\PlansAndPricing;

use App\Models\Audit\User;
use App\Models\ProcessingSubscription;
use App\Models\Subscription;
use Livewire\Component;
use Srmklive\PayPal\Facades\PayPal;

class PlansAndPricingList extends Component
{
    public $user;

    public $subscription;

    public function mount()
    {
        $this->subscription = Subscription::where([
            'user_id' => $this->user->user_id,
            'house_id' => $this->user->HouseId
        ])->whereNotIn('status', ['CANCELLED','IN_PROCESS','COMPLETED'])->latest()->first();
    }

    public function render()
    {
        return view('dash.plans-and-pricing.plans-and-pricing-list');
    }

    public function getApprovalPendingSubscriptionProperty()
    {

    }

    public function cancelSubscription()
    {
        $paypalsubscription = Subscription::where([
            'user_id' => auth()->user()->user_id,
            'status' => 'ACTIVE'
        ])->latest()->first();
        ProcessingSubscription::create([
            'subscription_id' => $paypalsubscription->id,
            'plan_id' => $paypalsubscription->plan_id,
            'plan' => $paypalsubscription->plan,
            'period' => $paypalsubscription->period,
            'status' => 'APPROVAL_PENDING',
        ]);
        $this->subscription->cancel();

        session()->flash('status', 'You have been unsubscribed successfully. You may see the status is not changed as soon as verified from paypal it will update automatically.');
        $this->redirect(route('dash.plans-and-pricing'));
    }
}
