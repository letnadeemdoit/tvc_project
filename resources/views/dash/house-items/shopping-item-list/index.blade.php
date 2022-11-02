<x-dashboard-layout>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item active" aria-current="page">Shopping Items</li>
    </x-slot>
    <x-slot name="title">
        <h1 class="page-header-title">Shopping Items</h1>
    </x-slot>

    <x-slot name="headerRightActions">

        <div class="col-sm-auto" x-data>
            <a
                class="btn btn-primary"
                href="#!"
                @click.prevent="window.livewire.emit('showShoppingItemCUModal', true)"
            >
                <i class="bi-plus me-1"></i> Add New Shopping Item
            </a>
        </div>

    </x-slot>

    <livewire:house-items.shopping-item.shopping-item-list :user="$user"/>
    <livewire:house-items.shopping-item.create-or-update-shopping-item-form :user="$user"/>

</x-dashboard-layout>



