<x-settings>
    <x-slot name="title">
        Super Admin Account
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

        <livewire:super-admin.users-list :user="$user" />
        <livewire:super-admin.create-or-update-user-form :user="$user" />

</x-settings>
