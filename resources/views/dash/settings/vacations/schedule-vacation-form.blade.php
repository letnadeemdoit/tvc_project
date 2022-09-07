<x-modals.bs-modal
    id="scheduleVacation"
>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ $vacation && $vacation->VacationName ? "Update" : 'Add' }} Vacation</h5>
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                @click.click="hide()"
            ></button>
        </div>
        <form
            wire:submit.prevent="saveVacationSchedule"
            class="modal-body"
{{--            @modal-is-shown.window="--}}
{{--                jQuery('.datetime-picker').datetimepicker({--}}
{{--                    changeMonth: true,--}}
{{--                    changeYear: true,--}}
{{--                    yearRange: '-10:+10',--}}
{{--                    beforeShow: function () {--}}
{{--                        var $datePicker = $('.date-picker');--}}
{{--                        var zIndexModal = $datePicker.closest('.modal').css('z-index');--}}
{{--                        $datePicker.css('z-index', zIndexModal + 1);--}}
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
            <div class="form-group mb-3">
                <label class="form-label" for="vacation_name">Vacation Name:</label>
                <input
                    type="text"
                    class="form-control @error('vacation_name') is-invalid @enderror"
                    name="vacation_name"
                    id="vacation_name"
                    placeholder="Vacation name"
                    wire:model.defer="state.vacation_name"
                />
                @error('vacation_name')
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
{{--            <div class="row mb-3">--}}
{{--                <div class="form-group col-md-6">--}}
{{--                    <label class="form-label" for="start_datetime">Start Datetime:</label>--}}
{{--                    <input--}}
{{--                        type="text"--}}
{{--                        class="form-control datetime-picker @error('start_datetime') is-invalid @enderror"--}}
{{--                        name="start_datetime"--}}
{{--                        id="start_datetime"--}}
{{--                        placeholder="Start date time"--}}
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
{{--                        class="form-control datetime-picker @error('end_datetime') is-invalid @enderror"--}}
{{--                        name="end_datetime"--}}
{{--                        id="end_datetime"--}}
{{--                        placeholder="End date time"--}}
{{--                        wire:model.defer="state.end_datetime"--}}

{{--                    />--}}
{{--                    @error('end_datetime')--}}
{{--                        <span class="invalid-feedback">{{ $message }}</span>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="row mb-3">
                <div class="form-group col-md-6" x-data="{bc: '{{ $state['background_color'] ?? '#3a87ad' }}'}">
                    <label class="form-label" for="background_color">Background Color:</label>
                    <select
                        name="background_color"
                        wire:model.defer="state.background_color"
                        id="background_color"
                        class="form-control @error('background_color') is-invalid @enderror"
                        :style="`background-color: ${bc}`"
                        x-model="bc"
                    >
                        <option value="#3a87ad" style="background-color: #3a87ad;">Default</option>
                        <option value="#F48058" style="background-color: #F48058;">Red</option>
                        <option value="#F4AC58" style="background-color: #F4AC58;">Orange</option>
                        <option value="#F3F298" style="background-color: #F3F298;">Yellow</option>
                        <option value="#B0EFA8" style="background-color: #B0EFA8;">Green</option>
                        <option value="#B9EAE3" style="background-color: #B9EAE3;">Light Blue</option>
                        <option value="#9ECCF8" style="background-color: #9ECCF8;">Dark Blue</option>
                        <option value="#9EB1F8" style="background-color: #9EB1F8;">Purple</option>
                        <option value="#DEB2F1" style="background-color: #DEB2F1;">Pink</option>
                        <option value="#FFFBF0" style="background-color: #FFFBF0;">White</option>
                    </select>
                    @error('background_color')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6" x-data="{fc: '{{ $state['font_color'] ?? '#ffffff' }}'}">
                    <label class="form-label" for="font_color">Font Color:</label>
                    <select
                        name="font_color"
                        id="font_color"
                        wire:model.defer="state.font_color"
                        class="form-control @error('font_color') is-invalid @enderror"
                        :style="`background-color: ${fc}; ${fc === '#32302B' ? 'color: #fff' : ''}`"
                        x-model="fc"
                    >
                        <option value="#ffffff" style="background-color: #ffffff;">Default</option>
                        <option value="#FEFCF6" style="background-color: #FEFCF6;">White</option>
                        <option value="#32302B" style="background-color: #32302B;">Black</option>
                        <option value="#94918B" style="background-color: #94918B;">Gray</option>
                    </select>
                    @error('font_color')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="d-flex">
                <button
                    type="submit"
                    class="btn btn-primary ms-auto"
                >
                    {{ $vacation && $vacation->VacationName ? "Update" : 'Add' }} Vacation
                </button>
            </div>
        </form>
    </div>
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            $('#schedule_start_end_datetime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 60,
                startDate: @isset($state['start_datetime']) '{{ $state['start_datetime'] }}'
                @else moment() @endisset,
                endDate: @isset($state['end_datetime']) '{{ $state['end_datetime'] }}'
                @else moment()
                .add(2, 'days') @endisset,
                locale: {
                    format: 'MM/DD/YYYY HH:mm'
                }
            });
        });
    </script>
    @push('scripts')
        <script>
            $(function() {
                $('#schedule_start_end_datetime').on('apply.daterangepicker', function(ev, picker) {
                    @this.set('state.start_datetime', picker.startDate.format('MM/DD/YYYY HH:mm'), true);
                    @this.set('state.end_datetime', picker.endDate.format('MM/DD/YYYY HH:mm'), true);
                    @this.set('state.start_end_datetime', picker.startDate.format('MM/DD/YYYY HH:mm') + ' - ' + picker.endDate.format('MM/DD/YYYY HH:mm'), true);
                });
            });
        </script>
    @endpush
</x-modals.bs-modal>
