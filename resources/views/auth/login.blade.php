<x-auth-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{--            <x-jet-authentication-card-logo />--}}

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
                <div class="text-start">
                    <div class="mb-3">
                        <h1 class="display-5 lh-base">Login Account <br> <span class="text-primary">as Administrator & Owner</span></h1>
                        <p class="text-secondary">To keep track of your vacation houme in use.</p>
                    </div>
                    <!-- <span class="divider-center text-muted mb-4">as</span> -->
                </div>

                <!-- Form -->
                <div class="mb-4">
                    <fieldset class="border-light input-group scheduler-border">
                        <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0">Username</legend>
                        <input type="text"
                               class="form-control form-control-lg border-end-0"
                               name="email"
                               value="{{ old('email') }}"
                               id="email"
                               tabindex="1"
                               placeholder="johnsmith1234"
                               aria-label="email@address.com"
                               required />
                        <a id="changePassTarget-2" class="input-group-append input-group-text border-0" href="javascript:;">
                            <i class="bi bi-person text-primary"></i>
                        </a>
                    </fieldset>

                    <span class="invalid-feedback">Please enter a valid email address.</span>
                </div>
                <!-- End Form -->

                <!-- Form -->
                <div class="mb-2">
                    <!-- <div class="input-group input-group-merge" > -->
                    <fieldset class="border-light  input-group scheduler-border">
                        <legend class="float-none w-auto fs-5 px-2 mb-0">Password</legend>
                        <input type="password"
                               class="js-toggle-password form-control form-control-lg border-end-0"
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
                                }'
                               required
                        />
                        <a id="changePassTarget" class="input-group-append input-group-text border-0" href="javascript:;">
                            <i id="changePassIcon" class="bi-eye text-primary"></i>
                        </a>
                    </fieldset>
                    <!-- </div> -->
                    <label class="form-label w-100 mt-3" for="password" tabindex="0">
                        <span class="float-end">
                            @if (Route::has('password.request'))
                                <a class="form-label-link mb-0 text-secondary fw-lighter"
                                   href="{{ route('password.request') }}">{{ __('Forget Password?') }}
                                    <span class="text-decoration-underline text-primary"> Reset</span>
                                </a>
                            @endif

                        </span>
                    </label>
                    <span class="invalid-feedback">Please enter a valid password.</span>
                </div>
                <!-- End Form -->



                <div class="d-grid">
                    <button type="submit" class="btn btn-dark-secondary btn-lg">{{ __('Log in') }}</button>
                </div>
                <!-- Form Check -->
                <div class="form-check mt-4">
                    <label class="form-check-label" for="remember_me">
                        {{ __('Remember me') }}
                    </label>
                    <input
                        type="checkbox"
                        class="form-check-input"
                        name="remember_me"
                        value="{{ old('remember_me') }}"
                        id="remember_me">

                </div>
                <!-- End Form Check -->
                <div class="text-center mt-3">
                    <p>Don't have an account? <span class="text-decoration-underline text-primary fw-bolder">Create account</span></p>
                </div>
            </form>
            <!-- End Form -->
        </div>
    </x-jet-authentication-card>
</x-auth-layout>
