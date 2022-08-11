<x-settings>
    <x-slot name="title">
       Guest Book
    </x-slot>
    <x-slot name="headerRightActions">
        <div class="col-sm-auto" x-data>
            <a
                class="btn btn-primary"
                href="javascript:;"
                @click.prevent="window.livewire.emit('showGuestBookCUModal', true)"
            >
                <i class="bi-plus me-1"></i> Add New Guest Book
            </a>
        </div>
    </x-slot>

    <livewire:settings.guest-book.guest-book-list :user="$user"/>

    <livewire:settings.guest-book.create-or-update-guset-book-form :user="$user"/>
</x-settings>

