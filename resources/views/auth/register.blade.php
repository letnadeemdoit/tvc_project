<x-auth-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{--            <x-jet-authentication-card-logo />--}}
        </x-slot>

        <div class="w-100 content-space-t-4 content-space-t-lg-2 content-space-b-1" style="max-width: 30rem;">

            <!-- Form -->
            {{--            <x-jet-validation-errors class="mb-4"/>--}}

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif
            <div class="mb-5">
                <h1 class="display-4 fw-bold mb-0">Create your <span class="text-primary">Account.</span></h1>
                <small class="text-muted mb-3 d-block">To keep track of your vacation home in use.</small>
            </div>

            <form class="" action="{{ route('register') }}" method="post">
                @csrf
                <fieldset class=" border rounded-1 p-3 mb-5">
                    <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">House Details</legend>
                    <!-- Form -->
                    <div class="pt-2 mb-3">
                        <fieldset class="input-group border rounded-1 ps-1">
                            <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">House Name*</legend>
                            <input
                                type="text"
                                class="form-control form-control-lg border-0 shadow-none outline-0"
                                name="HouseName"
                                id="HouseName"
                                placeholder="Enter House Name"
                                value="{{old('HouseName')}}"
                            />
                        </fieldset>
                        @error('HouseName')
                        <span class="text-danger fw-semi-bold"
                              style="font-size: 13px !important;">{{$message}}</span>
                        @enderror


                    </div>
                    {{--     second row starts --}}

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <fieldset class="input-group border rounded-1 ps-1">
                                <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">City</legend>
                                <input
                                    type="text"
                                    class="form-control form-control-lg border-0 shadow-none outline-0"
                                    id="city"
                                    name="City"
                                    placeholder="City"
                                    value="{{ old('city') }}"
                                />

                            </fieldset>
                            @error('City')
                            <span class="text-danger fw-semi-bold"
                                  style="font-size: 13px !important;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <fieldset class="input-group border rounded-1 ps-1">
                                <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">State</legend>
                                <input
                                    type="text"
                                    class="form-control form-control-lg border-0 shadow-none outline-0"
                                    name="State"
                                    id="State"
                                    placeholder="State"
                                    value="{{ old('state') }}"
                                    aria-label=""
                                />
                            </fieldset>
                            @error('State')
                            <span class="text-danger fw-semi-bold"
                                  style="font-size: 13px !important;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <fieldset class="input-group border rounded-1 ps-1">
                            <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Paypal Account</legend>
                            <input
                                type="number"
                                class="form-control form-control-lg border-0 shadow-none outline-0"
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
                    <div class="mb-2">
                        <div id="basicExampleDropzone"
                             class="js-dropzone row dz-dropzone dz-dropzone-card border-primary bg-primary-light mx-auto">
                            <div class="dz-message">
                                <h5>Drag and drop your file here</h5>
                                <p class="mb-2">or</p>
                                <span class="btn bg-primary btn-sm text-white">Upload Image</span>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <!-- End Form -->
                <!-- second fieldset -->
                <fieldset class="border rounded-1 p-3 mb-3">
                    <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Admin Details</legend>
                    <!-- Form -->
                    <div class="row pt-2">
                        <div class="col-md-12">
                            <!-- Form -->
                            <div class="mb-2">
                                <fieldset class="input-group border rounded-1 ps-1">
                                    <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Username</legend>
                                    <input type="text"
                                           class="form-control form-control-lg border-0 shadow-none outline-0"
                                           name="user_name"
                                           id="user_name" tabindex="1"
                                           placeholder=""
                                           value="{{ old('user_name') }}"
                                           aria-label=""
                                    />
                                    <a id="changePassTarget-2" class="input-group-append input-group-text border-0"
                                       href="javascript:;">
                                        <i class="bi bi-person text-primary"></i>
                                    </a>
                                </fieldset>
                                @error('user_name')
                                <span class="text-danger fw-semi-bold"
                                      style="font-size: 13px !important;">{{$message}}</span>
                                @enderror
                            </div>
                            <!-- End Form -->
                        </div>
                    </div>
                    {{--     second row starts --}}

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mt-3">
                                <fieldset class="input-group border rounded-1 ps-1">
                                    <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Email</legend>
                                    <input type="email"
                                           class="form-control form-control-lg border-0 shadow-none outline-0"
                                           name="email"
                                           id="email" tabindex="1"
                                           value="{{ old('email') }}"
                                           placeholder=""
                                           aria-label=""
                                    />
                                    <a id="changePassTarget-2" class="input-group-append input-group-text border-0"
                                       href="javascript:;">
                                        <i class="bi bi-envelope text-primary"></i>
                                    </a>
                                </fieldset>
                                @error('email')
                                <span class="text-danger fw-semi-bold"
                                      style="font-size: 13px !important;">{{$message}}</span>
                                @enderror
                            </div>

                            <input type="hidden" name="role" value="Administrator">

                            <div class="form-check mt-2">
                                <label class="form-check-label" for="remember_me">
                                    Allow Administrator to have Owner Permissions.
                                </label>
                                <input type="checkbox" class="form-check-input" name="remember_me" value=""
                                       id="remember_me">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-md-6">
                            <div class="mt-3">
                                <fieldset class="input-group border rounded-1 ps-1">
                                    <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">First Name</legend>
                                    <input type="text"
                                           class="form-control form-control-lg border-0 shadow-none outline-0"
                                           name="first_name"
                                           id="first_name" tabindex="1"
                                           placeholder=""
                                           value="{{ old('first_name') }}"
                                           aria-label=""
                                    />
                                </fieldset>
                                @error('first_name')
                                <span class="text-danger fw-semi-bold"
                                      style="font-size: 13px !important;">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="mt-3">
                                <fieldset class="input-group border rounded-1 ps-1">
                                    <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Last Name</legend>
                                    <input type="text"
                                           class="form-control form-control-lg border-0 shadow-none outline-0"
                                           name="last_name"
                                           id="last_name" tabindex="1"
                                           placeholder=""
                                           value="{{ old('last_name') }}"
                                           aria-label=""
                                    />
                                </fieldset>
                                @error('last_name')
                                <span class="text-danger fw-semi-bold"
                                      style="font-size: 13px !important;">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mt-3">
                                <fieldset class="input-group border rounded-1 ps-1">
                                    <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Create Password</legend>
                                    <input type="password"
                                           class="form-control form-control-lg border-0 shadow-none outline-0"
                                           name="password"
                                           value="{{old('password')}}"
                                           id="password"
                                           tabindex="1"
                                           placeholder=""
                                           aria-label=""
                                    >
                                    <a id="changePassTarget-2" class="input-group-append input-group-text border-0"
                                       href="javascript:;">
                                        <i class="bi-eye text-primary"></i>
                                    </a>
                                </fieldset>
                                @error('password')
                                <span class="text-danger fw-semi-bold"
                                      style="font-size: 13px !important;">{{$message}}</span>
                                @enderror
                            </div>

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mt-3">
                                <fieldset class="input-group border rounded-1 ps-1">
                                    <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Confirm Password</legend>
                                    <input type="password"
                                           class="form-control form-control-lg border-0 shadow-none outline-0"
                                           name="password_confirmation"
                                           id="password_confirmation"
                                           tabindex="1"
                                           placeholder=""
                                           aria-label=""
                                    >
                                    <a id="changePassTarget-2" class="input-group-append input-group-text border-0"
                                       href="javascript:;">
                                        <i class="bi-eye text-primary"></i>
                                    </a>
                                </fieldset>

                                @error('password_confirmation')
                                <span class="text-danger fw-semi-bold"
                                      style="font-size: 13px !important;">{{$message}}</span>
                                @enderror

                                <div class="form-check mt-2">
                                    <label class="form-check-label" for="remember_me">
                                        I accept <a href="#" class="text-decoration-underline">Terms and Conditions</a>
                                    </label>
                                    <input type="checkbox" class="form-check-input" name="remember_me" value=""
                                           id="remember_me">

                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="text-center mt-3">
                        <button class="btn btn-dark-secondary text-white w-100" type="submit">Create Account</button>
                    </div>

                </fieldset>
            </form>


            <div class="text-center">
                <p>Already have an account?<a href="{{route('login')}}" class="text-decoration-underline text-primary">Login</a>
                </p>
            </div>
            <!-- second fieldset ends -->
        </div>
    </x-jet-authentication-card>

{{--    @push('scripts')--}}
{{--        <script>--}}
{{--            $(function() {--}}
{{--                // INITIALIZATION OF DROPZONE--}}
{{--                // =======================================================--}}
{{--                HSCore.components.HSDropzone.init('.js-dropzone', {--}}
{{--                    url: "{{ route('register') }}",--}}
{{--                });--}}
{{--            });--}}
{{--        </script>--}}
{{--    @endpush--}}
</x-auth-layout>
