<x-app-layout>
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Plans &amp; Pricing</h1>
                </div>

{{--                <div class="col-sm-auto" x-data>--}}
{{--                    <a--}}
{{--                        class="btn btn-primary"--}}
{{--                        href="javascript:;"--}}
{{--                        @click.prevent="window.livewire.emit('showLocalGuideCUModal', true)"--}}
{{--                    >--}}
{{--                        <i class="bi-plus me-1"></i> Add New Local Guide--}}
{{--                    </a>--}}
{{--                </div>--}}

            </div>
        </div>
        @if(session()->has('status'))
            <div class="alert alert-soft-success" role="alert">
                {{ session()->get('status') }}
            </div>
        @endif
        <livewire:plans-and-pricing.plans-and-pricing-list :user="$user"/>

{{--        <livewire:local-guide.create-or-update-local-guide-form :user="$user"/>--}}

    </div>
</x-app-layout>
