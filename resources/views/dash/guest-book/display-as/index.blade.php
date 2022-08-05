<x-app-layout>

    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header" x-data>
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Guest Book</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="javascript:;" @click.prevent="window.livewire.emit('openResetForm')">
                        <i class="bi-plus me-1"></i>Create New Guest book
                    </a>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->

        @livewire('guest-book.display-as.book-list')
    </div>


</x-app-layout>



