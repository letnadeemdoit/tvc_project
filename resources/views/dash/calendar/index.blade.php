<x-dashboard-layout>
    @push('stylesheets')
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    @endpush
    <x-slot name="breadcrumbs">
        {{--        <li class="breadcrumb-item active" aria-current="page">Calendar</li>--}}
    </x-slot>
    <x-slot name="title">
        <h1 class="page-header-title">Calendar</h1>
    </x-slot>

    <x-slot name="headerRightActions">
        @if($user->is_owner)
            <div class="col-sm-auto">
                <button
                    x-data="{copied: false}"
                    class="btn btn-outline-secondary mb-2 mb-lg-0"
                    @click.prevent="() => {
                        $clipboard('{{ $iCalUrl }}');
                        copied = true;
                        setTimeout(() => {
                            copied = false;
                        }, 2000);

                    }"
                    x-bind:disabled="copied"
                >
                    <i class="bi-clipboard me-1" x-show="!copied"></i>
                    <i class="bi-clipboard-check-fill me-1" style="display: none" x-show="copied"></i>
                    Copy ICS Link
                </button>
                <a
                    x-data
                    class="btn btn-primary mb-2 mb-lg-0"
                    href="javascript:;"
                    @click.prevent="() => {
                        let parsed = queryString.parse(window.location.search);
                        window.livewire.emit('showVacationScheduleModal', true, null, null, parsed.owner, parsed.properties)
                    }"
                >
                    <i class="bi-clock me-1"></i> Schedule Vacation
                </a>
            </div>
        @endif
    </x-slot>
    <div>
        <livewire:calendar.calendar-view :user="$user"/>
        <div>
            <livewire:settings.vacations.schedule-vacation-form :user="$user" wire:key="vsvf{{time()}}"/>
        </div>
        <div>
            <livewire:settings.vacations.request-to-join-vacation-form :user="$user" wire:key="rtjvf{{time()}}"/>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript"
                src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    @endpush
</x-dashboard-layout>
