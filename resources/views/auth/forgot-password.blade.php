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
        <div class="w-100 content-space-t-4 content-space-t-lg-2 content-space-b-1" style="max-width: 25rem;">
            <div class="text-center">
                <div class="mb-5">
                    <h1 class="display-5">Forgot password?</h1>
                    <p>{{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
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
                    <label for="email" class="form-label">{{ __('Email:*') }}</label>
                    <input
                        id="email"
                        class="form-control form-control-lg"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    />
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">{{ __('Email Password Reset Link') }}</button>

                    <div class="text-center">
                        <a class="btn btn-link" href="{{ route('login') }}">
                            <i class="bi-chevron-left"></i> Back to Sign in
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-auth-layout>
