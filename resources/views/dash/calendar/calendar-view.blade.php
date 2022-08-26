<div>
    <div class="row align-items-sm-center mb-4">
        <div class="col-lg-5 mb-2 mb-lg-0">
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
                    <h4 class="h3 mb-0" data-fc-title></h4>
                </div>
            </div>
        </div>
        <!-- End Col -->

        <div class="col-lg-7">
            <div class="d-sm-flex align-items-sm-center">
                <!-- Input Group -->
                <div class="input-group input-group-merge me-2 mb-2 mb-sm-0">
                    <div class="input-group-prepend input-group-text">
                        <i class="bi-search"></i>
                    </div>
                    <input type="text" id="filter-by-title" class="form-control" placeholder="Search by title">
                </div>
                <!-- End Input Group -->

                <div class="d-flex align-items-center">
                    <!-- Select -->
                    <div class="tom-select-custom">
                        <select
                            class="js-select form-select"
                            data-fc-grid-view
                            data-hs-tom-select-options='{
                                "searchInDropdown": false,
                                "hideSearch": true
                            }'
                        >
                            <option value="dayGridMonth">Month</option>
                            <option value="timeGridWeek">Week</option>
                            <option value="timeGridDay">Day</option>
                            <option value="listWeek">List</option>
                        </select>
                    </div>
                    <!-- End Select -->
                </div>
            </div>
        </div>
        <!-- End Col -->
    </div>
    <div style="text-align:left">
        <div id='calendar'>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function () {
                // Fullcalendar controls
                const
                    $prevMonthBtn = document.querySelector('[data-fc-prev-month]'),
                    $nextMonthBtn = document.querySelector('[data-fc-next-month]'),
                    $todayBtn = document.querySelector('[data-fc-today]'),
                    $dateTitle = document.querySelector('[data-fc-title]'),
                    $gridViewSelect = document.querySelector('[data-fc-grid-view]')

                // Filter controls
                const
                    $filterByTitle = document.querySelector('#filter-by-title'),
                    $filters = document.querySelectorAll('[data-filter]')

                // INITIALIZATION OF SELECT
                // =======================================================
                window.HSTomSelect.init('.js-select', {
                    hideSearch: true
                })

                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth() + 1;
                var y = date.getFullYear();
                var calendarEl = document.getElementById('calendar');
                HSFullCalendar.init('#calendar', {
                    plugins: [interactionPlugin, dayGridPlugin, timeGridPlugin, listPlugin, bootstrap5Plugin],
                    themeSystem: 'bootstrap5',
                    headerToolbar: false,
                    editable: true,
                    defaultAllDay: false,
                    datesSet(dateSet) {
                        $dateTitle.textContent = dateSet.view.title
                    },
                    eventClick: function (calEvent, jsEvent, view) {
                        console.log(calEvent);
                        // if (calEvent.className !== 'noway') {
                        //
                        // } else {
                            window.livewire.emit('showVacationScheduleModal', true, calEvent.event.id)
                        // }
                    },
                    events: @js($events)
                });


                let
                    // guestsField = HSTomSelect.getItem("eventGuestsLabel"),
                    // repeatField = HSTomSelect.getItem("eventRepeatLabel"),
                    // eventColorField = HSTomSelect.getItem("eventColorLabel"),
                    fullcalendarEditable = HSFullCalendar.getItem('calendar');

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

                $gridViewSelect.addEventListener('change', function (event) {
                    fullcalendarEditable.changeView(event.target.value);
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


            });
        </script>
    @endpush
</div>
