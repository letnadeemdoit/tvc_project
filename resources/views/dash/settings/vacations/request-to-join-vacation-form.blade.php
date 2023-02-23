<div id="requestToJoinVacation">
    <div class="container pt-5 col-12 col-md-8">
        <div class="modal-header mb-2">
            <h5 class="modal-title pb-3">
                @if($user->is_guest && (is_null($vacation) || !is_null($vacation) && !$vacation->VacationId))
                    Request to use the House
                @else
                    Request to Join {{ $vacation && $vacation->VacationId ? '"' . $vacation->VacationName . '"' : '' }} Vacation
                    <small class="d-block">To request to join this vacation, provide your name, email, the dates you want to come and click "Request to Join"</small>
                @endif
            </h5>
{{--            <button--}}
{{--                type="button"--}}
{{--                class="btn-close"--}}
{{--                data-bs-dismiss="modal"--}}
{{--                aria-label="Close"--}}
{{--                @click.click="hide()"--}}
{{--            ></button>--}}
        </div>
        <form
            wire:submit.prevent="sendRequestToJoinVacation"
            class="modal-body"
{{--            @modal-is-shown.window="--}}
{{--                jQuery('.datetime-picker-rtjv').datetimepicker({--}}
{{--                    changeMonth: true,--}}
{{--                    changeYear: true,--}}
{{--                    yearRange: '-10:+10',--}}
{{--                    beforeShow: function () {--}}
{{--                        var $datePicker = $('.datetime-picker-rtjv');--}}
{{--                        var zIndexModal = $datePicker.closest('.modal').css('z-index');--}}
{{--                        $datePicker.css('z-index', zIndexModal + 99999);--}}
{{--                    },--}}
{{--                    onSelect: function (date, datepicker) {--}}
{{--                        let id = datepicker.id;--}}

{{--                        if(id === undefined) {--}}
{{--                            id = datepicker.$input[0].id;--}}
{{--                        }--}}

{{--                        @this.set('state.' + id, date, true);--}}
{{--                    },--}}
{{--                    hour: 12,--}}
{{--                    minute: 0,--}}
{{--                    showMinute: false,--}}
{{--                    stepMinute: 60,--}}
{{--                    showSecond: false,--}}
{{--                    showMillisec: false,--}}
{{--                    showMicrosec: false,--}}
{{--                    showTimezone: false,--}}
{{--                    container: '#' + $event.detail.modal.attr('id')--}}
{{--                })--}}
{{--                .attr('readonly', 'true')--}}
{{--                .keypress(function (event) {--}}
{{--                    if (event.keyCode === 8) {--}}
{{--                        event.preventDefault();--}}
{{--                    }--}}
{{--                });--}}
{{--            "--}}
        >
            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label class="form-label" for="name">Name:</label>
                    <input
                        type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        name="name"
                        id="name"
                        wire:model.defer="state.name"
                    />
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="email">Email:</label>
                    <input
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        name="email"
                        id="email"
                        wire:model.defer="state.email"
                    />
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="rtjv_start_end_datetime">Start & End Datetime:</label>
                <input
                    type="text"
                    class="form-control @error('start_datetime') is-invalid @enderror"
                    name="start_datetime"
                    id="rtjv_start_end_datetime"
                    placeholder="Start & end date time"
                    wire:model.defer="state.start_end_datetime"
                    readonly
                />
                @error('start_datetime')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
{{--            <div class="row mb-3">--}}
{{--                <div class="form-group col-md-6">--}}
{{--                    <label class="form-label" for="start_datetime">Start Datetime:</label>--}}
{{--                    <input--}}
{{--                        type="text"--}}
{{--                        class="form-control datetime-picker-rtjv @error('start_datetime') is-invalid @enderror"--}}
{{--                        name="start_datetime"--}}
{{--                        id="start_datetime"--}}
{{--                        wire:model.defer="state.start_datetime"--}}

{{--                    />--}}
{{--                    @error('start_datetime')--}}
{{--                        <span class="invalid-feedback">{{ $message }}</span>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--                <div class="form-group col-md-6">--}}
{{--                    <label class="form-label" for="end_datetime">End Datetime:</label>--}}
{{--                    <input--}}
{{--                        type="text"--}}
{{--                        class="form-control datetime-picker-rtjv @error('end_datetime') is-invalid @enderror"--}}
{{--                        name="end_datetime"--}}
{{--                        id="end_datetime"--}}
{{--                        wire:model.defer="state.end_datetime"--}}
{{--                    />--}}
{{--                    @error('end_datetime')--}}
{{--                        <span class="invalid-feedback">{{ $message }}</span>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="d-flex">
                <button
                    type="submit"
                    class="btn btn-primary ms-auto"
                >
                    @if($user->is_guest && (is_null($vacation) || !is_null($vacation) && !$vacation->VacationId))
                        Request to use the House
                    @else
                        Request to Join
                    @endif
                </button>
            </div>
        </form>
    </div>
    @push('scripts')
        <script>
            $(function() {
                $('#rtjv_start_end_datetime').daterangepicker({
                    timePicker: true,
                    timePickerIncrement: 60,
                    showDropdowns: false,
                    minYear: parseInt(moment().subtract(10, 'years').format('YYYY'), 10),
                    maxYear: parseInt(moment().add(10, 'years').format('YYYY'), 10),
                    minDate: moment().format('MM/DD/YYYY'),
                    startDate: @isset($state['start_datetime']) '{{ $state['start_datetime'] }}'
                    @else moment().set('minute', 0) @endisset,
                    endDate: @isset($state['end_datetime']) '{{ $state['end_datetime'] }}'
                    @else moment().set('minute', 0).add(2, 'days') @endisset,
                    locale: {
                        format: 'MM/DD/YYYY HH:mm'
                    }
                });

                $('#rtjv_start_end_datetime').on('change.daterangepicker', function (ev) {
                    var currentValue = $('#rtjv_start_end_datetime').val();
                    var dateTime = currentValue.split('-');
                @this.
                set('state.start_datetime', dateTime[0], true);
                @this.
                set('state.end_datetime', dateTime[1], true);
                @this.
                set('state.start_end_datetime', dateTime[0] + ' - ' + dateTime[1], true);
                });

                $('#rtjv_start_end_datetime').on('apply.daterangepicker', function(ev, picker) {
                    @this.set('state.start_datetime', picker.startDate.format('MM/DD/YYYY HH:mm'), true);
                    @this.set('state.end_datetime', picker.endDate.format('MM/DD/YYYY HH:mm'), true);
                    @this.set('state.start_end_datetime', picker.startDate.format('MM/DD/YYYY HH:mm') + ' - ' + picker.endDate.format('MM/DD/YYYY HH:mm'), true);
                });

                window.addEventListener('rtjv-daterangepicker-update', function (e) {
                    $('#rtjv_start_end_datetime').data('daterangepicker').setStartDate(e.detail.startDatetime);
                    $('#rtjv_start_end_datetime').data('daterangepicker').setEndDate(e.detail.endDatetime);

                    $('#rtjv_start_end_datetime').val(`${e.detail.startDatetime} - ${e.detail.endDatetime}`);
                });

                // $('#rtjv_start_end_datetime').click(function () {
                //     if ($(window).innerWidth() <= 567) {
                //         $('.daterangepicker').css('display', 'flex');
                //         $('.daterangepicker').css('overflow', 'scroll');
                //         $('.daterangepicker').css('max-width', '500px');
                //         $('.drp-buttons').css('display', 'flex');
                //         $('.drp-buttons').css('justify-content', 'space-between');
                //         $('.drp-buttons').css('margin', 'auto');
                //         $('.drp-buttons').css('height', '50px');
                //     }
                // });


            });
        </script>
    @endpush
</div>
