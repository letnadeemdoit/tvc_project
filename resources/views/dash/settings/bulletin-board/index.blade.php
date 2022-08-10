<x-settings>
    <x-slot name="title">
        Bulletin Board
    </x-slot>
    <x-slot name="headerRightActions">
        <div class="col-sm-auto" x-data>
            <a
                class="btn btn-primary"
                href="javascript:;"
                @click.prevent="window.livewire.emit('showBulletinBoardCUModal', true)"
            >
                <i class="bi-plus me-1"></i> Add New Board Item
            </a>
        </div>
    </x-slot>

    <livewire:settings.bulletin-board.board-items-list :user="$user"/>
    <livewire:settings.bulletin-board.create-or-update-board-item-form :user="$user"/>
</x-settings>
