<x-settings>
    <x-slot name="title">
        Users
    </x-slot>
    <x-slot name="headerRightActions">
        @can('create', \App\Models\User::class)
            <div class="col-sm-auto" x-data>
                <a
                    class="btn btn-primary"
                    href="javascript:;"
                    @click.prevent="window.livewire.emit('showUserCUModal', true)"
                >
                    <i class="bi-plus me-1"></i> Add New User
                </a>
            </div>
        @endcan
    </x-slot>
    @can('viewAny', \App\Models\User::class)
        <livewire:settings.users.users-list :user="$user" />
    @endcan

    @canany(['create', 'update'], \App\Models\User::class)
        <livewire:settings.users.create-or-update-user-form :user="$user" />
        <livewire:settings.users.send-credentials-modal :user="$user" />
    @endcanany
</x-settings>
