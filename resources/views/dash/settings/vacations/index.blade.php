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
                    var url = '{!! route('dash.schedule-vacation', ['vacationId' => '__vacationId__', 'initialDate' => '__initialDate__', 'owner' => '__owner__', 'vacationListRoute' => '__vacationListRoute__']) !!}';
                    url = url.replace('__vacationId__', null);
                    url = url.replace('__initialDate__', parsed.properties);
                    url = url.replace('__owner__', parsed.owner);
                    url = url.replace('__vacationListRoute__', 'vacationListRoute');
                    location.href = url;
{{--                        window.livewire.emit('showVacationScheduleModal', true, null, null, parsed.owner, parsed.properties)--}}
                    }"
                >
                    <i class="bi-clock me-1"></i> Schedule Vacation
                </a>
            </div>
            <div x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 4000)">
                @if (session()->has('successMessage'))
                    <div class="p-3 alert alert-success rounded">
                        {{ session()->get('successMessage') }}
                    </div>
                @endif
            </div>
        @endif
    </x-slot>
    <livewire:settings.vacations.vacations-list :user="$user" />
    {{--    @if($user->is_owner)--}}
{{--    <livewire:settings.vacations.schedule-vacation-form :user="$user" wire:key="svf{{ time() }}"/>--}}
    {{--    @endif--}}
</x-settings>
