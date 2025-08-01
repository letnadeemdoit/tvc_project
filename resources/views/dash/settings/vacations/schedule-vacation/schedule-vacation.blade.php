<x-dashboard-layout>
    @push('stylesheets')
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    @endpush
    <x-slot name="title">
        <h1 class="page-header-title">Schedule Vacation</h1>
    </x-slot>

    <div>
        <div>
            <livewire:settings.vacations.schedule-vacation-form :user="$user" :vacationId="$vacationId" :initialDate="$initialDate" :owner="$owner" :vacationListRoute="$vacationListRoute" wire:key="vsvf{{time()}}"/>
        </div>
    </div>

    @push('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript"
           src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
            <script>
                $(function () {
                    window.addEventListener('destroyed-successfully', function (e) {
                        console.log(e.detail);
                        var url = "{!! route('dash.calendar', ['VacationId' => '__VacationId__','VacationName' => '__VacationName__','OwnerId' => '__OwnerId__']) !!}";
                        url = url.replace('__VacationId__', e.detail.VacationId);
                        url = url.replace('__VacationName__', e.detail.VacationName);
                        url = url.replace('__OwnerId__', e.detail.OwnerId);
                        location.href = url;
                        // window.location.href = url;
                    });
                })
                </script>
    @endpush
</x-dashboard-layout>
