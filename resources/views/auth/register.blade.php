<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
{{--            <x-jet-authentication-card-logo />--}}
            <div class="position-absolute top-0 start-0 end-0 mt-3 mx-3">
                <div class="d-none d-lg-flex justify-content-between">
                    <a href="./index.html">
                        <img class="w-100" src="./assets/svg/logos/logo.svg" alt="Image Description" data-hs-theme-appearance="default" style="min-width: 7rem; max-width: 7rem;">
                        <img class="w-100" src="./assets/svg/logos-light/logo.svg" alt="Image Description" data-hs-theme-appearance="dark" style="min-width: 7rem; max-width: 7rem;">
                    </a>

                    <!-- Select -->
                    <div class="tom-select-custom tom-select-custom-end tom-select-custom-bg-transparent">
                        <select class="js-select form-select form-select-sm form-select-borderless" data-hs-tom-select-options='{
                          "searchInDropdown": false,
                          "hideSearch": true,
                          "dropdownWidth": "12rem",
                          "placeholder": "Select language"
                        }'>
                            <option label="empty"></option>
                            <option value="language1" data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/us.svg" alt="Image description" width="16"/><span>English (US)</span></span>'>English (US)</option>
                            <option value="language2" selected data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/gb.svg" alt="Image description" width="16"/><span>English (UK)</span></span>'>English (UK)</option>
                            <option value="language3" data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/de.svg" alt="Image description" width="16"/><span>Deutsch</span></span>'>Deutsch</option>
                            <option value="language4" data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/dk.svg" alt="Image description" width="16"/><span>Dansk</span></span>'>Dansk</option>
                            <option value="language5" data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/es.svg" alt="Image description" width="16"/><span>Español</span></span>'>Español</option>
                            <option value="language6" data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/nl.svg" alt="Image description" width="16"/><span>Nederlands</span></span>'>Nederlands</option>
                            <option value="language7" data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/it.svg" alt="Image description" width="16"/><span>Italiano</span></span>'>Italiano</option>
                            <option value="language8" data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/cn.svg" alt="Image description" width="16"/><span>中文 (繁體)</span></span>'>中文 (繁體)</option>
                        </select>
                    </div>
                    <!-- End Select -->
                </div>
            </div>
        {{--     Logos       --}}

            <div style="max-width: 23rem;">
                <div class="text-center mb-5">
                    <img class="img-fluid" src="./assets/svg/illustrations/oc-chatting.svg" alt="Image Description" style="width: 12rem;" data-hs-theme-appearance="default">
                    <img class="img-fluid" src="./assets/svg/illustrations-light/oc-chatting.svg" alt="Image Description" style="width: 12rem;" data-hs-theme-appearance="dark">
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
                        <img class="img-fluid" src="./assets/svg/brands/gitlab-gray.svg" alt="Logo">
                    </div>
                    <!-- End Col -->

                    <div class="col">
                        <img class="img-fluid" src="./assets/svg/brands/fitbit-gray.svg" alt="Logo">
                    </div>
                    <!-- End Col -->

                    <div class="col">
                        <img class="img-fluid" src="./assets/svg/brands/flow-xo-gray.svg" alt="Logo">
                    </div>
                    <!-- End Col -->

                    <div class="col">
                        <img class="img-fluid" src="./assets/svg/brands/layar-gray.svg" alt="Logo">
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>
        </x-slot>
{{--        new html --}}
        <div class="col-lg-12 d-flex justify-content-center align-items-center min-vh-lg-100">
            <div class="w-100 content-space-t-4 content-space-t-lg-2 content-space-b-1" style="max-width: 32rem;">
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
                            <p>Already have an account? <a class="link" href="./authentication-login-cover.html">Sign in here</a></p>
                        </div>

                        <div class="d-grid mb-4">
                            <a class="btn btn-white btn-lg" href="#">
                    <span class="d-flex justify-content-center align-items-center">
                      <img class="avatar avatar-xss me-2" src="./assets/svg/brands/google-icon.svg" alt="Image Description">
                      Sign up with Google
                    </span>
                            </a>
                        </div>

                        <span class="divider-center text-muted mb-4">OR</span>
                    </div>



                    <!-- Form -->
                {{--        first row            --}}
                    <div class="row pt-2">
                        <div class="col-md-12">
                            <!-- Form -->
                            <div class="mb-2">
                                <label class="form-label" for="housename">House Name</label>
                                <input type="text" class="form-control form-control-lg" name="housename"
                                       id="housename" placeholder="Enter House Name" required>
                            </div>
                            <!-- End Form -->
                        </div>
                    </div>
        {{--          first row ends     --}}
                {{--     second row starts --}}
                    <div class="row pt-2">
                        <div class="col-md-12">
                            <div class="mb-2">
                                <label class="form-label" for="guestpassword">Guest Password</label>
                                <input type="password" class="form-control form-control-lg" name="guestpassword"
                                       id="guestpassword" placeholder="Enter Guest Password" required>
                            </div>
                            <!-- End Form -->
                        </div>
                    </div>
                    {{--     second row ends    --}}

                    {{--     Third Row     --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-2">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="form-label" for="password-field-2">Confirm Password</label>
                                        <input id="password-field-2" type="password" class="form-control form-control-lg"
                                               name="password" value="secret">
                                        <span toggle="#password-field-2"
                                              class="fa-regular fa-eye field-icon toggle-password me-2"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  -->
                    {{--     Third Row Ends               --}}
                        {{--            fourth row starts            --}}
                        <div class="row">
                          <div class=" col-md-12">
                              <div class="mb-2">
                                  <label class="form-label" for="Addressline1">Address Line 1</label>
                                  <input type="text" class="form-control form-control-lg" id="Addressline1"
                                         placeholder="Address Line 1" required>
                              </div>

                          </div>
                        </div>

                        {{--         fourth row ends               --}}
                        <div class="row">
                            <div class=" col-md-12">
                                <div class="mb-2">
                                    <label class="form-label" for="Addressline2">Address Line 2</label>
                                    <input type="text" class="form-control form-control-lg" id="Addressline2"
                                           placeholder="Address Line 2" required>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class=" col-md-6">
                                <div class="mb-2">
                                     <label class="form-label" for="city">City</label>
                                    <input type="text" class="form-control form-control-lg" id="city"
                                           placeholder="City" required>
                                </div>

                            </div>
                            <div class=" col-md-6">
                                <div class="mb-2">
                                    <label class="form-label" for="state">State</label>
                                    <input type="text" class="form-control form-control-lg" name="state"
                                           id="state" placeholder="State" aria-label=""
                                           required>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class=" col-md-6">
                                <div class="mb-2">
                                    <label class="form-label" for="city">Zip Code</label>
                                    <input type="number" class="form-control form-control-lg" id="zipcode"
                                           placeholder="Enter Zipcode" required>
                                </div>

                            </div>
                            <div class=" col-md-6">
                                <div class="mb-2">
                                    <label class="form-label" for="homephone">Home Phone</label>
                                    <input type="text" class="form-control form-control-lg" name="state"
                                           id="homephone" placeholder="Enter Home Phone" aria-label=""
                                           required>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class=" col-md-6">
                                <div class="mb-2">
                                    <label class="form-label" for="Fax">Fax</label>
                                    <input type="number" class="form-control form-control-lg" id="Fax"
                                           placeholder="Fax" required>
                                </div>

                            </div>
                            <div class=" col-md-6">
                                <div class="mb-2">
                                    <label class="form-label" for="emergencyphone">Emergency Phone</label>
                                    <input type="number" class="form-control form-control-lg" name="emergencyphone"
                                           id="emergencyphone" placeholder="Enter Emergency Phone" aria-label=""
                                           required>
                                </div>

                            </div>
                        </div>
                        <!-- Form Check -->
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" value="" id="termsCheckbox" required>
                            <label class="form-check-label" for="termsCheckbox">
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
                        <div class="text-center">
                            <p>Referral Info
                                Please provide the PayPal account of the person that referred you to
                                TheVacationCalendar.com. They will receive $5 via PayPal after this account remains
                                open beyond the initial free trial period. Please note that the referral PayPal
                                account cannot be the same as the account used to activate this house. Additionally,
                                please note that standard PayPal service charges will be applied to the the $5.
                            </p>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <label for="paypal">Paypal Account</label>
                                    <input type="text" class="form-control form-control-lg" id="paypal" name="paypal"
                                           placeholder="Paypal Account" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <label for="formFile" class="form-label fs-5">House Picture</label>
                                    <input class="form-control" type="file" id="formFile">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <label for="adminusername" class="form-label fs-5">Admin Username</label>
                                    <input class="form-control form-control-lg" type="text" id="adminusername">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <label for="adminpassword" class="form-label fs-5">Admin Password</label>
                                    <input class="form-control form-control-lg" type="text" id="adminpassword">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <label for="adminpasswordconfirm" class="form-label fs-5">Admin Password(Confirm*)</label>
                                    <input class="form-control form-control-lg" type="text" id="adminpasswordconfirm">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <label for="adminemail" class="form-label fs-5">Admin Email</label>
                                    <input class="form-control form-control-lg" type="text" id="adminemail">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <div class="form-group">
                                        Allow Administrator to have Owner permissions
                                        <input type="checkbox" name="AdminOwner">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-sm-6">
                            <!-- Form -->
                            <div class="mb-4">
                                <label class="form-label" for="name">First Name</label>
                                <input type="text" class="form-control form-control-lg" name="name" :value="old('name')" id="name" placeholder="First Name" aria-label="Mark" required autofocus autocomplete="name">
                                <span class="invalid-feedback">Please enter your first name.</span>
                            </div>
                            <!-- End Form -->
                        </div>

                        <div class="col-sm-6">
                            <!-- Form -->
                            <div class="mb-4">
                                <label class="form-label" for="lastname">Last Name</label>
                                <input type="text" class="form-control form-control-lg" placeholder="Last Name" aria-label="" id="lastname" required>
                                <span class="invalid-feedback">Please enter your last name.</span>
                            </div>
                            <!-- End Form -->
                        </div>
                    </div>
                    <!-- End Form -->

                    <!-- Form -->
                    <div class="mb-4">
                        <label class="form-label" for="zipcode-2">Zip Code</label>
                        <input type="number" class="form-control form-control-lg" name="zipcode-2" id="zipcode-2" placeholder="Enter Zip Code" aria-label="" required>
                    </div>
                    <!-- End Form -->

                    <!-- Form -->
                    <div class="mb-4">
                        <label class="form-label" for="homephone-2">Home Phone</label>

                        <div class="input-group input-group-merge" data-hs-validation-validate-class>
                            <input type="number" class="js-toggle-password form-control form-control-lg" name=homephone-2 id="homephone-2" placeholder="8+ characters required" aria-label="8+ characters required" required minlength="8"  autocomplete="new-password">
                        </div>

                        <span class="invalid-feedback">Your password is invalid. Please try again.</span>
                    </div>
                    <!-- End Form -->

                    <!-- Form -->
                    <div class="mb-4">
                        <label class="form-label" for="password_confirmation">Fax</label>

                        <div class="input-group input-group-merge" data-hs-validation-validate-class>
                            <input type="number" class="js-toggle-password form-control form-control-lg" name="fax-2" id="fax-2" placeholder="8+ characters required" aria-label="8+ characters required" required minlength="8" >

                        </div>
                    </div>
                    <!-- End Form -->


                </form>
                <!-- End Form -->
            </div>
        </div>


{{--      ends  --}}
        <x-jet-validation-errors class="mb-4" />

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
</x-guest-layout>
