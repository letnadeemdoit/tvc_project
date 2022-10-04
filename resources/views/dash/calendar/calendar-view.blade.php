<div>
    <div class="row align-items-sm-center mb-4">
        <div class="col-lg-6 mb-2 mb-lg-0">
            <div class="d-flex align-items-center">
                <button
                    type="button"
                    class="btn btn-white me-3"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title=""
                    data-fc-today
                >
                    Today
                </button>

                <button
                    type="button"
                    class="btn btn-ghost-secondary btn-icon btn-sm btn-no-focus rounded-circle me-1"
                    data-fc-prev-month
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Previous month"
                >
                    <i class="bi-chevron-left"></i>
                </button>

                <button
                    type="button"
                    class="btn btn-ghost-secondary btn-icon btn-sm btn-no-focus rounded-circle ms-1"
                    data-fc-next-month
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Next month"
                >
                    <i class="bi-chevron-right"></i>
                </button>

                <div class="ms-3">
                    <h5 class="h4 mb-0" data-fc-title wire:ignore></h5>
                </div>
            </div>
        </div>
        <!-- End Col -->

        <div class="col-lg-6">
            <div class="d-flex justify-content-lg-end">
                @if($user->is_owner && !$user->is_owner_only)
                    <div class="dropdown ms-1">
                        <button type="button" class="btn btn-white dropdown-toggle w-100"
                                id="usersExportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi-people-fill me-2"></i>
                            Owner: {{ $this->owner ? optional(\App\Models\User::where('user_id', $this->owner)->where('HouseId', $this->user->HouseId)->first())->name : 'You' }}
                        </button>

                        <div class="dropdown-menu dropdown-menu-sm-end" aria-labelledby="usersExportDropdown" style="">
                            <span class="dropdown-header">You</span>
                            <a id="you{{ $user->user_id }}" class="dropdown-item {{ $this->owner ?: 'active' }}"
                               href="#" wire:click.prevent="$set('owner', null)">
                                <img class="avatar avatar-xss avatar-4x3 me-2" src="{{ $user->profile_photo_url }}"
                                     alt="{{ $user->name }}">
                                {{ $user->name }}
                            </a>
                            <span class="dropdown-header">Owners</span>
                            @foreach($this->owners as $owner)
                                <a id="owner{{ $owner->user_id }}"
                                   class="dropdown-item {{ $this->owner === $owner->user_id ? 'active' : '' }}" href="#"
                                   wire:click.prevent="$set('owner', {{ $owner->user_id }})">
                                    <img class="avatar avatar-xss avatar-4x3 me-2" src="{{ $owner->profile_photo_url }}"
                                         alt="{{ $owner->name }}">
                                    {{ $owner->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if($user->is_admin)
                    <div class="dropdown ms-1">
                        <button type="button" class="btn btn-primary dropdown-toggle" id="dropdownMenuProperties"
                                data-bs-toggle="dropdown" aria-expanded="false" data-offset="10,20">
                            Properties: {{ $properties ? 'Customized' : 'All'  }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuProperties">
                            <a href="#" class="dropdown-item {{ $properties === null || count($selectedHouses) === $this->houses->count()? 'active' : '' }}" wire:click.prevent="setProperty()">All</a>
                            @foreach($this->houses as $house)
                                <div class="dropdown-item {{ in_array($house->HouseID, $selectedHouses) ? 'active' : '' }}">
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            id="house{{ $house->HouseID }}"
                                            class="form-check-input"
                                            wire:model.defer="selectedHouses"
                                            wire:change.prevent="setProperty({{ $house->HouseID }})"
                                            value="{{ $house->HouseID }}"
                                        />
                                        <label class="form-check-label" for="house{{ $house->HouseID }}">{{ $house->HouseName }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <!-- End Col -->
    </div>

    <div class="row mb-3">

        <div class="col-12 mb-3">
            <div class="input-group input-group-sm-vertical">
                <!-- Radio Check -->
                <label class="form-control" for="month">
                <span class="form-check">
                  <input type="radio" class="form-check-input" data-fc-grid-view name="calendar_view" id="month"
                         value="dayGridMonth" checked/>
                  <span class="form-check-label">Month</span>
                </span>
                </label>
                <!-- End Radio Check -->

                <!-- Radio Check -->
                <label class="form-control" for="week">
                <span class="form-check">
                  <input type="radio" class="form-check-input" data-fc-grid-view name="calendar_view" id="week"
                         value="timeGridWeek"/>
                  <span class="form-check-label">Week</span>
                </span>
                </label>
                <!-- End Radio Check -->

                <!-- Radio Check -->
                <label class="form-control" for="day">
                <span class="form-check">
                  <input type="radio" class="form-check-input" data-fc-grid-view name="calendar_view" id="day"
                         value="timeGridDay"/>
                  <span class="form-check-label">Day</span>
                </span>
                </label>
                <!-- End Radio Check -->

                <!-- Radio Check -->
                <label class="form-control" for="list">
                <span class="form-check">
                  <input type="radio" class="form-check-input" data-fc-grid-view name="calendar_view" id="list"
                         value="listWeek"/>
                  <span class="form-check-label">List</span>
                </span>
                </label>
                <!-- End Radio Check -->

                <!-- Radio Check -->
                <label class="form-control" for="rooms">
                <span class="form-check">
                  <input
                      type="radio"
                      class="form-check-input"
                      data-fc-grid-view
                      name="calendar_view"
                      id="rooms"
                      value="resourceTimelineMonth"
                  />
                  <span class="form-check-label">Rooms</span>
                </span>
                </label>
                <!-- End Radio Check -->
            </div>
        </div>

    </div>

    <div id='calendar' class="fullcalendar-custom" wire:ignore></div>
    @push('scripts')
        <script>
            $(document).ready(function () {
                // Fullcalendar controls
                const
                    $prevMonthBtn = document.querySelector('[data-fc-prev-month]'),
                    $nextMonthBtn = document.querySelector('[data-fc-next-month]'),
                    $todayBtn = document.querySelector('[data-fc-today]'),
                    $dateTitle = document.querySelector('[data-fc-title]')

                // INITIALIZATION OF SELECT
                // =======================================================
                window.HSTomSelect.init('.js-select', {
                    hideSearch: true
                })

                HSFullCalendar.init('#calendar', {
                    schedulerLicenseKey: '0575425642-fcs-1661876207',
                    resourceAreaHeaderContent: 'Rooms',
                    resources: @js($this->resourceTimeline),
                    plugins: [
                        interactionPlugin,
                        dayGridPlugin,
                        timeGridPlugin,
                        listPlugin,
                        resourceTimelinePlugin,
                        rrulePlugin
                        // bootstrap5Plugin
                    ],
                    themeSystem: 'bootstrap5',
                    headerToolbar: false,
                    editable: true,
                    defaultAllDay: false,
                    datesSet(dateSet) {
                        $dateTitle.textContent = dateSet.view.title
                    },
                    dateClick: function (info) {
                        // if(moment(info.date).isSameOrAfter(moment())) {

                            @if($user->is_owner)
                                let parsed = queryString.parse(window.location.search);
                                window.livewire.emit('showVacationScheduleModal', true, null, info.dateStr, parsed.owner);
                            @elseif($user->is_guest)
                                window.livewire.emit('showRequestToJoinVacationModal', true, null, info.dateStr)
                            @endif
                        // }
                    },
                    eventClick: function (calEvent, jsEvent, view) {

                        @if($user->is_guest)
                            window.livewire.emit('showRequestToJoinVacationModal', true, calEvent.event.id)
                        @else
                            window.livewire.emit('showVacationScheduleModal', true, calEvent.event.id)
                        @endif
                    },
                    // eventContent: function (arg) {
                    //     let arrayOfDomNodes = []
                    //     // title event
                    //     let titleEvent = document.createElement('div')
                    //     if (arg.event._def.title) {
                    //         titleEvent.innerHTML = arg.event._def.title
                    //         titleEvent.classList = "fc-event-title fc-sticky mx-2"
                    //     }
                    //
                    //     // image event
                    //     let imgEventWrap = document.createElement('div')
                    //     if (arg.event.extendedProps.imageUrl) {
                    //         let imgEvent = '<img src="' + arg.event.extendedProps.imageUrl + '" class="mx-2 mt-2" style="width: 30px; height: 30px; border-radius: 100%">'
                    //         imgEventWrap.classList = "fc-event-img"
                    //         imgEventWrap.innerHTML = imgEvent;
                    //     }
                    //
                    //     arrayOfDomNodes = [imgEventWrap, titleEvent]
                    //
                    //     return {domNodes: arrayOfDomNodes}
                    // },
                    eventContent({event}) {
                        return {
                            html:  `
                                <div>
                                    <div class="fc-event-time">${$('input[name=calendar_view]:checked').val() === 'timeGridWeek' && !event.allDay ? moment(event.start).format('HH:mm') + '-' + moment(event.end).format('HH:mm') : ''}</div>
                                    <div class="d-flex px-2 py-1">
                                        ${
                                            event.extendedProps.imageUrl
                                                ? `<img class="avatar avatar-xs me-2" style="object-fit: cover" src="${event.extendedProps.imageUrl}" alt="Image Description">`
                                                : ''
                                        }
                                        <span class="fc-event-title fc-sticky" style="color: ${event.textColor}">${event.title}</span>
                                    </div>
                                </div>
                            `
                        }
                    },
                    events: @js($this->events),
                });

                let
                    // guestsField = HSTomSelect.getItem("eventGuestsLabel"),
                    // repeatField = HSTomSelect.getItem("eventRepeatLabel"),
                    // eventColorField = HSTomSelect.getItem("eventColorLabel"),
                    fullcalendarEditable = HSFullCalendar.getItem('calendar');
                window.calendar = fullcalendarEditable;
                // document.addEventListener('scroll', function () {
                //     if ($popover && $popover._element) {
                //         $popover.dispose();
                //     }
                // });

                $prevMonthBtn.addEventListener('click', function () {
                    fullcalendarEditable.prev();

                    HSCore.hideTooltips();
                });

                $nextMonthBtn.addEventListener('click', function () {
                    fullcalendarEditable.next();

                    HSCore.hideTooltips();
                });

                $('input[name=calendar_view]').on('change', function (event) {
                    fullcalendarEditable.changeView($('input[name=calendar_view]:checked').val());
                });

                $todayBtn.addEventListener('click', function () {
                    fullcalendarEditable.today();
                });

                $todayBtn.title = new Date().toDateString();

                // $addEventToCalendarModal.addEventListener('hide.bs.modal', function () {
                //     $titleField.style.height = 'auto';
                // });
                // $addEventToCalendarModal.addEventListener('show.bs.modal', function () {
                //     clearForm();
                // });
                // $addEventToCalendarModal.addEventListener('shown.bs.modal', function () {
                //     $titleField.style.height = `${$titleField.scrollHeight}px`;
                //
                //     $titleField.focus();
                // });

                // $titleField.addEventListener('input', function () {
                //     $titleField.style.height = `${$titleField.scrollHeight}px`;
                // });

                window.livewire.on('rerender-calendar', function (events, resourceTimeline) {
                    calendar.getEventSources().map(es => {
                        es.remove();
                    });
                    window.calendar.addEventSource(events);

                    calendar.getResources().map(r => {
                        r.remove();
                    });
                    resourceTimeline.map(r => {
                        window.calendar.addResource(r);
                    })
                    // window.calendar.setResources(resourceTimeline);
                    window.calendar.render();
                });
            });
        </script>
    @endpush
</div>
