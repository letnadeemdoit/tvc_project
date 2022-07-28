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
                <th>User Name</th>
                <th>Full Name</th>
                <th>Role</th>
                <th>House</th>
                <th>Intro</th>
                <th>Show Old Save</th>
                <th>Admin Owner</th>
                <th>Check Audit Details</th>
{{--                <th>Content</th>--}}
                <th>Action</th>
            </tr>
            </thead>

            <tbody>

            @if(isset($users))
                @foreach($users as $user)
                    <tr>
                        <td>
                            <a class="d-flex align-items-center" href="../user-profile.html">
                                <div class="avatar avatar-soft-primary avatar-circle">
                                    <span class="avatar-initials">{{substr($user->first_name, 0, 1)}}</span>
                                </div>
                                <div class="ms-3">
                                    <span class="d-block h5 text-inherit mb-0">{{$user->user_name}} </span>
                                    <span class="d-block fs-5 text-body">{{$user->email}}</span>
                                </div>
                            </a>
                        </td>
                        <td>{{$user->first_name}} {{$user->last_name}}</td>
                        <td>{{$user->role}}</td>
                        <td>{{$user->HouseId}}</td>
                        <td>{{$user->Intro}}</td>
                        <td>{{$user->ShowOldSave}}</td>
                        <td>{{$user->AdminOwner}}</td>
                        <td>
                            @if(!is_null($user->Audit_user_name))
                              <a class="btn btn-sm btn-success text-white"
                                 data-bs-toggle="modal"
                                 data-bs-target="#audit{{$user->user_id}}Modal"
                                 style="width: 130px" href="">Click to view</a>
                            @else
                                <a class="btn btn-sm btn-warning text-white" style="width: 130px" href="">No Audit</a>
                            @endif
                        </td>

                        <!-- Modal -->
                        <div class="modal fade" id="audit{{$user->user_id}}Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title text-primary" id="exampleModalLabel">Audit Details</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card shadow-none border-0">
                                            <div class="card-body">
                                               <div class="mb-3">
                                                   <h5 class="card-title">Audit User Name</h5>
                                                   <h6 class="card-subtitle mb-2 text-muted">{{$user->Audit_user_name}}</h6>
                                               </div>
                                                <div class="mb-3">
                                                    <h5 class="card-title">Audit Role</h5>
                                                    <h6 class="card-subtitle mb-2 text-muted">{{$user->Audit_Role}}</h6>
                                                </div>
                                                <div class="mb-3">
                                                    <h5 class="card-title">Audit First Name</h5>
                                                    <h6 class="card-subtitle mb-2 text-muted">{{$user->Audit_FirstName}}</h6>
                                                </div>
                                                <div class="mb-3">
                                                    <h5 class="card-title">Audit Last Name</h5>
                                                    <h6 class="card-subtitle mb-2 text-muted">{{$user->Audit_LastName}}</h6>
                                                </div>
                                                <div class="mb-3">
                                                    <h5 class="card-title">Audit Email</h5>
                                                    <h6 class="card-subtitle mb-2 text-muted">{{$user->Audit_Email}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



{{--                        <td>--}}
{{--                            <span class="legend-indicator bg-success"></span>-----}}
{{--                        </td>--}}

                        <td>
                            <div class="btn-group" role="group" aria-label="Edit group">
                                <a class="btn btn-white" href="#">
                                    <i class="bi-pencil me-1"></i> Edit
                                </a>
                                <a class="btn btn-white" href="#"
                                   data-bs-toggle="modal" data-bs-target="#deleteConfirmation{{ $user->user_id }}Modal"
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
            {!! $users->links() !!}
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

    @if(isset($users))
        @foreach($users as $user)

            <x-modals.delete-confirmation :id="$user->user_id" action="destroy({{$user->user_id}})"/>

        @endforeach
    @endif


</div>
