<x-auth-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{--            <x-jet-authentication-card-logo />--}}
        </x-slot>

        <div
            class="w-100 content-space-t-4 content-space-t-lg-2 content-space-b-1" style="max-width: 30rem;"
            x-data="{
                gotoHouse: false,
                loginAsGuest: null,
                role: '{{ old('role', 'Guest') }}',
                houseIsSelected: false,
                house_id: null
            }"
            x-init="
                @if(old('role') !== null)
                    gotoHouse = true;
                    if (role === 'Guest') {
                        loginAsGuest = true
                    } else {
                        loginAsGuest = false
                    }
                @endif

                $('.select2').select2({
                    ajax: {
                    url: '{{ route('select2.houses') }}',
                    dataType: 'json'
                    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
                    }
                }).on('select2:select', function (e)  {
                    houseIsSelected = true;
                })
            "
        >
{{--            <x-jet-validation-errors class="mb-4"/>--}}

            @if (session('status'))
                <div
                    x-data="{ shown: false, timeout: null }"
                    x-init="clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 10000);"
                    x-show.transition.out.opacity.duration.1500ms="shown"
                    x-transition:leave.opacity.duration.1500ms
                    style="display: none;"
                    class="alert alert-soft-success text-center mb-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <!-- Form -->
            <form class="js-validate needs-validation" novalidate method="POST" action="{{ route('login') }}">
                @csrf
                <input type="hidden" x-model="role" name="role" />
                {{-- Search House --}}
                <div x-show="!gotoHouse">
                    <h1 class="display-3 poppins-bold mb-0">Search <span class="text-primary">House</span></h1>
                    <small class="text-muted mb-3 d-block">Search your house here to have beautiful vacations with your
                        family.</small>
                    <div class="bg-soft-primary p-3 rounded-1 border border-primary row g-2">
                        <div class="col-md-8">
                            <select class="form-control form-control-lg select2" name="house_id" x-model="house_id">
                                <option disabled selected>Search &amp; select your house</option>
                                @if(old('house_id') !== null)
                                    @php
                                        $selectedHouse = \App\Models\House::where('HouseID', old('house_id'))->first();
                                    @endphp
                                    @if($selectedHouse)
                                        <option value="{{ old('house_id') }}" selected>{{ $selectedHouse->HouseName }}</option>
                                    @endif
                                @endif
                            </select>
                        </div>
                        <div class="col-md-4 d-grid">
                            <button
                                class="btn btn-primary"
                                @click.prevent="gotoHouse = true"
                                x-bind:disabled="!houseIsSelected"
                            >
                                Go to House
                            </button>
                        </div>
                    </div>
                </div>
                <div x-show="gotoHouse" style="display: none">
                    {{-- Login Account --}}
                    <div x-show="loginAsGuest === null">
                        <div class="text-start">
                            <div class="mb-5 text-center">
                                <h1 class="display-5">Login Account</h1>
                                <span class="divider-center text-muted mt-4">as</span>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <a class="btn btn-dark-secondary btn-lg shadow-lg"
                                    @click.prevent="loginAsGuest = false; role = 'AdministratorOrGuest';">
                                {{ __('Administrator & Owner') }}
                            </a>
                            <a class="btn bg-light-primary border-solid btn-lg mt-3 text-dark"
                                    @click.prevent="loginAsGuest = true; role = 'Guest';">{{ __('Guest') }}</a>
                        </div>
                    </div>

                    <div x-show="loginAsGuest !== null" x-cloak>
                        {{-- Login Account --}}

                        <div class="text-start" x-show="loginAsGuest">
                            {{-- Guest --}}
                            <div class="mb-5">
                                <h1 class="display-5">Login Account <span class="text-primary">as Guest.</span></h1>
                                <p>{{ __('to get beautiful home for vacations to make your vacations memorable.') }}</p>
                            </div>
                        </div>
                        <div class="text-start" x-show="loginAsGuest === false">
                            {{-- Administrator --}}
                            <div class="mb-3">
                                <h1 class="display-5 lh-base">Login Account <br> <span class="text-primary">as Administrator & Owner</span>
                                </h1>
                                <p class="text-secondary">To keep track of your vacation home in use.</p>
                            </div>
                        </div>

                        <!-- Form -->
                        <div class="mb-4" x-show="loginAsGuest === false">
                            {{-- Administrator --}}
                            <fieldset class="input-group border rounded-1 ps-1">
                                <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Username</legend>
                                <input type="text"
                                       class="form-control form-control-lg border-0 shadow-none outline-0"
                                       name="email"
                                       value="{{ old('email') }}"
                                       id="email"
                                       tabindex="1"
                                       placeholder="johnsmith1234"
                                       aria-label="email@address.com"
                                       required/>
                                <a id="changePassTarget-2" class="input-group-append input-group-text border-0"
                                   style="outline-color: transparent !important;"
                                   href="javascript:;">
                                    <i class="bi bi-person text-primary"></i>
                                </a>
                            </fieldset>
                            @error('email')
                            <span class="text-danger fw-semi-bold"
                                  style="font-size: 13px !important;">{{$message}}</span>
                            @enderror

                            <span class="invalid-feedback">Please enter a valid email address.</span>
                        </div>
                        <!-- End Form -->

                        <!-- Form -->
                        <div class="mb-2" x-data="{showPassword: false}">
                            <!-- <div class="input-group input-group-merge" > -->
                            <fieldset class="input-group border-gray-600 border rounded-1 ps-1">
                                <legend class="float-none w-auto fs-5 px-2 mb-0 ms-1" x-show="loginAsGuest === true">
                                    Shared Password
                                </legend>
                                <legend class="float-none w-auto fs-5 px-2 mb-0 ms-1" x-show="loginAsGuest === false">
                                    Password
                                </legend>
                                <input type="password"
                                       x-bind:type="showPassword ? 'text' : 'password'"
                                       class="js-toggle-password form-control form-control-lg border-0 shadow-none outline-0"
                                       name="password"
                                       id="password"
                                       placeholder="8+ characters required"
                                       autocomplete="new-password"
                                       aria-label="8+ characters required"
                                       minlength="8"
                                       required
                                />
                                <a
                                    id="changePassTarget"
                                    class="input-group-append input-group-text border-0"
                                    style="outline-color: transparent !important;"
                                    href="javascript:;"
                                    @click.prevent="showPassword  = !showPassword"
                                >
                                    <i id="changePassIcon" class="bi-eye text-primary"
                                       :class="{'bi-eye-slash': showPassword, 'bi-eye': !showPassword}"></i>
                                </a>
                            </fieldset>
                            @error('password')
                            <span class="text-danger fw-semi-bold"
                                  style="font-size: 13px !important;">{{$message}}</span>
                            @enderror
                            <!-- </div> -->
                            <label class="form-label w-100 mt-3" for="password" tabindex="0"
                                   style="outline-color: transparent !important;"
                            >
                                <span class="float-end" x-show="loginAsGuest === false">
                                    @if (Route::has('password.request'))
                                        {{ __('Forget Password?') }}
                                        <a class="form-label-link mb-0 text-secondary fw-lighter"
                                           style="outline-color: transparent !important;"
                                           href="{{ route('password.request') }}">
                                            <span class="text-decoration-underline text-primary"> Reset</span>
                                        </a>
                                    @endif

                                </span>
                            </label>
                            <span class="invalid-feedback">Please enter a valid password.</span>
                        </div>
                        <!-- End Form -->

                        <div class="form-check mb-4">
                            <label class="form-check-label" for="remember_me">
                                {{ __('Remember me') }}
                            </label>
                            <input
                                type="checkbox"
                                class="form-check-input"
                                name="remember_me"
                                value="{{ old('remember_me') }}"
                                id="remember_me"
                            />

                        </div>

                        <div class="d-grid">
                            <button class="btn btn-dark-secondary btn-lg" type="submit">{{ __('Log in') }}</button>
                        </div>


                    </div>
                </div>
            </form>

            <div class="text-center mt-4">
                <p>Don't have an account?
                    <a href="{{ route('register') }}"
                       class="text-decoration-underline text-primary fw-bolder">Create
                        account</a></p>
            </div>
            <!-- End Form -->
        </div>

    </x-jet-authentication-card>
</x-auth-layout>
