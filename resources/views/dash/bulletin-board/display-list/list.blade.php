<x-app-layout>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header" x-data>
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Bulletins</h1>
                </div>
                <div class="col-auto">
                    <a class="btn btn-primary" title="Add Bulletin" href="javascript:;" @click.prevent="window.livewire.emit('openResetBulletinForm')">
                        <i class="bi-plus me-1"></i> Add New Bulletin
                    </a>
                </div>
            </div>
        </div>
        @livewire('bulletin-board.display-list')
    </div>
</x-app-layout>


{{--@push('scripts')--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--}}
{{--    <script type='text/javascript'>--}}
{{--        setTimeout(function() {--}}
{{--            $('#addOrEditBoardModal').modal();--}}
{{--        }, 5000);--}}
{{--    </script>--}}
{{--@endpush--}}


