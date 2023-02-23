<x-dashboard-layout>
    @push('stylesheets')
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    @endpush
    <x-slot name="title">
        <h1 class="page-header-title">Schedule Vacation Room</h1>
    </x-slot>

    <div>
        <div>
            <livewire:settings.vacations.schedule-vacation-room-form :user="$user" :roomId="$roomId" :vacationRoomId="$vacationRoomId" :initialDate="$initialDate" :owner="$owner" wire:key="vsvf{{time()}}"/>
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
                        var url = "{!! route('dash.calendar', ['VacationId' => '__VacationId__','RoomId' => '__RoomId__','SetStartDate' => '__SetStartDate__']) !!}";
                        url = url.replace('__VacationId__', e.detail.vacation_id);
                        url = url.replace('__RoomId__', e.detail.room_id);
                        url = url.replace('__SetStartDate__', e.detail.starts_at);
                        location.href = url;
                        // window.location.href = url;
                    });
                })
            </script>
    @endpush
</x-dashboard-layout>
