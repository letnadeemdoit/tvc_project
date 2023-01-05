<x-modals.bs-modal
    id="scheduleRoomVacation"
>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ $vacation && $vacation->VacationName ? "Update" : 'Add' }} Vacation Room</h5>
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                @click.click="hide()"
            ></button>
        </div>
        <form
            wire:submit.prevent="saveVacationRoomSchedule"
            class="modal-body"
        >
            {{--            <x-jet-validation-errors />--}}
            <div class="form-group mb-3">
                <label class="form-label" for="vacation_name">Select Vacation:</label>

                <select
                    type="text"
                    class="form-control @error('vacation_name') is-invalid @enderror"
                    name="vacation_id"
                    {{--                    id="vacation_name"--}}
                    {{--                    placeholder="Vacation name"--}}
                    {{--                    wire:model.defer="state.vacation_name"--}}
                    wire:model="state.vacation_id"
                    wire:change="onChangeVacation"
                >
                    <option value="">Select Vacation</option>

                    @if(isset($vacations) && count($vacations) > 0)
                        @foreach($vacations as $v)
                            <option value="{{$v->VacationId}}">{{ $v->VacationName }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="schedule_start_end_datetime">Start & End Datetime:</label>
                <input
                    type="text"
                    class="form-control @error('start_datetime') is-invalid @enderror"
                    name="start_datetime"
                    id="schedule_room_start_end_date"
                    placeholder="Start & end date"
                    wire:model.defer="state.start_end_date"
                    readonly
                />
                @error('start_datetime')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="d-flex">
                @if($user->is_owner && $vacation && $vacation->VacationId)
                    <a
                        href="#!"
                        class="btn btn-danger px-5"
                        wire:click.prevent="deleteVacation"
                    >
                        <i class="bi-trash me-2"></i> Delete
                    </a>
                @endif

                <button
                    type="submit"
                    class="btn btn-primary ms-auto"
                >
                    {{ $vacation && $vacation->VacationName ? "Update" : 'Add' }} Vacation
                </button>
            </div>
        </form>
    </div>
    @push('scripts')
        <script>
            $(function () {
                $('#schedule_room_start_end_date').daterangepicker({
                    timePicker: true,
                    timePickerIncrement: 60,
                    showDropdowns: true,
                    minYear: parseInt(moment().subtract(10, 'years').format('YYYY'), 10),
                    maxYear: parseInt(moment().add(10, 'years').format('YYYY'), 10),
                    // minDate: moment().format('MM/DD/YYYY'),
                    startDate: @isset($state['start_date']) '{{ $state['start_date'] }}'
                    @else moment().set('minute', 0) @endisset,
                    endDate: @isset($state['end_date']) '{{ $state['end_date'] }}'
                    @else moment().set('minute', 0).add(2, 'days') @endisset,
                    locale: {
                        format: 'MM/DD/YYYY HH:mm'
                    }
                });

                $('#schedule_room_start_end_date').on('apply.daterangepicker', function (ev, picker) {
                    @this.
                    set('state.start_date', picker.startDate.format('MM/DD/YYYY HH:mm'));
                    @this.
                    set('state.end_date', picker.endDate.format('MM/DD/YYYY HH:mm'));
                    @this.
                    set('state.start_end_date', picker.startDate.format('MM/DD/YYYY HH:mm') + ' - ' + picker.endDate.format('MM/DD/YYYY HH:mm'));
                });

                window.addEventListener('onChangeVacation', function (e) {
                    console.log(e.detail)

                    $('#schedule_room_start_end_date').data('daterangepicker').setStartDate(e.detail.startsAt);
                    $('#schedule_room_start_end_date').data('daterangepicker').setEndDate(e.detail.endsAt);
                    $('#schedule_room_start_end_date').val(`${e.detail.startsAt} - ${e.detail.endsAt}`);

                    // alert('Name updated to: ' + event.detail.startsAt);
                })


                // window.addEventListener('schedule-vacation-daterangepicker-update', function (e) {
                //     console.log(e.detail);
                //     $('#schedule_room_start_end_date').data('daterangepicker').setStartDate(e.detail.startDatetime);
                //     $('#schedule_room_start_end_date').data('daterangepicker').setEndDate(e.detail.endDatetime);
                //     $('#schedule_room_start_end_date').val(`${e.detail.startDatetime} - ${e.detail.endDatetime}`);
                // });
            });
        </script>
    @endpush
</x-modals.bs-modal>
