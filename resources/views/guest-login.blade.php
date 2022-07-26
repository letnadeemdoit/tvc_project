<x-auth-layout>
    @include('layouts.partials.navigation-menu-top-guest')
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{--            <x-jet-authentication-card-logo />--}}
        </x-slot>
        <div class="w-100 content-space-t-4 content-space-t-lg-2 content-space-b-1" style="max-width: 25rem;">
            <div class="text-start">
                <div class="mb-5">
                    <h1 class="display-5 popping-bold">Login Account <span class="text-primary">as Guest.</span></h1>
                    <p>{{ __('to get beautiful home for vacations to make your vacations memorable.') }}</p>
                </div>
            </div>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <x-jet-validation-errors class="mb-4"/>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-4">
                    <fieldset class="border-light input-group scheduler-border">
                        <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0">{{ __('Shared Password') }}</legend>
                        <input
                            id="email"
                            class="form-control"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                        />
                        <a id="changePassTarget-2" class="input-group-append input-group-text border-0" href="javascript:;">
                            <i class="bi-eye text-primary"></i>
                        </a>
                    </fieldset>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-dark-secondary btn-lg">{{ __('Login') }}</button>

                    <div class="form-check mt-2">
                        <label class="form-check-label" for="remember_me">
                          Remember me
                        </label>
                        <input type="checkbox" class="form-check-input form-check-css" name="remember_me" value="" id="remember_me">

                    </div>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-auth-layout>
