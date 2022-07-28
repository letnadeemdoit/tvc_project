<div class="card">
    <!-- Header -->
    <div class="card-header">
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="row justify-content-between align-items-center flex-grow-1">
            <div class="col-12 col-md">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-header-title">Users</h5>
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
                                 style="width: 130px" href="#!">Click to view</a>
                            @else
                                <a class="btn btn-sm btn-warning text-white" style="width: 130px" href="#!">No Audit</a>
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

                        <td>
                            <div class="btn-group" role="group" aria-label="Edit group">
                                <a class="btn btn-white" href="#"
                                   data-bs-toggle="modal"
                                   data-bs-target="#updateUser{{$user->user_id}}Modal"
                                >
                                    <i class="bi-pencil me-1"></i> Edit
                                </a>
                                <a class="btn btn-white" href="#"
                                   data-bs-toggle="modal" data-bs-target="#deleteConfirmation{{ $user->user_id }}Modal"
                                >
                                    <i class="bi-trash"></i>
                                </a>
                            </div>

                            <!--Update User Modal -->
                            <div class="modal fade" id="updateUser{{$user->user_id}}Modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Update User {{$user->user_id}}</h5>
                                            <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>


                                        <div class="modal-body">
                                            <form class=""  action="{{ route('users.update',$user->user_id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <fieldset class="scheduler-border fieldset-padding">
                                                    <legend class="scheduler-border">House Details:  {{$user->HouseName}}</legend>
                                                    <!-- Form -->

                                                    <div class="row pt-2">
                                                        <div class="col-md-12">
                                                            <!-- Form -->
                                                            <div class="mb-2">
                                                                <fieldset class="border-light scheduler-border">
                                                                    <legend class="float-none w-auto fs-5 mb-0">House Name*</legend>
                                                                    <input
                                                                        type="text"
                                                                        class="form-control form-control-lg"
                                                                        name="HouseName"
                                                                        id="HouseName"
                                                                        placeholder="Enter House Name"
                                                                        value="{{$user->HouseName}}"
                                                                    />
                                                                </fieldset>
                                                                @error('HouseName')
                                                                <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                            <!-- End Form -->
                                                        </div>
                                                    </div>
                                                    {{--     second row starts --}}

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mt-3">
                                                                <fieldset class="border-light scheduler-border">
                                                                    <legend class="float-none w-auto fs-5 mb-0">City</legend>
                                                                    <input
                                                                        type="text"
                                                                        class="form-control"
                                                                        id="city"
                                                                        name="City"
                                                                        placeholder="City"
                                                                        value="{{$user->City}}"
                                                                    />

                                                                </fieldset>
                                                                @error('City')
                                                                <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class=" col-md-6">
                                                            <div class="mt-3">
                                                                <fieldset class="border-light scheduler-border">
                                                                    <legend class="float-none w-auto fs-5 mb-0">State</legend>
                                                                    <input
                                                                        type="text"
                                                                        class="form-control"
                                                                        name="State"
                                                                        id="State"
                                                                        placeholder="State"
                                                                        value="{{$user->State}}"
                                                                        aria-label=""
                                                                    />
                                                                </fieldset>
                                                                @error('State')
                                                                <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mt-3">
                                                                <fieldset class="border-light scheduler-border">
                                                                    <legend class="float-none w-auto fs-5 mb-0">Paypal Account</legend>
                                                                    <input
                                                                        type="number"
                                                                        class="form-control form-control-lg"
                                                                        id="ReferredBy"
                                                                        name="ReferredBy"
                                                                        placeholder=""
                                                                        value="{{$user->ReferredBy}}"
                                                                    />
                                                                </fieldset>
                                                                @error('ReferredBy')
                                                                <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                                                @enderror
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div class="mb-2">
                                                        <div id="basicExampleDropzone" class="js-dropzone row dz-dropzone dz-dropzone-card border-primary bg-primary-light">
                                                            <div class="dz-message">
                                                                {{--                                        <img class="avatar avatar-xl avatar-4x3 mb-3" src="../assets/svg/illustrations/oc-browse.svg" alt="Image Description">--}}

                                                                <h5>Drag and drop your file here</h5>

                                                                <p class="mb-2">or</p>

                                                                <span class="btn bg-primary btn-sm text-white">Upload Image</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <!-- End Form -->
                                                <!-- second fieldset -->
                                                <fieldset class="scheduler-border fieldset-padding">
                                                    <legend class="scheduler-border">Admin Details</legend>
                                                    <!-- Form -->
                                                    <div class="row pt-2">
                                                        <div class="col-md-6">
                                                            <!-- Form -->
                                                            <div class="mb-2">
                                                                <fieldset class="border-light input-group scheduler-border">
                                                                    <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0">Username</legend>
                                                                    <input type="text" class="form-control form-control-lg border-end-0"
                                                                           name="user_name"
                                                                           id="user_name" tabindex="1"
                                                                           placeholder=""
                                                                           value="{{ old('user_name') }}"
                                                                           aria-label=""
                                                                    />
                                                                    <a id="changePassTarget-2" class="input-group-append input-group-text border-0" href="javascript:;">
                                                                        <i class="bi bi-person text-primary"></i>
                                                                    </a>
                                                                </fieldset>
                                                                @error('user_name')
                                                                <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                            <!-- End Form -->
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="">
                                                                <fieldset class="border-light input-group scheduler-border">
                                                                    <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0">Email</legend>
                                                                    <input type="email" class="form-control form-control-lg border-end-0"
                                                                           name="email" value=""
                                                                           id="email" tabindex="1"
                                                                           value="{{ old('email') }}"
                                                                           placeholder=""
                                                                           aria-label=""
                                                                    />
                                                                    <a id="changePassTarget-2" class="input-group-append input-group-text border-0" href="javascript:;">
                                                                        <i class="bi bi-envelope text-primary"></i>
                                                                    </a>
                                                                </fieldset>
                                                                @error('email')
                                                                <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                                                @enderror
                                                            </div>

                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-check mt-2 col-12">
                                                                <label class="form-check-label" for="remember_me">
                                                                    Allow Administrator to have Owner Permissions.
                                                                </label>
                                                                <input type="checkbox" class="form-check-input" name="remember_me" value="" id="remember_me">

                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row pt-2">
                                                        <div class="col-md-12">
                                                            <div class="">
                                                                <fieldset class="border-light input-group scheduler-border">
                                                                    <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0">Role</legend>
                                                                    <select class="form-control form-control-lg border-end-0"
                                                                            name="role"
                                                                            id="role" tabindex="1"
                                                                            value="{{ old('role') }}"
                                                                            placeholder=""
                                                                            aria-label=""
                                                                    >
                                                                        <option readonly="" value="">Please Select Role</option>
                                                                        <option value="Administrator">Administrator</option>
                                                                        <option value="Administrator">Guest</option>
                                                                        <option value="Administrator">Owner</option>
                                                                    </select>
                                                                </fieldset>
                                                                @error('role')
                                                                <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                                                @enderror
                                                            </div>

                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-check mt-2 col-12">
                                                                <label class="form-check-label" for="remember_me">
                                                                    Allow Administrator to have Owner Permissions.
                                                                </label>
                                                                <input type="checkbox" class="form-check-input" name="remember_me" value="" id="remember_me">

                                                            </div>
                                                        </div>

                                                    </div>
                                                    {{--     second row starts --}}

                                                    <div class="row">
                                                        <div class=" col-md-6">
                                                            <div class="mt-3">
                                                                <fieldset class="border-light input-group scheduler-border">
                                                                    <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0">First Name</legend>
                                                                    <input type="text" class="form-control form-control-lg border-end-0"
                                                                           name="first_name" value=""
                                                                           id="first_name" tabindex="1"
                                                                           placeholder=""
                                                                           value="{{$user->first_name}}"
                                                                           aria-label=""
                                                                    />
                                                                </fieldset>
                                                                @error('first_name')
                                                                <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class=" col-md-6">
                                                            <div class="mt-3">
                                                                <fieldset class="border-light input-group scheduler-border">
                                                                    <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0">Last Name</legend>
                                                                    <input type="text" class="form-control form-control-lg border-end-0"
                                                                           name="last_name" value=""
                                                                           id="last_name" tabindex="1"
                                                                           placeholder=""
                                                                           value="{{$user->last_name}}"
                                                                           aria-label=""
                                                                    />
                                                                </fieldset>
                                                                @error('last_name')
                                                                <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mt-3">
                                                                <fieldset class="border-light input-group scheduler-border">
                                                                    <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0">Create Password</legend>
                                                                    <input type="password"
                                                                           class="form-control form-control-lg border-end-0"
                                                                           name="password"
                                                                           value="{{old('password')}}"
                                                                           id="password"
                                                                           tabindex="1"
                                                                           placeholder=""
                                                                           aria-label=""
                                                                    >
                                                                    <a id="changePassTarget-2" class="input-group-append input-group-text border-0" href="javascript:;">
                                                                        <i class="bi-eye text-primary"></i>
                                                                    </a>
                                                                </fieldset>
                                                                @error('password')
                                                                <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                                                @enderror
                                                            </div>

                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="mt-3">
                                                                <fieldset class="border-light input-group scheduler-border">
                                                                    <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0">Confirm Password</legend>
                                                                    <input type="password"
                                                                           class="form-control form-control-lg border-end-0"
                                                                           name="password_confirmation"
                                                                           value="{{old('confirm_password')}}"
                                                                           id="password_confirmation"
                                                                           tabindex="1"
                                                                           placeholder=""
                                                                           aria-label=""
                                                                    >
                                                                    <a id="changePassTarget-2" class="input-group-append input-group-text border-0" href="javascript:;">
                                                                        <i class="bi-eye text-primary"></i>
                                                                    </a>
                                                                </fieldset>

                                                                @error('password_confirmation')
                                                                <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                                                @enderror

                                                            </div>

                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-check mt-2">
                                                                <label class="form-check-label" for="remember_me">
                                                                    I accept <a href="#" class="text-decoration-underline">Terms and Conditions</a>
                                                                </label>
                                                                <input type="checkbox" class="form-check-input" name="remember_me" value="" id="remember_me">

                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="text-center mt-3">
                                                        <button class="btn btn-dark-secondary text-white w-100" type="submit">Create Account</button>
                                                    </div>

                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->

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
