<x-settings>
    <x-slot name="title">
        Vacations
    </x-slot>
    <x-slot name="headerRightActions">
        @if($user->is_owner)
            <div
                class="col-sm-auto"
                x-data=""
            >
                <a
                    class="btn btn-primary"
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
    <livewire:settings.vacations.vacations-list :user="$user" />
    {{--    @if($user->is_owner)--}}
    <livewire:settings.vacations.schedule-vacation-form :user="$user" wire:key="svf{{ time() }}"/>
    {{--    @endif--}}
</x-settings>
