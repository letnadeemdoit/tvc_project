<x-auth-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{--            <x-jet-authentication-card-logo />--}}

            <div style="max-width: 23rem;">
                <div class="text-center mb-5">
                    <img class="img-fluid" src="{{ asset('img/svg/illustrations/oc-chatting.svg') }}"
                         alt="Image Description"
                         style="width: 12rem;"
                         data-hs-theme-appearance="default"
                    />
                    {{--                    <img class="img-fluid" src="{{ asset('img/svg/illustrations-light/oc-chatting.svg') }}"--}}
                    {{--                         alt="Image Description" style="width: 12rem;"--}}
                    {{--                         data-hs-theme-appearance="dark"--}}
                    {{--                    />--}}
                </div>

                <div class="mb-5">
                    <h2 class="display-5">Build digital products with:</h2>
                </div>

                <!-- List Checked -->
                <ul class="list-checked list-checked-lg list-checked-primary list-py-2">
                    <li class="list-checked-item">
                        <span class="d-block fw-semi-bold mb-1">All-in-one tool</span>
                        Build, run, and scale your apps - end to end
                    </li>

                    <li class="list-checked-item">
                        <span class="d-block fw-semi-bold mb-1">Easily add &amp; manage your services</span>
                        It brings together your tasks, projects, timelines, files and more
                    </li>
                </ul>
                <!-- End List Checked -->

                <div class="row justify-content-between mt-5 gx-3">
                    <div class="col">
                        <img class="img-fluid" src="{{ asset('img/svg/brands/gitlab-gray.svg') }}" alt="Logo">
                    </div>
                    <!-- End Col -->

                    <div class="col">
                        <img class="img-fluid" src="{{ asset('img/svg/brands/fitbit-gray.svg') }}" alt="Logo">
                    </div>
                    <!-- End Col -->

                    <div class="col">
                        <img class="img-fluid" src="{{ asset('img/svg/brands/flow-xo-gray.svg') }}" alt="Logo">
                    </div>
                    <!-- End Col -->

                    <div class="col">
                        <img class="img-fluid" src="{{ asset('img/svg/brands/layar-gray.svg') }}" alt="Logo">
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>
        </x-slot>

        <div class="content-space-t-4 content-space-t-lg-2 content-space-b-1 vh-100 overflow-scroll scrollbar-none"
             style="max-width: 32rem;">

            <!-- Form -->
            <x-jet-validation-errors class="mb-4"/>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif
            <form class="js-validate needs-validation" novalidate action="{{ route('register') }}">
                @csrf
                <div class="text-center">
                    <div class="mb-5">
                        <h1 class="display-5">Create your account</h1>
                        <p>
                            Already have an account? <a class="link" href="{{ route('login') }}"> Sign in here</a>
                        </p>
                    </div>

                    <div class="d-grid mb-4">
                        <a class="btn btn-white btn-lg" href="#">
                                <span class="d-flex justify-content-center align-items-center">
                                  <img class="avatar avatar-xss me-2"
                                       src="{{ asset('img/svg/brands/google-icon.svg') }}"
                                       alt="Image Description"/>
                                  Sign up with Google
                                </span>
                        </a>
                    </div>

                    <span class="divider-center text-muted mb-4">OR</span>
                </div>

                <!-- Form -->
                <div class="row pt-2">
                    <div class="col-md-12">
                        <!-- Form -->
                        <div class="mb-2">
                            <label class="form-label" for="house_name">House Name:*</label>
                            <input
                                type="text"
                                class="form-control form-control-lg"
                                name="house_name"
                                id="house_name"
                                placeholder="Enter House Name"
                                value="{{old('house_name')}}"
                                required
                            />
                        </div>
                        <!-- End Form -->
                    </div>
                </div>
                {{--     second row starts --}}

                <div class="mb-2">
                    <label class="form-label" for="guest_password">Guest Password:*</label>
                    <input
                        type="password"
                        class="form-control form-control-lg"
                        name="guest_password"
                        id="guest_password"
                        placeholder="Enter Guest Password"
                        value="{{ old('guest_password') }}"
                        required
                    />
                </div>
                <!-- End Form -->

                <div class="mb-2">
                    <div class="form-group">
                        <label class="form-label" for="password_field_2">Confirm Password:*</label>
                        <input
                            id="password_field_2"
                            type="password"
                            class="form-control form-control-lg"
                            placeholder="Confirm Password"
                            name="password_field_2"
                            value="{{old('password_field_2')}}"
                            required
                        />
                        <span toggle="#password-field-2"
                              class="fa-regular fa-eye field-icon toggle-password me-2"></span>
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label" for="address_line_1">Address Line 1:*</label>
                    <input
                        type="text"
                        class="form-control form-control-lg"
                        value="{{ old('address_line_1') }}"
                        id="address_line_1"
                        placeholder="Address Line 1"
                        required
                    />
                </div>

                <div class="mb-2">
                    <label class="form-label" for="address_line_2">Address Line 2</label>
                    <input
                        type="text"
                        class="form-control form-control-lg"
                        id="address_line_2"
                        placeholder="Address Line 2"
                        value="{{old('address_line_2')}}"
                        required
                    />
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label class="form-label" for="city">City</label>
                            <input
                                type="text"
                                class="form-control form-control-lg"
                                id="city"
                                placeholder="City"
                                value="{{ old('city') }}"
                                required
                            />
                        </div>
                    </div>
                    <div class=" col-md-6">
                        <div class="mb-2">
                            <label class="form-label" for="state">State</label>
                            <input
                                type="text"
                                class="form-control form-control-lg" name="state"
                                id="state"
                                placeholder="State"
                                value="{{ old('state') }}"
                                aria-label=""
                                required
                            />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label class="form-label" for="zipcode">Zipcode</label>
                            <input
                                type="number"
                                class="form-control form-control-lg"
                                id="zipcode"
                                placeholder="Enter Zipcode"
                                value="{{old('zipcode')}}"
                                required
                            />
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label class="form-label" for="home_phone">Home Phone</label>
                            <input
                                type="text"
                                class="form-control form-control-lg"
                                name="home_phone"
                                id="home_phone"
                                placeholder="Enter Home Phone"
                                value="{{old('home_phone')}}"
                                aria-label=""
                                required
                            />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class=" col-md-6">
                        <div class="mb-2">
                            <label class="form-label" for="Fax">Fax</label>
                            <input
                                type="number"
                                class="form-control form-control-lg"
                                id="Fax"
                                placeholder="Fax"
                                value="{{old('Fax')}}"
                                required
                            />
                        </div>

                    </div>
                    <div class=" col-md-6">
                        <div class="mb-2">
                            <label class="form-label" for="emergency_phone">Emergency Phone</label>
                            <input
                                type="number"
                                class="form-control form-control-lg"
                                name="emergency_phone"
                                id="emergency_phone"
                                placeholder="Enter Emergency Phone"
                                value="{{old('emergency_phone')}}"
                                aria-label=""
                                required
                            />
                        </div>

                    </div>
                </div>

                <div class="text-center">
                    <p>Referral Info
                        Please provide the PayPal account of the person that referred you to
                        TheVacationCalendar.com. They will receive $5 via PayPal after this account remains
                        open beyond the initial free trial period. Please note that the referral PayPal
                        account cannot be the same as the account used to activate this house. Additionally,
                        please note that standard PayPal service charges will be applied to the the $5.
                    </p>
                </div>

                <div class="mb-2">
                    <label for="paypal">Paypal Account</label>
                    <input
                        type="text"
                        class="form-control form-control-lg"
                        id="paypal"
                        name="paypal"
                        placeholder="Paypal Account"
                        value="{{old('paypal')}}"
                        required
                    />
                </div>
                <div class="mb-2">
                    <label for="form_File" class="form-label fs-5">House Picture</label>
                    <input class="form-control"
                           type="file"
                           id="formFile"
                           value="{{old('form_File')}}"/>
                </div>

                <div class="mb-2">
                    <label for="admin_username" class="form-label fs-5">Admin Username</label>
                    <input class="form-control form-control-lg"
                           type="text"
                           placeholder="Admin Username"
                           value="{{old('admin_username')}}"
                           id="admin_username"/>
                </div>
                <div class="mb-2">
                    <label for="admin_password" class="form-label fs-5">Admin Password</label>
                    <input type="text"
                           class="form-control form-control-lg"
                           placeholder="Admin Password"
                           id="admin_password"
                           value="{{old('admin_password')}}"
                           required/>
                </div>

                <div class="mb-2">
                    <label for="admin_password_confirm" class="form-label fs-5">Admin
                        Password(Confirm*)</label>
                    <input type="text"
                           class="form-control form-control-lg"
                           placeholder="Confirm Admin Password"
                           id="admin_password_confirm"
                           value="{{old('admin_password_confirm')}}"
                           required/>
                </div>

                <div class="mb-2">
                    <label for="admin_email" class="form-label fs-5">Admin Email</label>
                    <input type="text"
                           class="form-control form-control-lg"
                           placeholder="Enter Admin Email"
                           id="admin_email"
                           value="{{old('admin_email')}}"
                           required/>
                </div>

                <div class="my-3">
                    <div class="form-group">
                        Allow Administrator to have Owner permissions
                        <input type="checkbox" name="AdminOwner">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <!-- Form -->
                        <div class="mb-4">
                            <label class="form-label" for="name">First Name</label>
                            <input type="text"
                                   class="form-control form-control-lg"
                                   name="name"
                                   value="{{old('name')}}"
                                   id="name"
                                   placeholder="First Name"
                                   aria-label=""
                                   autofocus
                                   autocomplete="name" required/>
                            <span class="invalid-feedback">Please enter your first name.</span>
                        </div>
                        <!-- End Form -->
                    </div>

                    <div class="col-sm-6">
                        <!-- Form -->
                        <div class="mb-4">
                            <label class="form-label" for="last_name">Last Name</label>
                            <input type="text"
                                   class="form-control form-control-lg"
                                   placeholder="Last Name"
                                   aria-label=""
                                   id="last_name"
                                   value="{{old('last_name')}}"
                                   required/>
                            <span class="invalid-feedback">Please enter your last name.</span>
                        </div>
                        <!-- End Form -->
                    </div>
                </div>
                <!-- End Form -->

                <!-- Form -->
                <div class="mb-4">
                    <label class="form-label" for="zipcode_2">Zip Code</label>
                    <input type="number"
                           class="form-control form-control-lg"
                           id="zipcode_2"
                           value="{{old('zipcode_2')}}"
                           placeholder="Enter Zip Code"
                           aria-label=""
                           required/>
                </div>
                <!-- End Form -->

                <!-- Form -->
                <div class="mb-4">
                    <label class="form-label" for="home-phone-2">Home Phone</label>

                    <div class="input-group input-group-merge" data-hs-validation-validate-class>
                        <input type="number"
                               class="js-toggle-password form-control form-control-lg"
                               name="home_phone_2"
                               id="home_phone_2"
                               placeholder="8+ characters required"
                               value="{{old('home_phone_2')}}"
                               aria-label="8+ characters required"
                               minlength="8"
                               autocomplete="new-password"/>
                    </div>

                    <span class="invalid-feedback">Your password is invalid. Please try again.</span>
                </div>
                <!-- End Form -->

                <!-- Form -->
                <div class="mb-4">
                    <label class="form-label" for="password_confirmation">Fax</label>

                    <div class="input-group input-group-merge" data-hs-validation-validate-class>
                        <input type="number"
                               class="js-toggle-password form-control form-control-lg"
                               name="fax_2"
                               id="fax_2"
                               placeholder="8+ characters required"
                               aria-label=""
                               value="{{old('fax_2')}}"
                               minlength="8" required/>

                    </div>
                </div>
                <!-- Form Check -->
                <div class="form-check mb-4">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="terms_Checkbox"
                        value="{{old('terms_Checkbox')}}"
                        required
                    />
                    <label class="form-check-label" for="terms_Checkbox">
                        I accept the <a href="#">Terms and Conditions</a>
                    </label>
                    <span class="invalid-feedback">Please accept our Terms and Conditions.</span>
                </div>
                <!-- End Form Check -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">Create an account</button>

                    <button type="submit" class="btn btn-link">
                        or Start your 30-day trial <i class="bu-chevron-right"></i>
                    </button>
                </div>

            </form>
            <!-- End Form -->
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
</x-auth-layout>
