<x-auth-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{--            <x-jet-authentication-card-logo />--}}
        </x-slot>
        <div class="w-100 content-space-t-2 content-space-t-lg-2 content-space-b-1" style="max-width: 25rem;">
            <div class="d-flex justify-content-start align-items-start">
                <img class="" src="{{ asset('logo/logo.jpg') }}"
                     alt="{{ config('app.name') }}" width="300px"/>
            </div>
            <div class="text-start content-space-t-1">
                <div class="mb-5">
                    <h1 class="display-5 poppins-bold">Reset Your <span class="text-primary">Password?</span></h1>
                    <p>{{ __('Don’t worry if you forget the password just enter your email.') }}</p>
                </div>
            </div>

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

            <x-jet-validation-errors class="mb-4"/>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf


                <input type="hidden" name="HouseId" value="{{ request()->get('h', -1) }}" />

                <div class="mb-4">
                    <fieldset class="input-group border rounded-1 ps-1">
                        <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">{{ __('Admin Email Address') }}</legend>
                        <input
                            id="email"
                            class="form-control form-control-lg border-0 shadow-none outline-0"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                        />
                        <a id="changePassTarget-2" class="input-group-append input-group-text border-0"
                           style="outline-color: transparent !important;"
                           href="javascript:;">
                            <i class="bi bi-envelope text-primary"></i>
                        </a>
                    </fieldset>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-dark-secondary btn-lg">{{ __('Email Password Reset Link') }}</button>

                    <div class="text-center mt-3">
                        <a class="btn btn-link text-secondary d-flex align-items-center fw-normal justify-content-center" href="{{ route('login') }}">
                            <img src="{{asset('/images/reset-password/back-arrow.png')}}" class="me-2"> Back to <span class="ms-1 fw-semibold text-primary text-decoration-underline">Login</span>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-auth-layout>
