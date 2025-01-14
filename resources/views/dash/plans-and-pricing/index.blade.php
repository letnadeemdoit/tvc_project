<x-dashboard-layout>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item active" aria-current="page">Plans &amp; Pricing</li>
    </x-slot>
    <x-slot name="title">
        <h1 class="page-header-title">Plans &amp; Pricing</h1>
    </x-slot>

{{--    @if(session()->has('status'))--}}
{{--        <div class="alert alert-soft-success" role="alert">--}}
{{--            {{ session()->get('status') }}--}}
{{--        </div>--}}
{{--    @endif--}}

    @if(session()->has('status'))
        <div class="alert alert-soft-success d-flex justify-content-between align-items-center" role="alert">
            <span>{{ session()->get('status') }}</span>
            @if(session()->get('status') === 'A subscription with PayPal is already in process which needs to be reset. Click “Reset” below to connect your account with PayPal')
                <a href="{{ route('paypal.reset') }}"
                   class="btn btn-outline-primary">Reset</a>
            @endif
        </div>
    @endif

    <livewire:plans-and-pricing.plans-and-pricing-list :user="$user"/>

</x-dashboard-layout>


