<x-dashboard-layout>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item active" aria-current="page">Calendar</li>
    </x-slot>
    <x-slot name="title">
        <h1 class="page-header-title">Calendar</h1>
    </x-slot>

    <x-slot name="headerRightActions">
        @if($user->is_owner)
            <div class="col-sm-auto" x-data>
                <a
                    class="btn btn-primary"
                    href="javascript:;"
                    @click.prevent="window.livewire.emit('showVacationScheduleModal', true)"
                >
                    <i class="bi-clock me-1"></i> Schedule Vacation
                </a>
            </div>
        @endif
    </x-slot>

    <livewire:settings.vacations.schedule-vacation-form :user="$user" />
    <livewire:settings.vacations.request-to-join-vacation-form :user="$user" />
    <livewire:calendar.calendar-view :user="$user" />


</x-dashboard-layout>
