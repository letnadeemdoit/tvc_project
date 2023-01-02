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
        >
            {{--            <x-jet-validation-errors />--}}
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
                    <label class="form-control" for="recurrence_monthly">
                        <span class="form-check">
                            <input type="radio"
                                   wire:model="state.recurrence"
                                   value="monthly"
                                   class="form-check-input"
                                   checked
                                   name="recurrence"
                                   id="recurrence_monthly"
                            />
                            <span class="form-check-label">Monthly</span>
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
                    >Repeat Interval:</label>
                    <input
                        type="number"
                        class="form-control @error('repeat_interval') is-invalid @enderror"
                        name="repeat_interval"
                        id="repeat_interval"
                        placeholder="Vacation Repeat Interval"
                        wire:model.defer="state.repeat_interval"
                    />
                    @error('repeat_interval')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            @endif
            <div class="row mb-3">
                <div class="form-group col-md-6 mb-md-0 mb-3"
                     x-data="{bc: '{{ $state['background_color'] ?? '#E8604C' }}'}">
                    <label class="form-label" for="background_color">Background Color:</label>
                    <select
                        name="background_color"
                        wire:model.defer="state.background_color"
                        id="background_color"
                        class="form-control @error('background_color') is-invalid @enderror"
                        :style="`background-color: ${bc}`"
                        x-model="bc"
                    >
                        <option value="#E8604C" style="background-color: #E8604C;">Default</option>
                        <option value="#ff0000" style="background-color: #ff0000;">Red</option>
                        <option value="#FF5733" style="background-color: #FF5733;">Orange</option>
                        <option value="#FFFF00" style="background-color: #FFFF00;">Yellow</option>
                        <option value="#22bb22" style="background-color: #22bb22;">Green</option>
                        <option value="#add8e6" style="background-color: #add8e6;">Light Blue</option>
                        <option value="#00008b" style="background-color: #00008b;color: #efeaea">Dark Blue</option>
                        <option value="#6a0dad" style="background-color: #6a0dad;">Purple</option>
                        <option value="#ffc0cb" style="background-color: #ffc0cb;">Pink</option>
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
                        <option value="#32302B" style="background-color: #32302B;color: #ffffff">Black</option>
                        <option value="#94918B" style="background-color: #94918B;">Gray</option>
                    </select>
                    @error('font_color')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            @if(primary_user()->enable_rooms == 1)
                <hr class="my-3"/>
                <div
                    class="form-check form-switch form-switch-between d-flex justify-content-between align-items-center {{ isset($state['book_rooms']) && $state['book_rooms'] == 0 ? 'mb-3' : 'mb-2' }}">
                    <label class="form-check-label fw-bold text-primary fs-4 mb-1" for="book_rooms">Book Rooms</label>
                    <input
                        type="checkbox"
                        id="book_rooms"
                        class="form-check-input me-0"
                        value="1"
                        wire:model="state.book_rooms"
                    />
                </div>
                @if(isset($state['book_rooms']) && $state['book_rooms'] == 1)
                    <div class="list-group list-group-flush list-group-sm mb-3">
                        @if(count(current_house()->rooms) > 0)
                        @foreach(current_house()->rooms as $room)
                            <div class="list-group-item">
                                <label class="d-flex p-2">
                                    <input
                                        class="form-check-input me-1"
                                        type="checkbox"
                                        value="{{ $room->RoomID }}"
                                        wire:model="state.rooms.{{$loop->index}}.room_id"
                                    />
                                    <span class="ms-2">
                                        <span class="fw-semi-bold">{{ $room->RoomName }}</span> <br/>
                                        <small style="font-size: 11px;" class="text-muted"><strong>Type:</strong> {{ $room->roomType->RoomTypeVal }}</small>,
                                        <small style="font-size: 11px;" class="text-muted"><strong>Amenities:</strong> {{ implode(', ', $room->amenities->pluck('AmenityName')->toArray()) }}</small>,
                                        <small style="font-size: 11px;" class="text-muted"><strong>Beds:</strong> {{ $room->Beds }}</small>
                                    </span>
                                </label>
                                @if(count($state['vacation_rooms']) > 0 && isset($state['vacation_rooms'][$room->RoomID]))
                                    @foreach($state['vacation_rooms'][$room->RoomID] as $vacationRoom)
                                        <div class="d-flex align-items-center {{ !$loop->first ? 'mt-3' : '' }}">
                                            <label
                                                class="me-2"
                                                for="room_{{ $room->RoomID . $loop->index }}date_starts_at"
                                            >
                                                From:*
                                            </label>
                                            <input
                                                id="room_{{ $room->RoomID . $loop->index }}date_starts_at"
                                                type="date"
                                                class="form-control form-control-sm room-dates px-2 py-1"
                                                @isset($state['start_datetime']) min="{{ \Carbon\Carbon::parse($state['start_datetime'])->format('Y-m-d') }}"
                                                @endisset
                                                @isset($state['end_datetime']) max="{{ \Carbon\Carbon::parse($state['end_datetime'])->format('Y-m-d') }}"
                                                @endisset
                                                {{ isset($state['rooms']) && isset($state['rooms'][$loop->parent->index]) && isset($state['rooms'][$loop->parent->index]['room_id']) && $state['rooms'][$loop->parent->index]['room_id'] == $room->RoomID ? '' : 'disabled'  }}
                                                wire:model="state.vacation_rooms.{{$room->RoomID}}.{{ $loop->index }}.starts_at"
                                                wire:loading.attr="disabled"
                                                wire:target="addRoomSchedule,removeRoomSchedule"
                                            />
                                            <label
                                                class="ms-3 me-2"
                                                for="room_{{ $room->RoomID . $loop->index }}date_ends_at"
                                            >
                                                To:*
                                            </label>
                                            <input
                                                id="room_{{ $room->RoomID . $loop->index }}date_ends_at"
                                                type="date"
                                                class="form-control form-control-sm room-dates px-2 py-1"
                                                @isset($state['start_datetime']) min="{{ \Carbon\Carbon::parse($state['start_datetime'])->format('Y-m-d') }}"
                                                @endisset
                                                @isset($state['end_datetime']) max="{{ \Carbon\Carbon::parse($state['end_datetime'])->format('Y-m-d') }}"
                                                @endisset
                                                {{ isset($state['rooms']) && isset($state['rooms'][$loop->parent->index]) && isset($state['rooms'][$loop->parent->index]['room_id']) && $state['rooms'][$loop->parent->index]['room_id'] == $room->RoomID ? '' : 'disabled'  }}
                                                wire:model="state.vacation_rooms.{{$room->RoomID}}.{{ $loop->index }}.ends_at"
                                                wire:loading.attr="disabled"
                                                wire:target="addRoomSchedule,removeRoomSchedule"
                                            />
                                            @if($loop->last)
                                                <button
                                                    {{ isset($state['rooms']) && isset($state['rooms'][$loop->parent->index]) && isset($state['rooms'][$loop->parent->index]['room_id']) && $state['rooms'][$loop->parent->index]['room_id'] == $room->RoomID ? '' : 'disabled'  }}
                                                    wire:click.prevent="addRoomSchedule({{ $room->RoomID }})"
                                                    wire:target="addRoomSchedule,removeRoomSchedule"
                                                    wire:loading.attr="disabled"
                                                    class="position-absolute btn btn-link p-0"
                                                    style="right: -15px"
                                                >
                                                    <i class="bi bi-plus-square-fill"></i>
                                                </button>
                                            @else
                                                <button
                                                    class="position-absolute btn btn-link p-0"
                                                    style="right: -15px"
                                                    wire:click.prevent="removeRoomSchedule({{ $room->RoomID }}, {{ $loop->index }})"
                                                    wire:loading.attr="disabled"
                                                    wire:target="addRoomSchedule,removeRoomSchedule"

                                                    {{ isset($state['rooms']) && isset($state['rooms'][$loop->parent->index]) && isset($state['rooms'][$loop->parent->index]['room_id']) && $state['rooms'][$loop->parent->index]['room_id'] == $room->RoomID ? '' : 'disabled'  }}
                                                >
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <div class="d-flex align-items-center">
                                        <label
                                            class="me-2"
                                            for="room_{{ $room->RoomID}}date_starts_at"
                                        >
                                            From:*
                                        </label>
                                        <input
                                            id="room_{{ $room->RoomID }}date_starts_at"
                                            type="date"
                                            class="form-control form-control-sm room-dates px-2 py-1"
                                            @isset($state['start_datetime']) min="{{ \Carbon\Carbon::parse($state['start_datetime'])->format('Y-m-d') }}"
                                            @endisset
                                            @isset($state['end_datetime']) max="{{ \Carbon\Carbon::parse($state['end_datetime'])->format('Y-m-d') }}"
                                            @endisset
                                            {{ isset($state['rooms']) && isset($state['rooms'][$loop->index]) && isset($state['rooms'][$loop->index]['room_id']) && $state['rooms'][$loop->index]['room_id'] == $room->RoomID ? '' : 'disabled'  }}
                                            wire:model="state.vacation_rooms.{{$room->RoomID}}.{{ $loop->index }}.starts_at"
                                            wire:loading.attr="disabled"
                                            wire:target="addRoomSchedule,removeRoomSchedule"
                                        />
                                        <label
                                            class="ms-3 me-2"
                                            for="room_{{ $room->RoomID . $loop->index }}date_ends_at"
                                        >
                                            To:*
                                        </label>
                                        <input
                                            id="room_{{ $room->RoomID . $loop->index }}date_ends_at"
                                            type="date"
                                            class="form-control form-control-sm room-dates px-2 py-1"
                                            @isset($state['start_datetime']) min="{{ \Carbon\Carbon::parse($state['start_datetime'])->format('Y-m-d') }}"
                                            @endisset
                                            @isset($state['end_datetime']) max="{{ \Carbon\Carbon::parse($state['end_datetime'])->format('Y-m-d') }}"
                                            @endisset
                                            {{ isset($state['rooms']) && isset($state['rooms'][$loop->index]) && isset($state['rooms'][$loop->index]['room_id']) && $state['rooms'][$loop->index]['room_id'] == $room->RoomID ? '' : 'disabled'  }}
                                            wire:model="state.vacation_rooms.{{$room->RoomID}}.{{ $loop->index }}.ends_at"
                                            wire:loading.attr="disabled"
                                            wire:target="addRoomSchedule,removeRoomSchedule"
                                        />

                                        <button
                                            {{ isset($state['rooms']) && isset($state['rooms'][$loop->index]) && isset($state['rooms'][$loop->index]['room_id']) && $state['rooms'][$loop->index]['room_id'] == $room->RoomID ? '' : 'disabled'  }}
                                            class="position-absolute btn btn-link p-0"
                                            style="right: -15px"
                                            wire:click.prevent="addRoomSchedule({{ $room->RoomID }})"
                                            wire:target="addRoomSchedule,removeRoomSchedule"
                                            wire:loading.attr="disabled"
                                        >
                                            <i class="bi bi-plus-square-fill"></i>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        @else
                            <div>
                                <p>You don't have any room yet please add room first.</p>
                            </div>
                        @endif
                    </div>
                @endif
            @endif
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
                $('#schedule_start_end_datetime').daterangepicker({
                    timePicker: true,
                    timePickerIncrement: 60,
                    showDropdowns: true,
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

                $('#schedule_start_end_datetime').on('apply.daterangepicker', function (ev, picker) {
                    @this.
                    set('state.start_datetime', picker.startDate.format('MM/DD/YYYY HH:mm'));
                    @this.
                    set('state.end_datetime', picker.endDate.format('MM/DD/YYYY HH:mm'));
                    @this.
                    set('state.start_end_datetime', picker.startDate.format('MM/DD/YYYY HH:mm') + ' - ' + picker.endDate.format('MM/DD/YYYY HH:mm'));

                    $('.room-dates').attr('min', picker.startDate.format('YYYY-MM-DD'));
                    $('.room-dates').attr('max', picker.endDate.format('YYYY-MM-DD'));
                });

                window.addEventListener('schedule-vacation-daterangepicker-update', function (e) {
                    console.log(e.detail);
                    $('#schedule_start_end_datetime').data('daterangepicker').setStartDate(e.detail.startDatetime);
                    $('#schedule_start_end_datetime').data('daterangepicker').setEndDate(e.detail.endDatetime);

                    $('#schedule_start_end_datetime').val(`${e.detail.startDatetime} - ${e.detail.endDatetime}`);

                    $('.room-dates').attr('min', moment(e.detail.startDatetime, 'DD/MM/YYYY').format('YYYY-MM-DD'));
                    $('.room-dates').attr('max', moment(e.detail.startDatetime, 'DD/MM/YYYY').format('YYYY-MM-DD'));
                });

            });
        </script>
    @endpush
</x-modals.bs-modal>
