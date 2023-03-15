<div
    id="scheduleRoomVacation"
>
    <div class="modal-content">
        <div class="modal-header mb-2">
            <h5 class="modal-title">{{ $vacationRoom && $vacationRoom->id ? "Update" : 'Add' }} Vacation Room</h5>
{{--            <button--}}
{{--                type="button"--}}
{{--                class="btn-close"--}}
{{--                data-bs-dismiss="modal"--}}
{{--                aria-label="Close"--}}
{{--                @click.click="hide()"--}}
{{--            ></button>--}}
        </div>
        <form
            wire:submit.prevent="saveVacationRoomSchedule"
            class="modal-body"
        >

            <x-jet-validation-errors />
            {{--            <x-jet-validation-errors />--}}
            @if(!$this->isCreating)
                <div class="form-group mb-3">
                    <label class="form-label" for="room_name">Room Name:</label>
                    <input
                        type="text"
                        class="form-control"
                        disabled
                        name="room_name"
                        id="room_name"
                        wire:model="state.room_name"
                    />
                </div>
            @endif
            <div class="form-group mb-3">
                <label class="form-label" for="vacation_name">Select Vacation:</label>

                <select
                    type="text"
                    class="form-control @error('vacation_id') is-invalid @enderror"
                    name="vacation_id"
                    @if(!$isCreating) disabled @endif
                    {{--                    id="vacation_name"--}}
                    {{--                    placeholder="Vacation name"--}}
                    {{--                    wire:model.defer="state.vacation_name"--}}
                    wire:model="state.vacation_id"
                    wire:change="onChangeRoomVacation"
                >
                    <option disabled value="">Select Vacation</option>

                    @if(isset($vacations) && count($vacations) > 0)
                        @foreach($vacations as $v)
                            <option value="{{$v->VacationId}}">{{ $v->VacationName }}</option>
                        @endforeach
                    @endif
                </select>
                @error('vacation_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <div wire:loading wire:target="state.vacation_id" class="text-success">
                    Updating vacation...
                </div>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="occupant_name">Occupant Name:</label>
                <input
                    type="text"
                    class="form-control @error('occupant_name') is-invalid @enderror"
                    name="start_datetime"
                    id="occupant_name"
                    placeholder="occupant name"
                    wire:model.defer="state.occupant_name"
                />
                @error('occupant_name')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="schedule_start_end_datetime">Start & End Datetime:</label>
                <input
                    type="text"
                    class="form-control @error('start_datetime') is-invalid @enderror"
                    name="start_datetime"
                    id="schedule_room_start_end_datetime"
                    placeholder="Start & end date"
                    wire:model.defer="state.start_end_datetime"
                    readonly
                />
                @error('start_datetime')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="row ">
                @if($user->is_owner && $vacationRoom && $vacationRoom->id)
                    <div class="col-12 col-sm-4 col-md-6">
                        <a
                            href="#!"
                            class="btn btn-danger px-5 d-block d-sm-inline-block"
                            wire:click.prevent="destroy({{ $vacationRoom->id }})"
                        >
                            <i class="bi-trash me-2 d-none d-sm-inline-block"></i> Delete
                        </a>
                    </div>

                @endif
                <div class=" mt-2 mt-sm-0 col-12 col-sm-8 col-md-6 d-block d-sm-flex  justify-content-sm-end">
                    <div class="d-block d-sm-inline-block">
                        <button
                            href="#!"
                            class="btn btn-secondary ms-sm-auto w-100 w-sm-auto"
                            wire:click.prevent="cancelRoomVacation"
                        >
                            Cancel
                        </button>
                    </div>


                    <div class="mt-2 mt-sm-0">
                        <button
                            type="submit"
                            class="btn btn-primary ms-sm-2 w-100 w-sm-auto"
                        >
                            {{ $vacationRoom && $vacationRoom->id ? "Update" : 'Add' }} Vacation Room
                        </button>
                    </div>



                </div>

            </div>

{{--            <div class="d-flex">--}}
{{--                @if($user->is_owner && $vacationRoom && $vacationRoom->id)--}}
{{--                    <a--}}
{{--                        href="#!"--}}
{{--                        class="btn btn-danger px-5"--}}
{{--                        wire:click.prevent="destroy({{ $vacationRoom->id }})"--}}
{{--                    >--}}
{{--                        <i class="bi-trash me-2"></i> Delete--}}
{{--                    </a>--}}
{{--                @endif--}}

{{--                    <button--}}
{{--                        href="#!"--}}
{{--                        class="btn btn-secondary ms-auto"--}}
{{--                        wire:click.prevent="cancelRoomVacation"--}}
{{--                    >--}}
{{--                        Cancel--}}
{{--                    </button>--}}
{{--                    <button--}}
{{--                    type="submit"--}}
{{--                    class="btn btn-primary ms-2"--}}
{{--                >--}}
{{--                    {{ $vacationRoom && $vacationRoom->id ? "Update" : 'Add' }} Vacation Room--}}
{{--                </button>--}}
{{--            </div>--}}
        </form>
    </div>
    @push('scripts')
        <script>
            $(function () {
                var startDate = moment('{{ $start_datetime }}', 'DD-MM-YYYY HH:mm');
                var endDate = moment('{{ $end_datetime }}', 'DD-MM-YYYY HH:mm');
                $('#schedule_room_start_end_datetime').daterangepicker({
                    timePicker: true,
                    timePickerIncrement: 60,
                    showDropdowns: false,
                    minYear: parseInt(moment().subtract(10, 'years').format('YYYY'), 10),
                    maxYear: parseInt(moment().add(10, 'years').format('YYYY'), 10),
                    // minDate: moment().format('MM/DD/YYYY'),
                    startDate: @isset($state['start_date']) '{{ $state['start_date'] }}'
                    @else moment().set('minute', 0) @endisset,
                    endDate: @isset($state['end_date']) '{{ $state['end_date'] }}'
                    @else moment().set('minute', 0).add(2, 'days') @endisset,
                    locale: {
                        format: 'MM/DD/YYYY HH:mm'
                    },
                    isInvalidDate: function(ele) {
                        {{--console.log({{$state['start_date']}});--}}
                        var compareDate = moment(ele._d, 'DD-MM-YYYY HH:mm');
                        {{--startDate = moment('{{ $start_datetime }}', 'DD-MM-YYYY HH:mm');--}}
                        {{--endDate = moment('{{ $end_datetime }}', 'DD-MM-YYYY HH:mm');--}}
                        if(moment(compareDate).isBetween(startDate, endDate, null, '[]')){
                            return false;
                        }
                        else {
                            return true;
                        }
                    },
                    isCustomDate:function(ele)
                    {
                        var compareDate = moment(ele._d, 'DD-MM-YYYY HH:mm');
                        {{--startDate = moment('{{ $start_datetime }}', 'DD-MM-YYYY HH:mm');--}}
                        {{--endDate = moment('{{ $end_datetime }}', 'DD-MM-YYYY HH:mm');--}}

                        if(moment(compareDate).isBetween(startDate, endDate, null, '[]')){
                            return 'text-dark';
                        }
                        else {
                            return 'bg-warning text-light';
                        }
                    },
                });

                $('#schedule_room_start_end_datetime').on('change.daterangepicker', function (ev) {
                    var currentValue = $('#schedule_room_start_end_datetime').val();
                    var dateTime = currentValue.split('-');
                @this.
                set('state.start_date', dateTime[0]);
                @this.
                set('state.end_date', dateTime[1]);
                @this.
                set('state.start_end_datetime', dateTime[0] + ' - ' + dateTime[1]);

                    // $('.room-dates').attr('min', picker.startDate.format('YYYY-MM-DD'));
                    // $('.room-dates').attr('max', picker.endDate.format('YYYY-MM-DD'));
                });

                $('#schedule_room_start_end_datetime').on('apply.daterangepicker', function (ev, picker) {
                    @this.
                    set('state.start_date', picker.startDate.format('MM/DD/YYYY HH:mm'));
                    @this.
                    set('state.end_date', picker.endDate.format('MM/DD/YYYY HH:mm'));
                    @this.
                    set('state.start_end_datetime', picker.startDate.format('MM/DD/YYYY HH:mm') + ' - ' + picker.endDate.format('MM/DD/YYYY HH:mm'));
                });

                window.addEventListener('on-vacation-room-change', function (e) {
                // @this.
                // set('state.start_date', e.detail.startsAt);
                // @this.
                // set('state.end_date', e.detail.endsAt);
                // @this.
                // set('state.start_end_datetime', e.detail.startsAt + ' - ' + e.detail.endsAt);

                startDate =  moment(e.detail.startDate, 'DD-MM-YYYY HH:mm');
                endDate =  moment(e.detail.endDate, 'DD-MM-YYYY HH:mm');
                    $('#schedule_room_start_end_datetime').data('daterangepicker').setStartDate(e.detail.startsAt);
                    $('#schedule_room_start_end_datetime').data('daterangepicker').setEndDate(e.detail.endsAt);

                });

                // $('#schedule_room_start_end_datetime').click(function () {
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
