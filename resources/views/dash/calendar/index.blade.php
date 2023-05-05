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
{{--        @if($user->is_owner)--}}
        @if(!$user->is_guest)
            <div class="col-sm-auto">

                <button type="button" class="btn btn-outline-secondary mb-2 mb-lg-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Add to your Calendar
                </button>


                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <input type="text" value="{{ $iCalUrl }}" id="addToYourCalendar" class="form-control mb-3" readonly>
                                <button
                                    x-data="{copied: false}"
                                    class="btn btn-sm btn-outline-secondary mb-2 mb-lg-0"
                                    @click.prevent="() => {
                                        $clipboard('{{ $iCalUrl }}');
                                        copied = true;
                                        document.getElementById('addToYourCalendar').select();
                                        setTimeout(() => {
                                            copied = false;
                                        }, 2000);

                                    }"
                                    x-bind:disabled="copied"
                                >
                                    <i class="bi-clipboard me-1" x-show="!copied"></i>
                                    <i class="bi-clipboard-check-fill me-1 text-primary" style="display: none" x-show="copied"></i>

                                    <span class="" x-show="!copied"> Copy to clipboard</span>
                                    <span class="me-1 text-primary" style="display: none" x-show="copied">Copied!</span>

                                </button>
                            </div>

                        </div>
                    </div>
                </div>


                <a
                    x-data
                    class="btn btn-primary mb-2 mb-lg-0"
                    href="javascript:;"
                    @click.prevent="() => {
                             let parsed = queryString.parse(window.location.search);
                             var url = '{!! route('dash.schedule-vacation', ['vacationId' => '__vacationId__', 'initialDate' => '__initialDate__', 'owner' => '__owner__']) !!}';
                             url = url.replace('__vacationId__', null);
                             url = url.replace('__initialDate__', parsed.properties);
                             url = url.replace('__owner__', parsed.owner);
                             location.href = url;
{{--                        let parsed = queryString.parse(window.location.search);--}}
{{--                        window.livewire.emit('showVacationScheduleModal', true, null, null, parsed.owner, parsed.properties)--}}
                    }"
                >
                    <i class="bi-clock me-1"></i> Schedule Vacation
                </a>
            </div>
        @endif
    </x-slot>
        <div x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 4000)">
            @if (session()->has('successMessage'))
                <div class="p-3 alert alert-success rounded">
                    {{ session()->get('successMessage') }}
                </div>
            @endif
        </div>
{{--        @if (Session::has('successMessage'))--}}
{{--            <div class="alert alert-success">{{ Session::get('successMessage') }}</div>--}}
{{--        @endif--}}
    <div>
        <livewire:calendar.calendar-view :user="$user"/>
        <div>
{{--            <livewire:settings.vacations.schedule-vacation-form :user="$user" :data="null" wire:key="vsvf{{time()}}"/>--}}
        </div>

        <div>
{{--            <livewire:settings.vacations.schedule-vacation-room-form :user="$user" wire:key="vsvrf{{time()}}"/>--}}
        </div>

        <div>
{{--            <livewire:settings.vacations.request-to-join-vacation-form :user="$user" wire:key="rtjvf{{time()}}"/>--}}
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript"
                src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    @endpush
</x-dashboard-layout>
