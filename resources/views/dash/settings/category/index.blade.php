<x-settings>
    <x-slot name="title">
        Categories
    </x-slot>
    <x-slot name="headerRightActions">
        <div class="col-sm-auto" x-data>
            <a
                class="btn btn-primary"
                href="javascript:;"
                @click.prevent="window.livewire.emit('showCategoryCUModal', true)"
            >
                <i class="bi-plus me-1"></i> Add New Category
            </a>
        </div>
    </x-slot>

    <livewire:settings.categories.categories-item-list :user="$user"/>
    <livewire:settings.categories.create-or-update-category-item :user="$user"/>
</x-settings>
