<div
    id="scheduleTask"
>
    <div class="modal-content">
        <div class="modal-header mb-2">
            <h5 class="modal-title">{{ $vacation && $vacation->VacationName ? "Update" : 'Add' }} Task</h5>
        </div>
        <form
            wire:submit.prevent="scheduleCalendarTask"
            class="modal-body"
        >
            {{--            <x-jet-validation-errors />--}}
            <div class="form-group mb-3">
                <label class="form-label" for="task_title">Title:</label>
                <input
                    type="text"
                    class="form-control @error('task_title') is-invalid @enderror"
                    name="task_title"
                    id="task_title"
                    placeholder="Task title"
                    wire:model.defer="state.task_title"
                />
                @error('task_title')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="schedule_start_end_datetime">Start & End Datetime:</label>
                <input
                    type="text"
                    class="form-control @error('start_datetime') is-invalid @enderror"
                    name="start_datetime"
                    id="schedule_start_end_datetime"
                    placeholder="Start & end date time"
                    wire:model.defer="state.start_end_datetime"
                    readonly
                />
                @error('start_datetime')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="row mb-3">
                <label for="" class="form-label">Repeat:</label>
                <div class="col-12 col-lg-4 mb-3 mb-sm-0">
                    <!-- Form Radio -->
                    <label class="form-control" for="recurrence_once">
                        <span class="form-check">
                            <input type="radio"
                                   wire:model="state.recurrence"
                                   value="once"
                                   class="form-check-input"
                                   checked
                                   name="recurrence"
                                   id="recurrence_once"
                            />
                            <span class="form-check-label">Once</span>
                        </span>
                    </label>
                    <!-- End Form Radio -->
                </div>
                <div class="col-12 col-lg-4  mb-3 mb-sm-0">
                    <!-- Form Radio -->
                    <label class="form-control" for="recurrence_weekly">
                        <span class="form-check">
                            <input type="radio"
                                   wire:model="state.recurrence"
                                   value="weekly"
                                   class="form-check-input"
                                   checked
                                   name="recurrence"
                                   id="recurrence_weekly"
                            />
                            <span class="form-check-label">Weekly</span>
                        </span>
                    </label>
                    <!-- End Form Radio -->
                </div>

                <div class="col-12 col-lg-4  mb-3 mb-sm-0">
                    <!-- Form Radio -->
                    <label class="form-control" for="recurrence_yearly">
                        <span class="form-check">
                            <input type="radio"
                                   value="yearly"
                                   wire:model="state.recurrence"
                                   class="form-check-input"
                                   name="recurrence"
                                   id="recurrence_yearly"
                            />
                            <span class="form-check-label">Yearly</span>
                        </span>
                    </label>
                    <!-- End Form Radio -->
                </div>
            </div>
            @if(isset($state['recurrence']) && $state['recurrence'] !== 'once')
                <div class="form-group mb-3">
                    <label
                        class="form-label"
                        for="repeat_interval"
                    >How many times should this event repeat?</label>
                    <input
                        type="number"
                        class="form-control @error('repeat_interval') is-invalid @enderror"
                        name="repeat_interval"
                        id="repeat_interval"
                        placeholder="Task Repeat Interval"
                        wire:model.defer="state.repeat_interval"
                    />
                    @error('repeat_interval')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            @endif
            {{--            @if(isset($state['recurrence']) && $state['recurrence'] === 'weekly')--}}
{{--            <div class="form-group mb-3" id="view_end_repeat_date" wire:ignore>--}}
{{--                <label--}}
{{--                    class="form-label"--}}
{{--                    for="end_repeat_date"--}}
{{--                >End Repeat Date:</label>--}}
{{--                <input--}}
{{--                    type="text"--}}
{{--                    class="form-control @error('end_repeat_date') is-invalid @enderror"--}}
{{--                    name="end_repeat_date"--}}
{{--                    id="end_task_repeat_date"--}}
{{--                    placeholder="End Repeat Date"--}}
{{--                    wire:model.defer="state.end_repeat_date"--}}
{{--                    readonly--}}
{{--                />--}}
{{--                @error('end_repeat_date')--}}
{{--                <span class="invalid-feedback">{{ $message }}</span>--}}
{{--                @enderror--}}

