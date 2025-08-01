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
{{--                <button--}}
{{--                    type="button"--}}
{{--                    id="printButton"--}}
{{--                    class="btn btn-primary btn-sm btn-no-focus me-1"--}}
{{--                    title="Previous month"--}}
{{--                >--}}
{{--                    Print  Calendar--}}
{{--                </button>--}}
                @if($user->is_owner && !$user->is_owner_only)
{{--                @if(!$user->is_guest)--}}
                    <div class="dropdown ms-1">
                        <button type="button" class="btn btn-white dropdown-toggle w-100"
                                id="usersExportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi-people-fill me-2"></i>
                            Scheduler: {{ $this->owner ? optional(\App\Models\User::where('user_id', $this->owner)->where('HouseId', $this->user->HouseId)->first())->name : 'You' }}
                        </button>

                        <div class="dropdown-menu dropdown-menu-sm-end" aria-labelledby="usersExportDropdown" style="">
                            <span class="dropdown-header">You</span>
                            <a id="you{{ $user->user_id }}" class="dropdown-item {{ $this->owner ?: 'active' }}"
                               href="#" wire:click.prevent="$set('owner', null)">
                                <img class="avatar avatar-xss avatar-4x3 me-2" src="{{ $user->profile_photo_url }}"
                                     alt="{{ $user->name }}">
                                {{ $user->name }}
                            </a>
                            <span class="dropdown-header">Schedulers</span>
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
{{--                @if(!$user->is_guest)--}}
                    <div class="dropdown ms-1">
                        <button type="button" class="btn btn-primary dropdown-toggle" id="dropdownMenuProperties"
                                data-bs-toggle="dropdown" aria-expanded="false" data-offset="10,20">
                            Properties: {{ $properties ? 'Customized' : 'All'  }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuProperties">
                            <a href="#"
                               class="dropdown-item {{ $properties === null || count($selectedHouses) === $this->houses->count()? 'active' : '' }}"
                               wire:click.prevent="setProperty()">All</a>
                            @foreach($this->houses as $house)
                                <div
                                    class="dropdown-item {{ in_array($house->HouseID, $selectedHouses) ? 'active' : '' }}">
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            id="house{{ $house->HouseID }}"
                                            class="form-check-input"
                                            wire:model.defer="selectedHouses"
                                            wire:change.prevent="setProperty({{ $house->HouseID }})"
                                            value="{{ $house->HouseID }}"
                                        />
                                        <label class="form-check-label"
                                               for="house{{ $house->HouseID }}">{{ $house->HouseName }}</label>
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
                <label class="form-control" for="year">
                            <span class="form-check">
                              <input type="radio" class="form-check-input" data-fc-grid-view name="calendar_view"
                                     id="year"
                                     value="multiMonthYear"/>
                              <span class="form-check-label">Year</span>
                            </span>
                </label>
            <!-- End Radio Check -->
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
    @if(isset($start_vac) && !is_null($start_vac))
        <div id="vacation_bar" class="row justify-content-center" style="display: none">
            <div class="col-10">
                <span>You can schedule room between {{ $start_vac }} to {{ $end_vac }} against vacation({{ $name_vac }})</span>
            </div>
        </div>
    @endif

    <div id='calendar' class="fullcalendar-custom" wire:ignore></div>

    <div class="modal fade" id="selectRelevantRoomModal" tabindex="-1" aria-labelledby="selectRelevantRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                {{--                <h6 class="modal-title fs-10 text-white"--}}
                {{--                    id="selectRelevantVacationModalLabel">relevant</h6>--}}
                <div class="modal-body text-center">
                    <div>
              <span class="rounded-circle text-primary border-primary" style="padding: 4px 9px; font-size: 26px; line-height: 75px;border: 3px solid;">
                    <i class="bi-exclamation"></i>
                </span>
                    </div>

                    <h4 class="fw-bold text-center my-3"
                        style="color: #00000090">Select the relevant property</h4>
                    <p class="fw-500 fs-15">This room is scheduled in different house please switch to relevant house before adding or updating room</p>
                    <div class="btn-group my-2">
                        <button type="button"
                                class="btn px-5 btn-dark fw-500 text-uppercase fs-16 mb-2 mb-lg-0 w-180 mx-2 rounded py-2"
                                data-bs-dismiss="modal">Ok
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="changeAccountSettingToAccessRoomModal" tabindex="-1" aria-labelledby="changeAccountSettingToAccessRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div>
              <span class="rounded-circle text-primary border-primary" style="padding: 4px 9px; font-size: 26px; line-height: 75px;border: 3px solid;">
                    <i class="bi-exclamation"></i>
                </span>
                    </div>

                    <h4 class="fw-bold text-center my-3"
                        style="color: #00000090">Change Account Information</h4>
                    <p class="fw-500 fs-15">This account does not have allowed to access room booking screen. Please contact the house Administrator <strong>({{primary_user()->first_name . ' ' . primary_user()->last_name . ' - ' . primary_user()->email}})</strong> to set up account information to access room screen</p>
                    <div class="btn-group my-2">
                        <button type="button"
                                class="btn px-5 btn-dark fw-500 text-uppercase fs-16 mb-2 mb-lg-0 w-180 mx-2 rounded py-2"
                                data-bs-dismiss="modal">Ok
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="guestVacationModal" tabindex="-1" aria-labelledby="guestVacationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div>
              <span class="rounded-circle text-primary border-primary" style="padding: 4px 9px; font-size: 26px; line-height: 75px;border: 3px solid;">
                    <i class="bi-exclamation"></i>
                </span>
                    </div>

                    <h4 class="fw-bold text-center my-3"
                        style="color: #00000090">Guest Vacation</h4>
                    <p class="fw-500 fs-15">It's guest vacation and need to approve by house administrator <strong>({{primary_user()->first_name . ' ' . primary_user()->last_name . ' - ' . primary_user()->email}})</strong></p>
                    <div class="btn-group my-2">
                        <button type="button"
                                class="btn px-5 btn-dark fw-500 text-uppercase fs-16 mb-2 mb-lg-0 w-180 mx-2 rounded py-2"
                                data-bs-dismiss="modal">Ok
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="showTaskDetailModal" tabindex="-1" aria-labelledby="showTaskDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div>
              <span class="rounded-circle text-secondary border-secondary" style="padding: 4px 9px; font-size: 26px; line-height: 75px;border: 3px solid;">
                    <i class="bi-clock"></i>
                </span>
                    </div>

                    <h4 class="fw-bold text-center my-3"
                        style="color: #00000090">BOOKABLE APPOINTMENT SCHEDULE</h4>
                    <p class="fw-500 fs-15" id="task_description"></p>
                    <p class="fw-500 fs-15" id="task_description_date_time"></p>
                    <div class="btn-group my-2">
                        <button type="button"
                                class="btn px-5 btn-secondary fw-500 text-uppercase fs-16 mb-2 mb-lg-0 w-180 mx-2 rounded py-2"
                                data-bs-dismiss="modal">Cancel
                        </button>
                        @if($user->is_admin)
                            <button type="button"
                                    class="btn px-5 btn-primary fw-500 text-uppercase fs-16 mb-2 mb-lg-0 w-180 mx-2 rounded py-2"
                                    wire:click.prevent="editCalendarTask"
                            >
                                Edit
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="selectRelevantVacationDatesModal" tabindex="-1" aria-labelledby="selectRelevantVacationDatesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div>
              <span class="rounded-circle text-primary border-primary" style="padding: 4px 9px; font-size: 26px; line-height: 75px;border: 3px solid;">
                    <i class="bi-exclamation"></i>
                </span>
                    </div>

                    <h4 class="fw-bold text-center my-3"
                        style="color: #00000090">Select relevant dates to schedule vacation</h4>
                    <p class="fw-500 fs-15">
                        Unable to create vacation: Selected date is outside the allowed scheduling window of {{isset($schedulingStartDate) ? $schedulingStartDate->format('m-d-Y') : null}} to {{isset($schedulingEndDate) ? $schedulingEndDate->format('m-d-Y') : null}}.
                    </p>
                    <div class="btn-group my-2">
                        <button type="button"
                                class="btn px-5 btn-dark fw-500 text-uppercase fs-16 mb-2 mb-lg-0 w-180 mx-2 rounded py-2"
                                data-bs-dismiss="modal">Ok
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="selectRelevantUserRoomModal" tabindex="-1" aria-labelledby="selectRelevantUserRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div>
              <span class="rounded-circle text-primary border-primary" style="padding: 4px 9px; font-size: 26px; line-height: 75px;border: 3px solid;">
                    <i class="bi-exclamation"></i>
                </span>
                    </div>

                    <h4 class="fw-bold text-center my-3"
                        style="color: #00000090">Select relevant room</h4>
                    <p class="fw-500 fs-15">
                        Unable to update room: Scheduler has no right to update admin rooms or other scheduler rooms.
                    </p>
                    <div class="btn-group my-2">
                        <button type="button"
                                class="btn px-5 btn-dark fw-500 text-uppercase fs-16 mb-2 mb-lg-0 w-180 mx-2 rounded py-2"
                                data-bs-dismiss="modal">Ok
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>






    @push('scripts')
        <script>
            $(document).ready(function () {

                var popover = null;
                // window.addEventListener('vacationScheduled', function (e) {
                // });
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
                    schedulerLicenseKey: '0993297183-fcs-1693415986',
                    // schedulerLicenseKey: '0575425642-fcs-1661876207',
                    resourceAreaHeaderContent: 'Rooms',
                    resources: @js($this->resourceTimeline),
                    plugins: [
                        interactionPlugin,
                        dayGridPlugin,
                        timeGridPlugin,
                        listPlugin,
                        resourceTimelinePlugin,
                        multiMonthPlugin,
                        // adaptivePlugin,
                        // rrulePlugin
                        // bootstrap5Plugin
                    ],
                    themeSystem: 'bootstrap5',
                    headerToolbar: false,
                    editable: true,
                    defaultAllDay: false,
                    @if($calendarRowsHeight === 'dynamic')
                    dayMaxEventRows: true,
                    views: {
                        timeGrid: {
                            dayMaxEventRows: 6
                        }
                    },
                    @endif
                    datesSet(dateSet) {
                        $dateTitle.textContent = dateSet.view.title
                    },
                    validRange: function(nowDate) {
                        if ($('input[name=calendar_view]:checked').val() === 'resourceTimelineMonth'){
                            var setVacationId = "<?php echo $setVacationId; ?>";
                            var start_vac = "<?php echo $start_vac; ?>";
                            var end_vac = "<?php echo $end_vac; ?>";
                            if(setVacationId){
                                return {
                                    start: start_vac,
                                    end: end_vac
                                };
                            }
                        }
                        @if($this->isCalendarSchedulingWindow && !$user->is_admin && !$this->enableCalendarAccess)
                        if ($('input[name=calendar_view]:checked').val() !== 'multiMonthYear') {
                            var schedulingStartDate = "<?php echo $this->schedulingStartDate; ?>";
                            var schedulingEndDate = "<?php echo $this->schedulingEndDate; ?>";
                            return {
                                start: schedulingStartDate,
                                end: schedulingEndDate
                            };
                        }
                        @endif
                    },
                    dateClick: async function (info) {

                        @if($isCalendarSchedulingWindow)
                        let scheduling_start_date = "<?php echo $schedulingStartDate->format('Y-m-d'); ?>";
                        let scheduling_end_date = "<?php echo $schedulingEndDate->format('Y-m-d'); ?>";
                        if(info.dateStr < scheduling_start_date || info.dateStr > scheduling_end_date){
                            @if($user->is_guest)
                                @if($isEnableGuestVacation)
                                     $('#selectRelevantVacationDatesModal').modal('show');
                                     return false;
                                @endif
                            @else
                                $('#selectRelevantVacationDatesModal').modal('show');
                                return false;
                            @endif
                        }
                        @endif
                        // console.log('info ', info)
{{--                        @if(!$user->is_guest)--}}
                        @if($user->is_owner)

                        let parsed = queryString.parse(window.location.search);

                        if (info.view.type === 'resourceTimelineMonth') {
                            if (info.resource._resource.id !== 0 && info.resource._resource.title !== 'Vacations') {
                                @if(primary_user()->enable_rooms !== 1)
                                $('#changeAccountSettingToAccessRoomModal').modal('show');
                                @else
                                await window.livewire.emit('checkHouseRelevantRoom', info.resource._resource.id, info.dateStr);
                                $.blockUI({ css: {
                                        border: 'none',
                                        padding: '15px',
                                        // backgroundColor: '#000',
                                        '-webkit-border-radius': '10px',
                                        '-moz-border-radius': '10px',
                                        opacity: .5,
                                        color: '#fff'
                                    } });
                                window.addEventListener('current-room', function (e) {
                                    if(e.detail.room !== null) {
                                        var url = "{!! route('dash.schedule-vacation-room', ['roomId' => '__roomId__', 'vacationRoomId' => '__vacationRoomId__', 'initialDate' => '__initialDate__', 'owner' => '__owner__']) !!}";
                                        url = url.replace('__roomId__', info.resource._resource.id);
                                        url = url.replace('__vacationRoomId__', null);
                                        url = url.replace('__initialDate__', info.dateStr);
                                        if (parsed.owner) {
                                            url = url.replace('__owner__', parsed.owner);
                                        } else {
                                            url = url.replace('__owner__', '');
                                        }
                                        location.href = url;
                                    }
                                    else{
                                        $('#selectRelevantRoomModal').modal('show');
                                    }
                                });

                                @endif

                                // window.livewire.emit('showVacationRoomScheduleModal', true, info.resource._resource.id, null, info.dateStr, parsed.owner);
                            }
                            else {
                                var url = "{!! route('dash.schedule-vacation', ['vacationId' => '__vacationId__', 'initialDate' => '__initialDate__', 'owner' => '__owner__']) !!}";
                                url = url.replace('__vacationId__', null);
                                url = url.replace('__initialDate__', info.dateStr);
                                if (parsed.owner){
                                    url = url.replace('__owner__', parsed.owner);
                                }
                                else {
                                    url = url.replace('__owner__', '');
                                }
                                location.href = url;
                            }
                        } else {
                            if(popover != null){
                                $('.fc-popover').hide();
                                popover = null;
                            }
                            else {
                                var url = "{!! route('dash.schedule-vacation', ['vacationId' => '__vacationId__', 'initialDate' => '__initialDate__', 'owner' => '__owner__']) !!}";
                                url = url.replace('__vacationId__', null);
                                url = url.replace('__initialDate__', info.dateStr);
                                if (parsed.owner){
                                    url = url.replace('__owner__', parsed.owner);
                                }
                                else {
                                    url = url.replace('__owner__', '');
                                }
                                location.href = url;
                            }
                            // window.livewire.emit('showVacationScheduleModal', true, null, info.dateStr, parsed.owner);
                        }
                        @elseif($user->is_guest)
                        var url = "{!! route('guest.guest-request-to-join-vacation', ['vacationId' => '__vacationId__', 'initialDate' => '__initialDate__']) !!}";
                        url = url.replace('__vacationId__', null);
                        url = url.replace('__initialDate__', info.dateStr);
                        location.href = url;
                        // window.livewire.emit('showRequestToJoinVacationModal', true, null, info.dateStr)
                        @endif
                    },
                    eventClick: function (calEvent, jsEvent, view) {
                        if(calEvent.event.extendedProps.is_calendar_task === 1){
                            $('#showTaskDetailModal').modal('show');
                            $('#task_description').text(calEvent.event.title);
                            $('#task_description_date_time').text(`${moment(calEvent.event.start).format('hh:mm A')} - ${moment(calEvent.event.end).format('hh:mm A')}`);

                            window.addEventListener('edit-calendar-task', function (e) {
                                var url = "{!! route('dash.schedule-calendar-task', ['vacationId' => '__vacationId__']) !!}";
                                url = url.replace('__vacationId__', calEvent.event.id);
                                location.href = url;
                            });

                            return false;
                        }
                        @if($user->is_guest)
                        let guest_id = "<?php echo $user->user_id; ?>";
                        let ownerId = calEvent.event.extendedProps.OwnerId.toString();
                        if (guest_id !== ownerId && calEvent.event.extendedProps.user_role !== 'Guest'){
                            var url = "{!! route('guest.guest-request-to-join-vacation', ['vacationId' => '__vacationId__', 'initialDate' => '__initialDate__']) !!}";
                            url = url.replace('__vacationId__', calEvent.event.id);
                            url = url.replace('__initialDate__', null);
                            location.href = url;
                            // window.livewire.emit('showRequestToJoinVacationModal', true, calEvent.event.id)
                        }
                        else {
                            $('#guestVacationModal').modal('show');
                            return false;
                        }
                        @else
                        if (calEvent.event.extendedProps.user_role === 'Guest'){
                            $('#guestVacationModal').modal('show');
                            return false;
                        }
                        if (calEvent.view.type == 'resourceTimelineMonth') {
                            if (calEvent.event.extendedProps.is_room) {
                                @if(primary_user()->enable_rooms !== 1)
                                $('#changeAccountSettingToAccessRoomModal').modal('show');
                                @else

                                let is_owner_only = "<?php echo $user->is_owner_only; ?>";
                                let user_id = "<?php echo $user->user_id; ?>";
                                let vacation_owner_id = calEvent.event.extendedProps.vacation_owner_id.toString();
                                if(is_owner_only && user_id !== vacation_owner_id){
                                    $('#selectRelevantUserRoomModal').modal('show');
                                    return false;
                                }

                                window.livewire.emit('checkRoomExistInHouse', calEvent.event.extendedProps.room_id, calEvent.event.extendedProps.vacation_room_id);
                                $.blockUI({ css: {
                                        border: 'none',
                                        padding: '15px',
                                        // backgroundColor: '#000',
                                        '-webkit-border-radius': '10px',
                                        '-moz-border-radius': '10px',
                                        opacity: .5,
                                        color: '#fff'
                                    } });
                                window.addEventListener('current-vacation-room', function (e) {
                                    let current_houseid = "<?php echo current_house()->HouseID; ?>";
                                    if(e.detail.vacation.HouseId == current_houseid) {
                                        var url = "{!! route('dash.schedule-vacation-room', ['roomId' => '__roomId__', 'vacationRoomId' => '__vacationRoomId__', 'initialDate' => '__initialDate__', 'owner' => '__owner__']) !!}";
                                        url = url.replace('__roomId__', calEvent.event.extendedProps.room_id);
                                        url = url.replace('__vacationRoomId__', calEvent.event.extendedProps.vacation_room_id);
                                        url = url.replace('__initialDate__', null);
                                        url = url.replace('__owner__', null);
                                        location.href = url;
                                    }
                                    else {
                                        $('#selectRelevantRoomModal').modal('show');
                                    }
                                });
                                @endif

                                // window.livewire.emit('showVacationRoomScheduleModal', true, calEvent.event.id, calEvent.event.extendedProps.vacation_room_id)
                            }
                            else {
                                var url = "{!! route('dash.schedule-vacation', ['vacationId' => '__vacationId__', 'initialDate' => '__initialDate__', 'owner' => '__owner__']) !!}";
                                url = url.replace('__vacationId__', calEvent.event.id);
                                url = url.replace('__initialDate__', null);
                                url = url.replace('__owner__', null);
                                location.href = url;
                            }
                        } else if (calEvent.view.type == 'dayGridMonth') {
                            if (calEvent.event.extendedProps.is_room) {
                                if (popover != null) {
                                    $('.fc-popover').hide();
                                    popover = null;
                                    var url = "{!! route('dash.schedule-vacation', ['Vacation_Id' => '__vacationId__', 'Room_Id' => '__roomId__', 'vacationRoomId' => '__vacationRoomId__', 'isRoom' => '__isRoom__']) !!}";
                                    url = url.replace('__vacationId__', calEvent.event.id);
                                    url = url.replace('__roomId__', calEvent.event.extendedProps.room_id);
                                    url = url.replace('__vacationRoomId__', calEvent.event.extendedProps.vacation_room_id);
                                    url = url.replace('__isRoom__', calEvent.event.extendedProps.is_room);
                                    location.href = url;
                                }
                                else {
                                    var url = "{!! route('dash.schedule-vacation', ['Vacation_Id' => '__vacationId__', 'Room_Id' => '__roomId__', 'vacationRoomId' => '__vacationRoomId__', 'isRoom' => '__isRoom__']) !!}";
                                    url = url.replace('__vacationId__', calEvent.event.id);
                                    url = url.replace('__roomId__', calEvent.event.extendedProps.room_id);
                                    url = url.replace('__vacationRoomId__', calEvent.event.extendedProps.vacation_room_id);
                                    url = url.replace('__isRoom__', calEvent.event.extendedProps.is_room);
                                    location.href = url;
                                }
                            } else {
                                if (popover != null) {
                                    $('.fc-popover').hide();
                                    popover = null;
                                }else {
                                    var url = "{!! route('dash.schedule-vacation', ['vacationId' => '__vacationId__', 'initialDate' => '__initialDate__', 'owner' => '__owner__']) !!}";
                                    url = url.replace('__vacationId__', calEvent.event.id);
                                    url = url.replace('__initialDate__', null);
                                    url = url.replace('__owner__', null);
                                    location.href = url;
                                    // window.livewire.emit('showVacationScheduleModal', true, calEvent.event.id)
                                }
                            }

                        }
                        else if (calEvent.view.type == 'multiMonthYear') {
                            var url = "{!! route('dash.schedule-vacation', ['vacationId' => '__vacationId__', 'initialDate' => '__initialDate__', 'owner' => '__owner__']) !!}";
                            url = url.replace('__vacationId__', calEvent.event.id);
                            url = url.replace('__initialDate__', null);
                            url = url.replace('__owner__', null);
                            location.href = url;
                            // window.livewire.emit('showVacationScheduleModal', true, calEvent.event.id)
                        }
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

                        if (event.extendedProps.is_room) {
                            let eventHeight = event.extendedProps.is_room ? 70 : 40; // Adjust these values as needed
                            return {
                                html: `
                                <style>
                                    .fullcalendar-custom .fc-event-resizable{
                                     max-width : 100% !important;
                                     }

                                </style>
                                <div>
                                    <div class="fc-event-time">${$('input[name=calendar_view]:checked').val() === 'timeGridWeek' && !event.allDay ? moment(event.start).format('HH:mm') + '-' + moment(event.end).format('HH:mm') : ''}</div>
                                    <div class="d-flex px-2 py-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-house-fill me-2" viewBox="0 0 16 16" style="color: ${event.textColor}">
                                          <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z"/>
                                          <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z"/>
                                        </svg>
                                       <span class="fc-event-title fc-sticky py-0" style="color: ${event.textColor}; font-size: 12px !important;">${event.title}</span>
                                    </div>
                                </div>
                            `
                            }
                        }

                        if (event.extendedProps.is_calendar_task === 1) {
                            return {
                                html: `
                                <style>
                                     .fullcalendar-custom .fc-event-resizable{
                                     max-width : 100% !important;
                                     }

                                </style>
                                <div>
                                    <div class="fc-event-time">${$('input[name=calendar_view]:checked').val() === 'timeGridWeek' && !event.allDay ? moment(event.start).format('HH:mm') + '-' + moment(event.end).format('HH:mm') : ''}</div>
                                    <div class="d-flex px-2 py-0">
                                       <span class="fc-event-title fc-sticky py-0" style="color: ${event.textColor}; font-size: 12px !important;">
                                            ${event.title}
                                       </span>
                                       <span class="fc-event-title fc-sticky px-2" style="color: ${event.textColor}; font-size: 10px !important;padding-top:1px">
                                            ( ${moment(event.start).format('hh:mm A') + '-' + moment(event.end).format('hh:mm A')} )
                                       </span>
                                    </div>
                                </div>
                            `
                            }
                        }

                        return {
                            html: `
                                 <style>
                                    .fullcalendar-custom .fc-event-resizable{
                                     max-width : 100% !important;
                                     }

                                </style>
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

                    window.calendar.render();


                });
                var startVacationDataTime = "<?php echo $startVacationDataTime; ?>";
               if(startVacationDataTime){
                   window.calendar.gotoDate(startVacationDataTime);
               }

                var startRoomDatetime = "<?php echo $startRoomDatetime; ?>";
                if(startRoomDatetime){
                    window.calendar.gotoDate(startRoomDatetime);
                    $('#rooms').click();
                    $('#vacation_bar').show();
                }

                var setVacationId = "<?php echo $setVacationId; ?>";
                if(setVacationId){
                    $('#rooms').click();
                    $('#vacation_bar').show();
                }
                window.livewire.on('vacation-deleted-successfully', function () {
                   window.location.reload();
                });

                $('.fc-daygrid-more-link').on('click', function (event) {
                    setTimeout(function() {
                        popover = document.querySelector('.fc-popover');
                        console.log(popover);
                    }, 100);
                });

                window.addEventListener('select-relevant-room', function (e) {
                    $('#selectRelevantRoomModal').modal('show');
                });

                $('#selectRelevantRoomModal').on('shown.bs.modal', function (e) {
                    $.unblockUI();
                })

                // $(document).ready(function () {
                //     $('#printButton').on('click', function () {
                //         let printContents = document.getElementById('calendar').innerHTML;
                //
                //         // Create a new window for the print content with default size
                //         let printWindow = window.open('', '', 'height=auto,width=auto');
                //         printWindow.document.write('<html><head><title>Print Calendar</title>');
                //         printWindow.document.write('</head><body>');
                //         printWindow.document.write(printContents);
                //         printWindow.document.write('</body></html>');
                //
                //         // Wait for the new window content to be fully loaded before printing
                //         printWindow.document.close();
                //         printWindow.onload = function () {
                //             printWindow.print();
                //             printWindow.close();
                //         };
                //
                //         // Optionally reinitialize the calendar if needed
                //         window.calendar.render();
                //     });
                // });

            });

        </script>
    @endpush
</div>
