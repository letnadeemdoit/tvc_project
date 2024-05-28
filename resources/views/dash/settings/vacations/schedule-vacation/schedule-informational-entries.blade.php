<x-dashboard-layout>
    @push('stylesheets')
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    @endpush
    <x-slot name="title">
        <h1 class="page-header-title">Schedule Calendar Task</h1>
    </x-slot>

    <div>
        <div>
            <livewire:settings.vacations.schedule-informational-entries-form :user="$user" :vacationId="$vacationId" wire:key="vsvf{{time()}}"/>
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
                    var url = "{!! route('dash.calendar', ['VacationId' => '__VacationId__','VacationName' => '__VacationName__']) !!}";
                    url = url.replace('__VacationId__', e.detail.VacationId);
                    url = url.replace('__VacationName__', e.detail.VacationName);
                    location.href = url;
                    // window.location.href = url;
                });
            })
        </script>
    @endpush
</x-dashboard-layout>
