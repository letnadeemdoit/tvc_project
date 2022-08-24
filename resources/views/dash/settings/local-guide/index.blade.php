<x-app-layout>
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Local Guide</h1>
                </div>

                <div class="col-sm-auto" x-data>
                    <a
                        class="btn btn-primary"
                        href="javascript:;"
                        @click.prevent="window.livewire.emit('showLocalGuideCUModal', true)"
                    >
                        <i class="bi-plus me-1"></i> Add New Local Guide
                    </a>
                </div>

            </div>
        </div>
        <livewire:settings.local-guide.local-guide-list :user="$user"/>
        <livewire:settings.local-guide.create-or-update-local-guide-form :user="$user"/>

    </div>
</x-app-layout>
