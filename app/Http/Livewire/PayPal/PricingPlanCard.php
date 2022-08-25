<?php

namespace App\Http\Livewire\PayPal;

use Livewire\Component;

class PricingPlanCard extends Component
{
    public function render()
    {

        return view('dash.plans-and-pricing.partials.plan-and-pricing-card');

    }

    public function payPal(){

        dd("ok");

    }

}
