<x-settings>

    <x-slot name="title">
        Bulletin Board
    </x-slot>
    <x-slot name="headerRightActions">
        <div class="col-sm-auto" x-data>
            <a
                class="btn btn-primary"
                href="javascript:;"
                @click.prevent="window.livewire.emit('showBulletinBoardModal', true, )"
{{--                data-bs-toggle="modal" --}}
{{--                data-bs-target="#newProjectModal"--}}
            >
                <i class="bi-plus me-1"></i> Add New Board Item
            </a>
        </div>
    </x-slot>

    <livewire:settings.bulletin-board.board-items-list :user="$user"/>
    <livewire:settings.bulletin-board.update-or-create-board-item-form :user="$user"/>

</x-settings>
