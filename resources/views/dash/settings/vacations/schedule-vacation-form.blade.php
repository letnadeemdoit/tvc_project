<x-modals.bs-modal
    id="scheduleVacation"
>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ $vacation && $vacation->VacationName ? "Update '$vacation->VacationName'" : 'Add' }} Vacation</h5>
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
            @modal-is-shown.window="
                jQuery('.datetime-picker').datetimepicker({
                    changeMonth: true,
                    changeYear: true,
                    yearRange: '-10:+10',
                    beforeShow: function () {
                        var $datePicker = $('.date-picker');
                        var zIndexModal = $datePicker.closest('.modal').css('z-index');
                        $datePicker.css('z-index', zIndexModal + 1);
                    },
                    onSelect: function (date, datepicker) {
                        @this.set('state.' + datepicker.id, date, true);
                    },
                    hour: 12,
                    minute: 0,
                    showMinute: false,
                    stepMinute: 60,
                    showSecond: false,
                    showMillisec: false,
                    showMicrosec: false,
                    showTimezone: false,
                    addSliderAccess: true,
                    sliderAccessArgs: { touchonly: false }
                })
                .attr('readonly', 'true')
                .keypress(function (event) {
                    if (event.keyCode === 8) {
                        event.preventDefault();
                    }
                });
            "
        >
            <div class="form-group mb-3">
                <label class="form-label" for="vacation_name">Vacation Name:</label>
                <input
                    type="text"
                    class="form-control @error('vacation_name') is-invalid @enderror"
                    name="vacation_name"
                    id="vacation_name"
                    wire:model.defer="state.vacation_name"
                />
                @error('vacation_name')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label class="form-label" for="start_datetime">Start Datetime:</label>
                    <input
                        type="text"
                        class="form-control datetime-picker @error('start_datetime') is-invalid @enderror"
                        name="start_datetime"
                        id="start_datetime"
                        wire:model.defer="state.start_datetime"

                    />
                    @error('start_datetime')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="end_datetime">End Datetime:</label>
                    <input
                        type="text"
                        class="form-control datetime-picker @error('end_datetime') is-invalid @enderror"
                        name="end_datetime"
                        id="end_datetime"
                        wire:model.defer="state.end_datetime"

                    />
                    @error('end_datetime')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label class="form-label" for="background_color">Background Color:</label>
                    <input
                        type="color"
                        class="form-control @error('background_color') is-invalid @enderror"
                        name="background_color"
                        id="background_color"
                        value="#ffffff"
                        wire:model.defer="state.background_color"
                    />
                    @error('background_color')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="font_color">Font Color:</label>
                    <input
                        type="color"
                        class="form-control @error('font_color') is-invalid @enderror"
                        name="font_color"
                        id="font_color"
                        value="#ffffff"
                        wire:model.defer="state.font_color"
                    />
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
                    {{ $vacation && $vacation->VacationName ? "Update '$vacation->VacationName'" : 'Add' }} Vacation
                </button>
            </div>
        </form>
    </div>
</x-modals.bs-modal>