{{--            </div>--}}
            {{--            @endif--}}


            <div class="row ">
                @if(!$user->is_guest && $vacation && $vacation->VacationId)
                    <div class="col-12 col-sm-4 col-md-5">
                        <a
                            href="#!"
                            class="btn btn-danger px-5 d-block d-sm-inline-block"
                            wire:click.prevent="deleteCalendarTask"
                        >
                            <i class="bi-trash me-2 d-none d-sm-inline-block"></i> Delete
                        </a>
                    </div>

                @endif
                <div class=" mt-2 mt-sm-0 col-12 col-sm-8 col-md-7 d-block d-sm-flex  justify-content-sm-end">
                    <div class="d-block d-sm-inline-block">
                        <button
                            href="#!"
                            class="btn btn-secondary me-sm-auto w-100 w-sm-auto"
                            wire:click.prevent="cancelVacation"
                        >
                            Cancel
                        </button>
                    </div>

                    <div class="mt-2 mt-sm-0">
                        <button
                            type="submit"
                            class="btn btn-primary ms-sm-2 w-100 w-sm-auto"
                        >
                            {{ $vacation && $vacation->VacationName ? "Update" : 'Add' }} Task
                        </button>
                    </div>


                </div>

            </div>
        </form>
    </div>


    @push('scripts')
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript"
                src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script>
            $(document).ready(function() {

                var datePicker;
                $('#schedule_start_end_datetime').daterangepicker({
                    timePicker: true,
                    timePickerIncrement: 60,
                    validateOnBlur: false,
                    showDropdowns: false,
                    // autoApply: true,
                    minYear: parseInt(moment().subtract(10, 'years').format('YYYY'), 10),
                    maxYear: parseInt(moment().add(10, 'years').format('YYYY'), 10),
                    // minDate: moment().format('MM/DD/YYYY'),
                    startDate: @isset($state['start_datetime']) '{{ $state['start_datetime'] }}'
                    @else moment().set('minute', 0) @endisset,
                    endDate: @isset($state['end_datetime']) '{{ $state['end_datetime'] }}'
                    @else moment().set('minute', 0).add(2, 'days') @endisset,
                    locale: {
                        format: 'MM/DD/YYYY HH:mm'
                    }
                });
                $('#schedule_start_end_datetime').on('change.daterangepicker', function (ev) {
                    var currentValue = $('#schedule_start_end_datetime').val();
                    var dateTime = currentValue.split('-');
                @this.
                set('state.start_datetime', dateTime[0]);
                @this.
                set('state.end_datetime', dateTime[1]);
                @this.
                set('state.start_end_datetime', dateTime[0] + ' - ' + dateTime[1]);

                    // $('.room-dates').attr('min', picker.startDate.format('YYYY-MM-DD'));
                    // $('.room-dates').attr('max', picker.endDate.format('YYYY-MM-DD'));
                });

                $('#schedule_start_end_datetime').on('apply.daterangepicker', function (ev, picker) {
                    datePicker = picker;
                    console.log(datePicker);
                @this.
                set('state.start_datetime', picker.startDate.format('MM/DD/YYYY HH:mm'));
                @this.
                set('state.end_datetime', picker.endDate.format('MM/DD/YYYY HH:mm'));
                @this.
                set('state.start_end_datetime', picker.startDate.format('MM/DD/YYYY HH:mm') + ' - ' + picker.endDate.format('MM/DD/YYYY HH:mm'));

                    $('.room-dates').attr('min', picker.startDate.format('YYYY-MM-DD'));
                    $('.room-dates').attr('max', picker.endDate.format('YYYY-MM-DD'));
                });


{{--                @if(isset($state['recurrence']) && $state['recurrence'] !== 'weekly')--}}
{{--                   $('#view_end_repeat_date').hide();--}}
{{--                @endif--}}

{{--                window.livewire.on('enableUpdateRecurrence', function (recurrence) {--}}
{{--                    console.log("Called");--}}
{{--                   if (recurrence === 'weekly'){--}}
{{--                       $('#view_end_repeat_date').show();--}}
{{--                   }--}}
{{--                   else {--}}
{{--                       $('#view_end_repeat_date').hide();--}}
{{--                   }--}}
{{--                });--}}

            });

        </script>
    @endpush
</div>
