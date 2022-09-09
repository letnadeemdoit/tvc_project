<x-auth-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{--            <x-jet-authentication-card-logo />--}}
        </x-slot>
        <div class="w-100 content-space-t-4 content-space-t-lg-2 content-space-b-1" style="max-width: 25rem;">
            <div class="text-start">
                <div class="mb-5">
                    <h1 class="display-5">Reset Your <span class="text-primary">Password?</span></h1>
                    <p>{{ __('Please add new and confirm password to continue.') }}</p>
                </div>
            </div>

            <x-jet-validation-errors class="mb-4"/>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}" />
                <input type="hidden" name="HouseId" value="{{ $request->get('h', -1) }}" />
                <div class="mb-4">
                    {{-- Administrator --}}
                    <fieldset class="input-group border rounded-1 ps-1">
                        <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Email</legend>
                        <input type="text"
                               class="form-control form-control-lg border-0 shadow-none outline-0"
                               name="email"
                               value="{{ old('email', $request->email) }}"
                               id="email"
                               tabindex="1"
                               placeholder="johnsmith1234"
                               aria-label="email@address.com"
                               required/>
                        <a id="changePassTarget-2" class="input-group-append input-group-text border-0"
                           href="javascript:;">
                            <i class="bi bi-person text-primary"></i>
                        </a>
                    </fieldset>

                    <span class="invalid-feedback">Please enter a valid email address.</span>
                </div>
                <div class="mb-2" x-data="{showPassword: false}">
                    <!-- <div class="input-group input-group-merge" > -->
                    <fieldset class="input-group border-gray-600 border rounded-1 ps-1">
                        <legend class="float-none w-auto fs-5 px-2 mb-0 ms-1">
                            Password
                        </legend>
                        <input type="password"
                               x-bind:type="showPassword ? 'text' : 'password'"
                               class="js-toggle-password form-control form-control-lg border-0 shadow-none outline-0"
                               name="password"
                               id="password"
                               tabindex="2"
                               placeholder="8+ characters required"
                               autocomplete="new-password"
                               aria-label="8+ characters required"
                               minlength="8"
                               required
                        />
                        <a
                            id="changePassTarget"
                            class="input-group-append input-group-text border-0"
                            href="javascript:;"
                            @click.prevent="showPassword  = !showPassword"
                        >
                            <i id="changePassIcon" class="bi-eye text-primary"
                               :class="{'bi-eye-slash': showPassword, 'bi-eye': !showPassword}"></i>
                        </a>
                    </fieldset>
                    <!-- </div> -->
                    <label class="form-label w-100 mt-3" for="password" tabindex="0">
                    <span class="float-end" x-show="loginAsGuest === false">
                        @if (Route::has('password.request'))
                            {{ __('Forget Password?') }}
                            <a class="form-label-link mb-0 text-secondary fw-lighter"
                               href="{{ route('password.request') }}">
                                <span class="text-decoration-underline text-primary"> Reset</span>
                            </a>
                        @endif

                    </span>
                    </label>
                    <span class="invalid-feedback">Please enter a valid password.</span>
                </div>
                <div class="mb-2" x-data="{showPassword: false}">
                    <!-- <div class="input-group input-group-merge" > -->
                    <fieldset class="input-group border-gray-600 border rounded-1 ps-1">
                        <legend class="float-none w-auto fs-5 px-2 mb-0 ms-1">
                            Confirm Password
                        </legend>
                        <input type="password"
                               x-bind:type="showPassword ? 'text' : 'password'"
                               class="js-toggle-password form-control form-control-lg border-0 shadow-none outline-0"
                               name="password_confirmation"
                               id="password_confirmation"
                               placeholder="8+ characters required"
                               autocomplete="new-password"
                               aria-label="8+ characters required"
                               minlength="8"
                               tabindex="3"
                               required
                        />
                        <a
                            id="changePassTarget"
                            class="input-group-append input-group-text border-0"
                            href="javascript:;"
                            @click.prevent="showPassword  = !showPassword"
                        >
                            <i id="changePassIcon" class="bi-eye text-primary"
                               :class="{'bi-eye-slash': showPassword, 'bi-eye': !showPassword}"></i>
                        </a>
                    </fieldset>
                    <!-- </div> -->
                    <label class="form-label w-100 mt-3" for="password" tabindex="0">
                    <span class="float-end" x-show="loginAsGuest === false">
                        @if (Route::has('password.request'))
                            {{ __('Forget Password?') }}
                            <a class="form-label-link mb-0 text-secondary fw-lighter"
                               href="{{ route('password.request') }}">
                                <span class="text-decoration-underline text-primary"> Reset</span>
                            </a>
                        @endif

                    </span>
                    </label>
                    <span class="invalid-feedback">Please enter a valid password.</span>
                </div>

                <div class="text-center mt-3">
                    <button class="btn btn-dark-secondary text-white w-100" type="submit">Reset Password</button>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-auth-layout>
