<x-settings>
    <x-slot name="title">
        Vacations
    </x-slot>
    <x-slot name="headerRightActions">
        <div class="col-sm-auto" x-data>
            <a
                class="btn btn-primary"
                href="javascript:;"
                @click.prevent="window.livewire.emit('showVacationScheduleModal', true)"
            >
                <i class="bi-clock me-1"></i> Schedule Vacation
            </a>
        </div>
    </x-slot>
    <livewire:settings.vacations.vacations-list :user="$user" />
    <livewire:settings.vacations.schedule-vacation-form :user="$user" />
</x-settings>
