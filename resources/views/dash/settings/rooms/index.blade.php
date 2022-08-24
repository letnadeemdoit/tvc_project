<x-settings>
    <x-slot name="title">
        Rooms
    </x-slot>
    <x-slot name="headerRightActions">
        <div class="col-sm-auto" x-data>
            <a
                class="btn btn-primary"
                href="javascript:;"
                @click.prevent="window.livewire.emit('showRoomCUModal', true)"
            >
                <i class="bi-plus me-1"></i> Add New Room
            </a>
        </div>
    </x-slot>

    <livewire:settings.rooms.rooms-list :user="$user" />
</x-settings>
