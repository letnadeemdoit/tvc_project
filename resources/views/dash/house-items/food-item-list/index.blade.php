<x-dashboard-layout>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item active" aria-current="page">Food Items</li>
    </x-slot>
    <x-slot name="title">
        <h1 class="page-header-title">Food Items</h1>
    </x-slot>

    <x-slot name="headerRightActions">

        <div class="col-sm-auto" x-data>
            <a
                class="btn btn-primary"
                href="javascript:void(0);"
                @click.prevent="window.livewire.emit('showFoodItemCUModal', true)"
            >
                <i class="bi-plus me-1"></i> Add New Food Item
            </a>
        </div>

    </x-slot>
    <livewire:house-items.food-item.food-item-list :user="$user"/>
    <livewire:house-items.food-item.create-or-update-food-item-form :user="$user"/>

</x-dashboard-layout>


