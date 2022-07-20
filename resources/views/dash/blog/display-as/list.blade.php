<div class="card">
    <!-- Header -->
    <div class="card-header">
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
                        <div class="input-group-prepend input-group-text">
                            <i class="bi-search"></i>
                        </div>
                        <input id="datatableWithSearchInput" type="search" class="form-control"
                               placeholder="Search users" aria-label="Search users">
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
                <th>HouseId</th>
                <th>Subject</th>
                <th>Author</th>
                <th>Content</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>

            {{--            <tr>--}}
            {{--                <td>--}}
            {{--                    <a class="d-flex align-items-center" href="../user-profile.html">--}}
            {{--                        <div class="avatar avatar-circle">--}}
            {{--                            <img class="avatar-img" src="{{asset('admin/assets/img/160x160/img10.jpg')}}" alt="Image Description">--}}
            {{--                        </div>--}}
            {{--                        <div class="ms-3">--}}
            {{--                            <span class="d-block h5 text-inherit mb-0">Amanda Harvey <i class="bi-patch-check-fill text-primary" data-toggle="tooltip" data-bs-placement="top" title="Top endorsed"></i></span>--}}
            {{--                            <span class="d-block fs-5 text-body">amanda@example.com</span>--}}
            {{--                        </div>--}}
            {{--                    </a>--}}
            {{--                </td>--}}
            {{--                <td>--}}
            {{--                    <span class="d-block h5 mb-0">Director</span>--}}
            {{--                    <span class="d-block fs-5">Human resources</span>--}}
            {{--                </td>--}}
            {{--                <td>United Kingdom</td>--}}
            {{--                <td>--}}
            {{--                    <span class="legend-indicator bg-success"></span>Active--}}
            {{--                </td>--}}
            {{--                <td>--}}
            {{--                    <div class="btn-group" role="group" aria-label="Edit group">--}}
            {{--                        <a class="btn btn-white" href="#">--}}
            {{--                            <i class="bi-pencil me-1"></i> Edit--}}
            {{--                        </a>--}}
            {{--                        <a class="btn btn-white" href="#">--}}
            {{--                            <i class="bi-trash"></i>--}}
            {{--                        </a>--}}
            {{--                    </div>--}}
            {{--                </td>--}}
            {{--            </tr>--}}


            @if(isset($blogs))
                @foreach($blogs as $blog)
                    <tr>
                        <td>
                            <a class="d-flex align-items-center" href="../user-profile.html">
                                <div class="avatar avatar-soft-primary avatar-circle">
                                    <span class="avatar-initials">G</span>
                                </div>
                                <div class="ms-3">
                                    <span class="d-block h5 text-inherit mb-0">Gary Bishop <i
                                            class="bi-patch-check-fill text-primary" data-toggle="tooltip"
                                            data-bs-placement="top" title="Top endorsed"></i></span>
                                    <span class="d-block fs-5 text-body">gary@example.com</span>
                                </div>
                            </a>
                        </td>
                        <td>
                            <span class="d-block h5 mb-0">{{$blog->Subject ?? ''}}</span>
                        </td>
                        <td>{{$blog->Author}}</td>
                        <td>
                            <span class="legend-indicator bg-success"></span>Active
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Edit group">
                                <a class="btn btn-white" href="#">
                                    <i class="bi-pencil me-1"></i> Edit
                                </a>
                                <a class="btn btn-white" href="#"
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


</div>
