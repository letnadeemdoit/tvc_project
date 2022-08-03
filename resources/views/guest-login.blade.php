<x-auth-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{--            <x-jet-authentication-card-logo />--}}
        </x-slot>
        <div class="w-100 content-space-t-4 content-space-t-lg-2 content-space-b-1" style="max-width: 25rem;">
            <div class="text-start">
                <div class="mb-5">
                    <h1 class="display-4 poppins-bold">Login Account <span class="text-primary">as Guest.</span></h1>
                    <p>{{ __('to get beautiful home for vacations to make your vacations memorable.') }}</p>
                </div>
            </div>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <x-jet-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mt-3">
                    <fieldset class="input-group rounded-1 ps-1">
                        <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Shared Password</legend>
                        <input type="password"
                               class="form-control form-control-lg border-0 shadow-none outline-0"
                               name="password"
                               id="password"
                               value="{{old('password')}}"
                               tabindex="1"
                               placeholder=""
                               aria-label=""
                               reuired
                               autofocus
                        />
                        <a id="changePassTarget-2" class="input-group-append input-group-text border-0"
                           href="javascript:;">
                            <i class="bi-eye text-primary"></i>
                        </a>
                    </fieldset>
                </div>

                <div class="d-grid gap-2 mt-3">
                    <button type="submit" class="btn btn-dark-secondary btn-lg">{{ __('Login') }}</button>

                    <div class="form-check mt-2">
                        <label class="form-check-label" for="remember_me">
                            Remember me
                        </label>
                        <input type="checkbox" class="form-check-input form-check-css" name="remember_me" value=""
                               id="remember_me">

                    </div>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-auth-layout>
