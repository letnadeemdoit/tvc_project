<x-settings>
    <x-slot name="title">
        Additional Houses
    </x-slot>
    <x-slot name="headerRightActions">
        <div class="col-sm-auto" x-data>
            <a
                class="btn btn-primary"
                href="javascript:;"
                @click.prevent="window.livewire.emit('showAdditionalHouseCUModal', true)"
            >
                <i class="bi-plus me-1"></i> Add New House
            </a>
        </div>
    </x-slot>

    <livewire:settings.additional-houses.houses-list :user="$user"/>
    <livewire:settings.additional-houses.create-or-update-house-form :user="$user"/>
</x-settings>
