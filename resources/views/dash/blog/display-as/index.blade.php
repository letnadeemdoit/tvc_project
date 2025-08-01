<x-app-layout>

    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header" x-data>
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Blogs</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" title="Add Blog" href="javascript:;" @click.prevent="window.livewire.emit('openResetBlogForm')">
                        <i class="bi-plus me-1"></i> Add New Blog
                    </a>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->

    @livewire('blog.display-as-list')

    </div>
</x-app-layout>
