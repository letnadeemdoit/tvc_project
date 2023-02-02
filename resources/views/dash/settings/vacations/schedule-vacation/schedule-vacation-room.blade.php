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
    @endpush
</x-dashboard-layout>
