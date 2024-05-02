<div id="startEndTimeOfVacation" class="card">
    @if(!$user->is_super_admin)
        <div class="card-header">
            <h4 class="card-title">Vacation Default Time</h4>
        </div>

        <!-- Body -->
        <div class="card-body">
            <!-- Form -->
            <form wire:submit.prevent="UpdateStartEndTimeOfVacation">
                @if($user->is_admin)
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="update_start_time_of_vacation" class="form-label">Vacation Start
                                    Time:</label>
                                <input
                                    type="text"
                                    class="form-control @error('update_start_time') is-invalid @enderror"
                                    name="update_start_time"
                                    wire:model.defer="state.update_start_time"
                                    id="update_start_time_of_vacation"
                                    placeholder="Start Time"
                                    readonly
                                />
                                @error('update_start_time')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="update_end_time_of_vacation" class="form-label">Vacation End Time:</label>
                                <input
                                    type="text"
                                    class="form-control @error('update_end_time') is-invalid @enderror"
                                    name="update_end_time"
                                    wire:model.defer="state.update_end_time"
                                    id="update_end_time_of_vacation"
                                    placeholder="End Time"
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

                $('#update_start_time_of_vacation').on('show.daterangepicker', function (ev) {
                    let calendar_tables = document.querySelectorAll('.calendar-table');
                    if (calendar_tables.length > 0) {
                        $(calendar_tables[0]).hide();
                        $(calendar_tables[1]).hide();
                    }
                });

                $('#update_end_time_of_vacation').on('show.daterangepicker', function (ev) {
                    let calendar_tables = document.querySelectorAll('.calendar-table');
                    if (calendar_tables.length > 0) {
                        $(calendar_tables[2]).hide();
                        $(calendar_tables[3]).hide();
                    }
                });


                //update_start_time_of_vacation
                $('#update_start_time_of_vacation').daterangepicker({
                    singleDatePicker: true,
                    timePicker: true,
                    timePickerIncrement: 60,
                    minDate: false,
                    maxDate: false,
                    startDate:
                        @isset($state['update_start_time']) '{{ $state['update_start_time'] }}'
                    @else moment().set('hour', 13).set('minute', 0) @endisset,
                    locale: {
                        format: 'HH:mm'
                    }
                });

                $('#update_start_time_of_vacation').on('apply.daterangepicker', function (ev, picker) {
                @this.set('state.update_start_time', picker.startDate.format('HH:mm'));
                });


                $('#update_start_time_of_vacation').on('change.daterangepicker', function (ev) {
                    var currentValue = $('#update_start_time_of_vacation').val();
                @this.set('state.update_start_time', currentValue);
                });


                //update_end_time_of_vacation
                $('#update_end_time_of_vacation').daterangepicker({
                    singleDatePicker: true,
                    timePicker: true,
                    timePickerIncrement: 60,
                    minDate: false,
                    maxDate: false,
                    startDate: @isset($state['update_end_time']) '{{ $state['update_end_time'] }}'
                    @else moment().set('hour', 12).set('minute', 0) @endisset,
                    locale: {
                        format: 'HH:mm'
                    }
                });

                $('#update_end_time_of_vacation').on('apply.daterangepicker', function (ev, picker) {
                @this.set('state.update_end_time', picker.startDate.format('HH:mm'));
                });


                $('#update_end_time_of_vacation').on('change.daterangepicker', function (ev) {
                    var currentValue = $('#update_end_time_of_vacation').val();
                @this.set('state.update_end_time', currentValue);
                });


            });

        </script>
    @endpush

</div>
