<x-settings>
    <x-slot name="title">
        Rooms
    </x-slot>
    <x-slot name="headerRightActions">
        <div class="col-sm-auto" x-data>

            @if($addedRooms < $maxRooms)
                <a
                    class="btn btn-primary"
                    href="javascript:;"
                    @click.prevent="window.livewire.emit('showRoomCUModal', true)"
                >
                    <i class="bi-plus me-1"></i> Add New Room
                </a>
            @else
                <a
                    class="btn btn-secondary"
                    href="javascript:;"
                    data-bs-toggle="modal"
                    data-bs-target="#maxRoomsModel"
                >
                    <i class="bi-plus me-1"></i> Add New Room
                </a>
            @endif


        </div>
    </x-slot>


    <div class="modal fade hideableModal" id="maxRoomsModel" tabindex="-1"
         aria-labelledby="" aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div>
                      <span class="rounded-circle text-primary border-primary" style="padding: 4px 9px; font-size: 26px; line-height: 75px;border: 3px solid;">
                        <i class="bi-exclamation"></i>
                    </span>
                    </div>

                    <h4 class="fw-bold text-center my-3"
                        style="color: #00000090">You can't Add New Room to the House.</h4>
                    <p class="fw-500 fs-15">First of all you need to delete your extra Room to add
                        new room Because the limit of your <b class="text-primary">Standard</b> plan is maximum  <b>{{ $maxRooms ?? '' }}</b>.</p>
                    <div class="btn-group my-2">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <livewire:settings.rooms.rooms-list :user="$user" />
    <livewire:settings.rooms.add-or-update-room-form :user="$user" />
</x-settings>
