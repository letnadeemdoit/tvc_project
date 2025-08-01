<x-modals.bs-modal
    id="addOrUpdateUser"
>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ $room && $room->RoomName ? "Update" : 'Add' }} Room</h5>
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                @click.click="hide()"
            ></button>
        </div>
        <form wire:submit.prevent="saveRoomCU" class="modal-body">
            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label class="form-label" for="name">Name:*</label>
                    <input
                        type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        name="name"
                        placeholder="Name"
                        id="name"
                        wire:model.defer="state.name"
                    />
                    @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="type">Type:</label>
                    <select
                        type="text"
                        class="form-control @error('type') is-invalid @enderror"
                        name="type"
                        id="type"
                        wire:model.defer="state.type"
                    >
                        <option>Choose room type</option>
                        @foreach($this->roomTypes as $roomType)
                            <option value="{{ $roomType->RoomTypeID }}">{{ $roomType->RoomTypeVal }}</option>
                        @endforeach
                    </select>
                    @error('type')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label class="form-label" for="beds">Beds:*</label>
                    <input
                        type="text"
                        class="form-control @error('beds') is-invalid @enderror"
                        name="beds"
                        placeholder="Beds"
                        id="beds"
                        wire:model.defer="state.beds"
                    />
                    @error('beds')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="bed_type_id">Bed Type:</label>
                    <select
                        type="text"
                        class="form-control @error('bed_type_id') is-invalid @enderror"
                        name="bed_type_id"
                        id="bed_type_id"
                        wire:model.defer="state.bed_type_id"
                    >
                        <option>Choose bed type</option>
                        @foreach($this->bedTypes as $bedType)
                            <option value="{{ $bedType->id }}">{{ $bedType->name }}</option>
                        @endforeach
                    </select>
                    @error('bed_type_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
{{--            <div class="form-group mb-3">--}}
{{--                <label class="form-label" for="amenities">Amenities: <span class="ms-2 fw-semi-bold fs-12">(CTRL or CMD + Click to Select Multiple Amenities)</span></label>--}}
{{--                <select--}}
{{--                    type="text"--}}
{{--                    class="form-control @error('amenities') is-invalid @enderror"--}}
{{--                    name="amenities"--}}
{{--                    id="amenities"--}}
{{--                    wire:model.defer="state.amenities"--}}
{{--                    multiple--}}
{{--                >--}}
{{--                    @foreach($this->amenities as $amenity)--}}
{{--                        <option value="{{ $amenity->AmenityID }}">{{ $amenity->Abreviation }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--                @error('amenities')--}}
{{--                <span class="invalid-feedback">{{ $message }}</span>--}}
{{--                @enderror--}}
{{--            </div>--}}

            <div class="d-flex">
                <button
                    type="submit"
                    class="btn btn-primary ms-auto"
                >
                    {{ $room && $room->RoomName ? "Update" : 'Add' }} Room
                </button>
            </div>
        </form>
    </div>
</x-modals.bs-modal>
