<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
        {{--            <x-jet-authentication-card-logo />--}}
        <!-- Logo & Language -->
            <div class="position-absolute top-0 start-0 end-0 mt-3 mx-3">
                <div class="d-none d-lg-flex justify-content-between">
                    <a href="./index.html">
                        <img class="w-100" src="./assets/svg/logos/logo.svg" alt="Image Description"
                             data-hs-theme-appearance="default" style="min-width: 7rem; max-width: 7rem;">
                        <img class="w-100" src="./assets/svg/logos-light/logo.svg" alt="Image Description"
                             data-hs-theme-appearance="dark" style="min-width: 7rem; max-width: 7rem;">
                    </a>

                    <!-- Select -->
                    <div class="tom-select-custom tom-select-custom-end tom-select-custom-bg-transparent zi-2">
                        <select class="js-select form-select form-select-sm form-select-borderless"
                                data-hs-tom-select-options='{
                          "searchInDropdown": false,
                          "hideSearch": true,
                          "dropdownWidth": "12rem",
                          "placeholder": "Select language"
                        }'>
                            <option label="empty"></option>
                            <option value="language1"
                                    data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/us.svg" alt="Image description" width="16"/><span>English (US)</span></span>'>
                                English (US)
                            </option>
                            <option value="language2" selected
                                    data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/gb.svg" alt="Image description" width="16"/><span>English (UK)</span></span>'>
                                English (UK)
                            </option>
                            <option value="language3"
                                    data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/de.svg" alt="Image description" width="16"/><span>Deutsch</span></span>'>
                                Deutsch
                            </option>
                            <option value="language4"
                                    data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/dk.svg" alt="Image description" width="16"/><span>Dansk</span></span>'>
                                Dansk
                            </option>
                            <option value="language5"
                                    data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/es.svg" alt="Image description" width="16"/><span>Español</span></span>'>
                                Español
                            </option>
                            <option value="language6"
                                    data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/nl.svg" alt="Image description" width="16"/><span>Nederlands</span></span>'>
                                Nederlands
                            </option>
                            <option value="language7"
                                    data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/it.svg" alt="Image description" width="16"/><span>Italiano</span></span>'>
                                Italiano
                            </option>
                            <option value="language8"
                                    data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/cn.svg" alt="Image description" width="16"/><span>中文 (繁體)</span></span>'>
                                中文 (繁體)
                            </option>
                        </select>
                    </div>
                    <!-- End Select -->
                </div>
            </div>
            <!-- End Logo & Language -->

            <div style="max-width: 23rem;">
                <div class="text-center mb-5">
                    <img class="img-fluid" src="./assets/svg/illustrations/oc-chatting.svg" alt="Image Description"
                         style="width: 12rem;" data-hs-theme-appearance="default">
                    <img class="img-fluid" src="./assets/svg/illustrations-light/oc-chatting.svg"
                         alt="Image Description" style="width: 12rem;" data-hs-theme-appearance="dark">
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

        <div class="w-100 content-space-t-4 content-space-t-lg-2 content-space-b-1" style="max-width: 25rem;">
            <x-jet-validation-errors class="mb-4"/>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif
            <!-- Form -->
            <form class="js-validate needs-validation" novalidate method="POST" action="{{ route('login') }}">
                @csrf
                <div class="text-center">
                    <div class="mb-5">
                        <h1 class="display-5">Sign in</h1>
                        <p>Don't have an account yet? <a class="link" href="./authentication-signup-cover.html">Sign
                                up here</a></p>
                    </div>

                    <div class="d-grid mb-4">
                        <a class="btn btn-white btn-lg" href="#">
                    <span class="d-flex justify-content-center align-items-center">
                      <img class="avatar avatar-xss me-2" src="./assets/svg/brands/google-icon.svg"
                           alt="Image Description">
                      Sign in with Google
                    </span>
                        </a>
                    </div>

                    <span class="divider-center text-muted mb-4">OR</span>
                </div>

                <!-- Form -->
                <div class="mb-4">
                    <label class="form-label" for="email">{{ __('Email') }}</label>
                    <input type="email"
                           class="form-control form-control-lg"
                           name="email"
                           value="{{ old('email') }}"
                           id="email"
                           tabindex="1"
                           placeholder="email@address.com"
                           aria-label="email@address.com"
                           required />
                    <span class="invalid-feedback">Please enter a valid email address.</span>
                </div>
                <!-- End Form -->

                <!-- Form -->
                <div class="mb-4">
                    <label class="form-label w-100" for="password" tabindex="0">
                  <span class="d-flex justify-content-between align-items-center">
                    <span>{{ __('Password') }}</span>
                      @if (Route::has('password.request'))
                          <a class="form-label-link mb-0"
                             href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                    </a>
                      @endif

                  </span>
                    </label>

                    <div class="input-group input-group-merge" data-hs-validation-validate-class>
                        <input type="password"
                               class="js-toggle-password form-control form-control-lg"
                               name="password"
                               id="password"
                               placeholder="8+ characters required"
                               value="{{ old('password') }}"
                               autocomplete="current-password"
                               aria-label="8+ characters required"
                               minlength="8"
                               data-hs-toggle-password-options='{
                           "target": "#changePassTarget",
                           "defaultClass": "bi-eye-slash",
                           "showClass": "bi-eye",
                           "classChangeTarget": "#changePassIcon"
                         }'  required />
                        <a id="changePassTarget" class="input-group-append input-group-text" href="javascript:;">
                            <i id="changePassIcon" class="bi-eye"></i>
                        </a>
                    </div>

                    <span class="invalid-feedback">Please enter a valid password.</span>
                </div>
                <!-- End Form -->

                <!-- Form Check -->
                <div class="form-check mb-4">
                    <input
                        type="checkbox"
                        class="form-check-input"
                           name="remember_me"
                        value="{{ old('remember_me') }}"
                           id="remember_me">
                    <label class="form-check-label" for="remember_me">
                        {{ __('Remember me') }}
                    </label>
                </div>
                <!-- End Form Check -->

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">{{ __('Log in') }}</button>
                </div>
            </form>
            <!-- End Form -->
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
