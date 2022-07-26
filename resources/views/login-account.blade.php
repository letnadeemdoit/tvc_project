<x-auth-layout>
    @include('layouts.partials.navigation-menu-top-guest')
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{--            <x-jet-authentication-card-logo />--}}
        </x-slot>
        <div class="w-100 content-space-t-4 content-space-t-lg-2 content-space-b-1" style="max-width: 23rem;">
            <div class="text-start">
                <div class="mb-5 text-center">
                    <h1 class="display-4 popping-bold">Login Account.</h1>
                    <span class="divider-center text-muted mt-4">as</span>
                </div>
            </div>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <x-jet-validation-errors class="mb-4"/>

            <form>
                @csrf
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-dark-secondary btn-lg shadow-lg">{{ __('Administrator & Owner') }}</button>
                    <button type="submit" class="btn bg-light-primary border-solid btn-lg mt-3 text-dark">{{ __('Guest') }}</button>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-auth-layout>
