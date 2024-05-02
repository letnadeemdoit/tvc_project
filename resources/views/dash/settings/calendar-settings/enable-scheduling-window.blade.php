<div id="enableSchedulingWindow" class="card">
    @if(!$user->is_super_admin)
        <div class="card-header">
            <h4 class="card-title">Calendar Dates</h4>
        </div>

        <!-- Body -->
        <div class="card-body">
            <!-- Form -->
            <form wire:submit.prevent="enableSchedulingWindow">
                @if($user->is_admin)
                    <label class="row form-check form-switch mb-4" for="enable_scheduling_window">
                            <span class="col-8 col-sm-9 ms-0">
                              <span class="d-block text-dark mb-1">Enable Scheduling Window.</span>
                              <span class="d-block fs-5 text-muted">
                                  Use this option to enable calendar dates.
                              </span>
                            </span>
                        <span class="col-4 col-sm-3 text-end">
                              <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="enable_scheduling_window"
                                  name="enable_scheduling_window"
                                  wire:model.defer="state.enable_scheduling_window"
                                  wire:change="scheduleWindow"
                                  value="1"
                              />
                            </span>
                    </label>

                    <div class="row mb-4" id="schedulingWindowInputs">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="schedule_vacation_start_date" class="form-label">Scheduling Window
                                    Start:</label>
                                <input
                                    type="text"
                                    class="form-control @error('vacation_start_date') is-invalid @enderror"
                                    name="vacation_start_date"
                                    wire:model.defer="state.vacation_start_date"
                                    id="schedule_vacation_start_date"
                                    placeholder="Scheduling Window Start"
                                    readonly
                                />
                                @error('vacation_start_date')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="schedule_vacation_end_date" class="form-label">Scheduling Window
                                    Close:</label>
                                <input
                                    type="text"
                                    class="form-control @error('vacation_end_date') is-invalid @enderror"
                                    name="vacation_end_date"
                                    wire:model.defer="state.vacation_end_date"
                                    id="schedule_vacation_end_date"
                                    placeholder="Scheduling Window Close"
                                    readonly
                                />
                                @error('vacation_end_date')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                @endif
                <div class="d-flex align-items-center justify-content-end">
                    <x-jet-action-message class="text-success me-2" on="saved"/>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
            <!-- End Form -->
        </div>
        <!-- End Body -->
    @endif


    @push('scripts')
            <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
            <script type="text/javascript"
                    src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
            <script>
                $(function () {
                    window.livewire.emit('checkScheduleWindowProperty');

                    window.livewire.on('enableScheduleWindowChanged', function (enableScheduleWindow) {

                        $('#schedule_vacation_start_date').daterangepicker({
                            singleDatePicker: true,
                            showDropdowns: true,
                            minYear: parseInt(moment().subtract(10, 'years').format('YYYY'), 10),
                            maxYear: parseInt(moment().add(10, 'years').format('YYYY'), 10),
                            startDate: @isset($state['vacation_start_date']) '{{ $state['vacation_start_date'] }}'
                            @else moment().set('minute', 0) @endisset,
                            locale: {
                                format: 'MM/DD/YYYY'
                            }
                        });

                        $('#schedule_vacation_start_date').on('apply.daterangepicker', function (ev, picker) {
                        @this.set('state.vacation_start_date', picker.startDate.format('MM/DD/YYYY'));
                        });


                        $('#schedule_vacation_start_date').on('change.daterangepicker', function (ev) {
                            var currentValue = $('#schedule_vacation_start_date').val();
                        @this.set('state.vacation_start_date', currentValue);
                        });


                        $('#schedule_vacation_end_date').daterangepicker({
                            singleDatePicker: true,
                            showDropdowns: true,
                            minYear: parseInt(moment().subtract(10, 'years').format('YYYY'), 10),
                            maxYear: parseInt(moment().add(10, 'years').format('YYYY'), 10),

                            startDate: @isset($state['vacation_end_date']) '{{ $state['vacation_end_date'] }}'
                            @else moment().set('minute', 0) @endisset,

                            locale: {
                                format: 'MM/DD/YYYY'
                            }
                        });

                        $('#schedule_vacation_end_date').on('apply.daterangepicker', function (ev, picker) {
                        @this.set('state.vacation_end_date', picker.startDate.format('MM/DD/YYYY'));
                        });


                        $('#schedule_vacation_end_date').on('change.daterangepicker', function (ev) {
                            var currentValue = $('#schedule_vacation_start_date').val();
                        @this.set('state.vacation_end_date', currentValue);
                        });


                        if (enableScheduleWindow) {
                            $('#schedulingWindowInputs').show();
                        } else {
                            $('#schedulingWindowInputs').hide();
                        }

                    });

                });

            </script>
        @endpush

</div>
