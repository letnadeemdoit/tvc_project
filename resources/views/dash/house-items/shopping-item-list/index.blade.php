<x-app-layout>
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Shopping Items</h1>
                </div>

                <div class="col-sm-auto" x-data>
                    <a
                        class="btn btn-primary"
                        href="javascript:;"
                        @click.prevent="window.livewire.emit('showShoppingItemCUModal', true)"
                    >
                        <i class="bi-plus me-1"></i> Add New Shopping Item
                    </a>
                </div>

            </div>
        </div>
        <livewire:house-items.shopping-item.shopping-item-list :user="$user"/>
        <livewire:house-items.shopping-item.create-or-update-shopping-item-form :user="$user"/>

    </div>
</x-app-layout>
