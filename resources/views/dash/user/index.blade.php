<x-app-layout>

    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Users</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="javascript:;"
                       data-bs-toggle="modal" data-bs-target="#createUser">
                        <i class="bi-plus me-1"></i> Add New User
                    </a>
                </div>

                <!-- End Col -->
            </div>

            <h5 class="mb-0 text-capitalize">{{Auth::user()->user_name ?? 'User Name'}}</h5>
            <!-- End Row -->
        </div>



        <!-- End Page Header -->

        @livewire('users.display-as-list')
    </div>



    <!-- Modal -->
    <div class="modal fade" id="createUser" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Create New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class=""  action="{{ route('users.store') }}" method="post">
                        @csrf
                        <fieldset class="scheduler-border fieldset-padding">
                            <legend class="scheduler-border">House Details</legend>
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
                                                value="{{old('HouseName')}}"
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
                                                value="{{ old('city') }}"
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
                                                class="form-control" name="State"
                                                id="State"
                                                placeholder="State"
                                                value="{{ old('state') }}"
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
                                                value="{{old('ReferredBy')}}"
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
                                                   value="{{ old('first_name') }}"
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
                                                   value="{{ old('last_name') }}"
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

</x-app-layout>
