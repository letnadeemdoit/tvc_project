<x-guest-layout>

    @push('stylesheets')
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
        <style>
            .toast-success{
                background-color: #51A351 !important;
            }
        </style>

    @endpush

        @if(!auth()->user()->is_admin && !is_any_subscribed())
            @include('partials.sub-page-hero-section', ['title' => 'Subscription Expired!'])
        @else
            @include('partials.sub-page-hero-section', ['title' => 'Calendar'])
        @endif

    <div class="container py-5">

        <div id="calendarMessage">
            @if(!auth()->user()->is_admin && !is_any_subscribed())
                @php
                    $admin = \App\Models\User::where([
                        'HouseId' => primary_user()->HouseId,
                        'role' => 'Administrator',
                    ])->first();
                @endphp
                <h3>No Active Subscription</h3>
                <br />
                <p class="alert alert-warning">This account does not have an active subscription. Please contact the house Administrator <strong>({{$admin['first_name'] . ' ' . $admin['last_name'] . ' - ' . $admin['email']}})</strong> to set up an active subscription</p>
{{--                    <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('warnMessage') }}</p>--}}
            @elseif(auth()->user()->is_admin && !is_any_subscribed())
                <p class="alert alert-warning">Currently there is no subscription plan. Please subscribe any plan. <a href="{{route('dash.plans-and-pricing')}}">plans-and-pricing</a></p>

            @endif
        </div>
        @if($user->is_owner && is_any_subscribed())
            <div class="text-end mb-3">

                <button type="button" class="btn btn-outline-secondary mb-2 mb-lg-0" data-bs-toggle="modal"
                        data-bs-target="#addToYourCalendarModal">
                    Add to your Calendar
                </button>

                <!-- Modal -->
                <div class="modal fade" id="addToYourCalendarModal" data-bs-backdrop="static" data-bs-keyboard="false"
                     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <input type="text" value="{{ $iCalUrl }}" id="addToYourCalendar"
                                       class="form-control mb-3" readonly>

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
                                    <i class="bi-clipboard-check-fill me-1 text-primary" style="display: none"
                                       x-show="copied"></i>

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
                    window.livewire.emit('showVacationScheduleModal', true, null, null, parsed.owner, parsed.properties)
                }"
                >
                    <i class="bi-clock me-1"></i> Schedule Vacation
                </a>
            </div>
        @endif

        <div class="card shadow-none">
            @if(is_any_subscribed())
            <div class="card-body">
                <livewire:calendar.calendar-view :user="$user"/>
                <div>
                    <livewire:settings.vacations.schedule-vacation-form :user="$user" wire:key="vsvf{{time()}}"/>
                </div>

                <div>
                    <livewire:settings.vacations.schedule-vacation-room-form :user="$user" wire:key="vsvrf{{time()}}"/>
                </div>
                <div>
                    <livewire:settings.vacations.request-to-join-vacation-form :user="$user"
                                                                               wire:key="rtjvf{{time()}}"/>
                </div>
            </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript"
                src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

{{--        <script>--}}
{{--            setTimeout(function() {--}}
{{--                $('#calendarMessage').fadeOut('fast');--}}
{{--            }, 5000);--}}
{{--        </script>--}}
    @endpush


</x-guest-layout>
