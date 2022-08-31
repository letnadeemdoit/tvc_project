<x-settings>
    <x-slot name="title">
        Vacations
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
    <livewire:settings.vacations.vacations-list :user="$user" />

{{--    @if($user->is_owner)--}}
        <livewire:settings.vacations.schedule-vacation-form :user="$user" />
{{--    @endif--}}
</x-settings>
