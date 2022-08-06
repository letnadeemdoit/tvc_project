<x-settings>
    <x-slot name="title">
        Users
    </x-slot>
    <x-slot name="headerRightActions">
        <div class="col-sm-auto" x-data>
            <a
                class="btn btn-primary"
                href="javascript:;"
                @click.prevent="window.livewire.emit('showUserCUModal', true)"
            >
                <i class="bi-plus me-1"></i> Add New User
            </a>
        </div>
    </x-slot>
    <livewire:settings.users.users-list :user="$user" />
    <livewire:settings.users.create-or-update-user-form :user="$user" />
</x-settings>
