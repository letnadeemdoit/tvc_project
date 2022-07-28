<x-auth-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{--            <x-jet-authentication-card-logo />--}}
        </x-slot>

        <div class="content-space-t-4 content-space-t-lg-2 content-space-b-1 vh-100 overflow-scroll scrollbar-none"
             style="max-width: 35rem;">

            <!-- Form -->
{{--            <x-jet-validation-errors class="mb-4"/>--}}

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif
            <div class="mb-5">
                <h1 class="display-5">Create your <span class="text-primary">Account</span></h1>
                <p>
                    To keep track of your vacation houme in use.
                </p>
            </div>

            <form class=""  action="{{ route('register') }}" method="post">
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
                                        name="HouseID"
                                        id="HouseID"
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
                                        class="form-control" name="state"
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
                                <img class="avatar avatar-xl avatar-4x3 mb-3" src="../assets/svg/illustrations/oc-browse.svg" alt="Image Description">

                                <h5>Drag and drop your file here</h5>

                                <p class="mb-2">or</p>

                                <input type="file" name="img">

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
                        <div class="col-md-12">
                            <!-- Form -->
                            <div class="mb-2">
                                <fieldset class="border-light input-group scheduler-border">
                                    <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0">Username</legend>
                                    <input type="text" class="form-control form-control-lg border-end-0"
                                           name="text"
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
                    </div>
                    {{--     second row starts --}}

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mt-3">
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
                            <div class="form-check mt-2">
                                <label class="form-check-label" for="remember_me">
                                    Allow Administrator to have Owner Permissions.
                                </label>
                                <input type="checkbox" class="form-check-input" name="remember_me" value="" id="remember_me">

                            </div>
                        </div>
                    </div>
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
                        <div class="col-md-12">
                            <div class="mt-3">
                                <fieldset class="border-light input-group scheduler-border">
                                    <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0">Create Password</legend>
                                    <input type="text"
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

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mt-3">
                                <fieldset class="border-light input-group scheduler-border">
                                    <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0">Confirm Password</legend>
                                    <input type="text"
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

                                <div class="form-check mt-2">
                                    <label class="form-check-label" for="remember_me">
                                        I accept <a href="#" class="text-decoration-underline">Terms and Conditions</a>
                                    </label>
                                    <input type="checkbox" class="form-check-input" name="remember_me" value="" id="remember_me">

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
                <p>Already have an account?<a href="{{route('login')}}" class="text-decoration-underline text-primary">Login</a></p>
            </div>
            <!-- second fieldset ends -->
        </div>


        {{--      ends  --}}
        {{--        <x-jet-validation-errors class="mb-4" />--}}

        {{--        <form method="POST" action="{{ route('register') }}">--}}
        {{--            @csrf--}}

        {{--            <div>--}}
        {{--                <x-jet-label for="name" value="{{ __('Name') }}" />--}}
        {{--                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />--}}
        {{--            </div>--}}

        {{--            <div class="mt-4">--}}
        {{--                <x-jet-label for="email" value="{{ __('Email') }}" />--}}
        {{--                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />--}}
        {{--            </div>--}}

        {{--            <div class="mt-4">--}}
        {{--                <x-jet-label for="password" value="{{ __('Password') }}" />--}}
        {{--                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />--}}
        {{--            </div>--}}

        {{--            <div class="mt-4">--}}
        {{--                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />--}}
        {{--                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />--}}
        {{--            </div>--}}

        {{--            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())--}}
        {{--                <div class="mt-4">--}}
        {{--                    <x-jet-label for="terms">--}}
        {{--                        <div class="flex items-center">--}}
        {{--                            <x-jet-checkbox name="terms" id="terms"/>--}}

        {{--                            <div class="ml-2">--}}
        {{--                                {!! __('I agree to the :terms_of_service and :privacy_policy', [--}}
        {{--                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',--}}
        {{--                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',--}}
        {{--                                ]) !!}--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </x-jet-label>--}}
        {{--                </div>--}}
        {{--            @endif--}}

        {{--            <div class="flex items-center justify-end mt-4">--}}
        {{--                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">--}}
        {{--                    {{ __('Already registered?') }}--}}
        {{--                </a>--}}

        {{--                <x-jet-button class="ml-4">--}}
        {{--                    {{ __('Register') }}--}}
        {{--                </x-jet-button>--}}
        {{--            </div>--}}
        {{--        </form>--}}
    </x-jet-authentication-card>

    @push('scripts')


        <script src="{{asset('admin/assets/vendor/dropzone/dist/min/dropzone.min.js')}}"></script>

        <script>
            (function() {
                // INITIALIZATION OF DROPZONE
                // =======================================================
                HSCore.components.HSDropzone.init('.js-dropzone')
            });
        </script>


    @endpush
</x-auth-layout>
