<x-app-layout>
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Food Items</h1>
                </div>

                <div class="col-sm-auto" x-data>
                    <a
                        class="btn btn-primary"
                        href="javascript:void(0);"
                        @click.prevent="window.livewire.emit('showFoodItemCUModal', true)"
                    >
                        <i class="bi-plus me-1"></i> Add New Food Item
                    </a>
                </div>

            </div>
        </div>

        <livewire:house-items.food-item.food-item-list :user="$user"/>
        <livewire:house-items.food-item.create-or-update-food-item-form :user="$user"/>

    </div>
</x-app-layout>
