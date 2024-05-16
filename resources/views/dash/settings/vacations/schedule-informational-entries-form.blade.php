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

            <div class="row mb-3">
                <div class="col-12 col-lg-6 mb-sm-0">
                    <div class="mb-3">
                        <label for="task_start_date" class="form-label">Task Start
                            Date:</label>
                        <input
                            type="text"
                            class="form-control @error('task_start_date') is-invalid @enderror"
                            name="task_start_date"
                            wire:model.defer="state.task_start_date"
                            id="calendar_task_start_date"
                            placeholder="Start Date"
                            readonly
                        />
                        @error('task_start_date')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-lg-6 mb-sm-0">
                    <div class="mb-3">
                        <label for="task_end_date" class="form-label">Task End
                            Date:</label>
                        <input
                            type="text"
                            class="form-control @error('task_end_date') is-invalid @enderror"
                            name="task_end_date"
                            wire:model.defer="state.task_end_date"
                            id="calendar_task_end_date"
                            placeholder="End Date"
                            readonly
                        />
                        @error('task_end_date')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="form-label">Repeat:</label>
                <div class="col-12 col-lg-4 mb-3 mb-sm-0">
                    <!-- Form Radio -->
                    <label class="form-control" for="recurrence_once">
                        <span class="form-check">
                            <input type="radio"
                                   wire:model="state.recurrence"
                                   wire:change.prevent="updateRecurrence('once')"
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
                                   wire:change.prevent="updateRecurrence('weekly')"
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
                                   wire:change.prevent="updateRecurrence('yearly')"
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
            {{--            @if(isset($state['recurrence']) && $state['recurrence'] === 'weekly')--}}
            <div class="form-group mb-3" id="view_end_repeat_date" wire:ignore>
                <label
                    class="form-label"
                    for="end_repeat_date"
                >End Repeat Date:</label>
                <input
                    type="text"
                    class="form-control @error('end_repeat_date') is-invalid @enderror"
                    name="end_repeat_date"
                    id="end_task_repeat_date"
                    placeholder="End Repeat Date"
                    wire:model.defer="state.end_repeat_date"
                    readonly
                />
                @error('end_repeat_date')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror

            </div>
            {{--            @endif--}}


            <div class="row ">
                @if(!$user->is_guest && $vacation && $vacation->VacationId)
                    <div class="col-12 col-sm-4 col-md-5">
                        <a
                            href="#!"
                            class="btn btn-danger px-5 d-block d-sm-inline-block"
                            wire:click.prevent="deleteVacation"
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

                //calendar_task_start_date
                $('#calendar_task_start_date').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: parseInt(moment().subtract(10, 'years').format('YYYY'), 10),
                    maxYear: parseInt(moment().add(10, 'years').format('YYYY'), 10),
                    startDate: @isset($state['task_start_date']) '{{ $state['task_start_date'] }}'
                    @else moment().set('minute', 0) @endisset,
                    locale: {
                        format: 'MM/DD/YYYY'
                    }
                });

                $('#calendar_task_start_date').on('apply.daterangepicker', function (ev, picker) {
                    ev.preventDefault();
                @this.set('state.task_start_date', picker.startDate.format('MM/DD/YYYY'));
                });


                $('#calendar_task_start_date').on('change.daterangepicker', function (ev) {
                    ev.preventDefault();
                    var currentValue = $('#calendar_task_start_date').val();
                @this.set('state.task_start_date', currentValue);
                });


                //calendar_task_end_date
                $('#calendar_task_end_date').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: parseInt(moment().subtract(10, 'years').format('YYYY'), 10),
                    maxYear: parseInt(moment().add(10, 'years').format('YYYY'), 10),

                    startDate: @isset($state['task_end_date']) '{{ $state['task_end_date'] }}'
                    @else moment().set('minute', 0) @endisset,

                    locale: {
                        format: 'MM/DD/YYYY'
                    }
                });

                $('#calendar_task_end_date').on('apply.daterangepicker', function (ev, picker) {
                    ev.preventDefault();
                @this.set('state.task_end_date', picker.startDate.format('MM/DD/YYYY'));
                });


                $('#calendar_task_end_date').on('change.daterangepicker', function (ev) {
                    ev.preventDefault();
                    var currentValue = $('#calendar_task_end_date').val();
                @this.set('state.task_end_date', currentValue);
                });


                // end_repeat_date
                $('#end_task_repeat_date').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: parseInt(moment().subtract(10, 'years').format('YYYY'), 10),
                    maxYear: parseInt(moment().add(10, 'years').format('YYYY'), 10),

                    startDate: @isset($state['end_repeat_date']) '{{ $state['end_repeat_date'] }}'
                    @else moment().set('minute', 0) @endisset,

                    locale: {
                        format: 'MM/DD/YYYY'
                    }
                });

                $('#end_task_repeat_date').on('apply.daterangepicker', function (ev, picker) {
                    ev.preventDefault();
                @this.set('state.end_repeat_date', picker.startDate.format('MM/DD/YYYY'));
                });


                $('#end_task_repeat_date').on('change.daterangepicker', function (ev) {
                    ev.preventDefault();
                    var currentValue = $('#end_task_repeat_date').val();
                @this.set('state.end_repeat_date', currentValue);
                });



                @if(isset($state['recurrence']) && $state['recurrence'] !== 'weekly')
                   $('#view_end_repeat_date').hide();
                @endif

                window.livewire.on('enableUpdateRecurrence', function (recurrence) {
                    console.log("Called");
                   if (recurrence === 'weekly'){
                       $('#view_end_repeat_date').show();
                   }
                   else {
                       $('#view_end_repeat_date').hide();
                   }
                });

            });

        </script>
    @endpush
</div>
