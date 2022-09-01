<x-dashboard-layout>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item active" aria-current="page">Local Guide</li>
    </x-slot>
    <x-slot name="title">
        <h1 class="page-header-title">Local Guide</h1>
    </x-slot>

    <x-slot name="headerRightActions">

        <div class="col-sm-auto" x-data>
            <a
                class="btn btn-primary"
                href="javascript:;"
                @click.prevent="window.livewire.emit('showLocalGuideCUModal', true)"
            >
                <i class="bi-plus me-1"></i> Add New Local Guide
            </a>
        </div>

    </x-slot>
    <livewire:settings.local-guide.local-guide-list :user="$user"/>
    <livewire:settings.local-guide.create-or-update-local-guide-form :user="$user"/>

</x-dashboard-layout>


