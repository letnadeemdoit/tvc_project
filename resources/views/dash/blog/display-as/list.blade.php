<div class="card">
    <!-- Header -->
    <div class="card-header">
        @include('flash-messages')
        <div class="row justify-content-between align-items-center flex-grow-1">
            <div class="col-12 col-md">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-header-title">Blogs</h5>
                </div>
            </div>

            <div class="col-auto">
                <!-- Filter -->
                <form>
                    <!-- Search -->
                    <div class="input-group input-group-merge input-group-flush">
                        <div class="input-group-prepend input-group-text" wire:loading.remove>
                            <i class="bi-search"></i>
                        </div>

                        <div class="input-group-prepend input-group-text" wire:loading wire:target="searchQuery">
                            <div class="spinner-border" style="width: 20px;height: 20px" role="status">
                            </div>
                        </div>

                        <input wire:model="searchQuery" id="datatableWithSearchInput" type="search" class="form-control"
                               placeholder="Search blogs" aria-label="Search Blogs">
                    </div>
                    <!-- End Search -->
                </form>
                <!-- End Filter -->
            </div>
        </div>
    </div>
    <!-- End Header -->

    <!-- Table -->
    <div class="table-responsive datatable-custom">
        <table
            class="js-datatable table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
            data-hs-datatables-options='{
                   "order": [],
                   "search": "#datatableWithSearchInput",
                   "isResponsive": false,
                   "isShowPaging": false,
                   "pagination": "datatableWithSearchPagination"
                 }'>
            <thead class="thead-light">
            <tr>
                <th>User</th>
                <th>Subject</th>
                <th>Author</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>

            <tbody>

            @if(isset($blogs) && !empty($blogs))
                @foreach($blogs as $blog)
                    <tr>
                        <td>
                            <a class="d-flex align-items-center" href="../user-profile.html">
                                <div class="avatar avatar-soft-primary avatar-circle">
                                    <span class="avatar-initials">{{!empty($blog->Audit_FirstName) ? substr($blog->Audit_FirstName, 0, 1) : 'A'}}</span>
                                </div>
                                <div class="ms-3">
                                    <span class="d-block h5 text-inherit mb-0">{{$blog->Audit_FirstName ?? ''}} <i
                                            class="bi-patch-check-fill text-primary" data-toggle="tooltip"
                                            data-bs-placement="top" title="Top endorsed"></i></span>
                                    <span class="d-block fs-5 text-body">{{$blog->Audit_Email ?? ''}}</span>
                                </div>
                            </a>
                        </td>
                        <td>
                            {{$blog->Subject ?? ''}}
                        </td>
                        <td>{{$blog->Author ?? ''}}</td>
                        <td class="mx-auto text-center">
                            <div class="btn-group" role="group" aria-label="Edit group">
                                <a class="btn btn-ghost-success" title="Edit Blog" href="#" wire:click="editBlogData({{ $blog->BlogId }})"
                                   data-bs-toggle="modal" data-bs-target="#createOrUpdateModal">
                                    <i class="bi-pencil me-1"></i> Edit
                                </a>
                                <a class="btn btn-ghost-danger" title="Delete Blog" href="#"
                                   data-bs-toggle="modal" data-bs-target="#deleteConfirmation{{ $blog->BlogId }}Modal"
                                >
                                    <i class="bi-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif


            </tbody>
        </table>
        <div class="d-flex mt-4">
            {!! $blogs->links() !!}
        </div>
    </div>
    <!-- End Table -->

    <!-- Footer -->
    <div class="card-footer">
        <!-- Pagination -->
        <div class="d-flex justify-content-center justify-content-sm-end">
            <nav id="datatableWithSearchPagination" aria-label="Activity pagination"></nav>
        </div>
        <!-- End Pagination -->
    </div>
    <!-- End Footer -->

    @if(isset($blogs))
        @foreach($blogs as $blog)
            <x-modals.delete-confirmation :id="$blog->BlogId" action="destroy({{$blog->BlogId}})"/>
        @endforeach
    @endif
    @include('dash.blog.display-as.create-or-update-modal')


</div>

@pushonce('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{{--<script>--}}
{{--    const myTimeout = setTimeout(myGreeting, 5000);--}}
{{--    function myGreeting() {--}}
{{--        document.querySelector('.success-message').style.display = "none";--}}
{{--    }--}}
{{--</script>--}}
@endpushonce
