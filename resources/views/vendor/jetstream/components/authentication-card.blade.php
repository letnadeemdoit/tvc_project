<!-- Content -->
@push('stylesheets')
    <style>

        bg-image-properties{
            background-position: 50%;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .bg-search-house{
            background: url(/images/login-images/search-house.png);
        }
        .bg-login{
            background: url(/images/login-images/login.png);
        }

        .bg-register{
            background: url(/images/login-images/register.png);
        }

        .bg-owner-login{
            background: url(/images/login-images/owner-login.png);
        }

        .bg-guest-login{
            background: url(/images/login-images/guest-login.png);
        }

        .bg-email-password{
            background: url(/images/login-images/reset-password.png);
        }


    </style>
@endpush
<div class="container-fluid px-2 overflow-hidden" style="height: 100vh">


    <div class="row"
         @if(request()->routeIs('login'))
             x-data="{ imgClasses: ['bg-search-house','bg-login','bg-owner-login','bg-guest-login']  }"
             @update-image.window="imgClasses.map(c=>{$refs.image_container.classList.remove(c)});$refs.image_container.classList.add($event.detail)"
         @endif
    >
        <div
            class="col-lg-5 d-none d-lg-flex justify-content-center align-items-center min-vh-lg-100
            position-relative bg-image-properties px-0
             @if(request()->routeIs('login'))
             bg-search-house
             @elseif(request()->routeIs('password.request') || request()->routeIs('password.reset'))
             bg-email-password
             @elseif(request()->routeIs('register'))
                bg-register
             @else
                bg-search-house
             @endif
"
        x-ref="image_container"
        >
            <!-- Logo & Language -->
            <div class="position-absolute top-0 start-0 end-0 mt-3 mx-3">
                <div class="d-none d-lg-flex justify-content-between">
                    <a href="{{ url('/') }}">
                        <!-- <img class="w-100" src="{{ asset('logo/logo.png') }}" alt="Image Description"
                             data-hs-theme-appearance="default" style="min-width: 10rem; max-width: 10rem;"> -->
                        <h1 class="display-4 text-white p-5 poppins-bold">Vacation Calendar</h1>
                        {{--                        <img class="w-100" src="./assets/svg/logos-light/logo.svg" alt="Image Description"--}}
                        {{--                             data-hs-theme-appearance="dark" style="min-width: 7rem; max-width: 7rem;">--}}
                    </a>

                    <!-- Select -->
{{--                    <div class="tom-select-custom tom-select-custom-end tom-select-custom-bg-transparent zi-2">--}}
{{--                        <select class="js-select form-select form-select-sm form-select-borderless text-white"--}}
{{--                                data-hs-tom-select-options='{--}}
{{--                          "searchInDropdown": false,--}}
{{--                          "hideSearch": true,--}}
{{--                          "dropdownWidth": "12rem",--}}
{{--                          "placeholder": "Select language"--}}
{{--                        }'>--}}
{{--                            <option value="language2" selected--}}
{{--                                    data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="/images/vendor/flag-icon-css/flags/1x1/gb.svg" alt="Image description" width="16"/><span>English (UK)</span></span>'>--}}
{{--                                English (UK)--}}
{{--                            </option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
                    <!-- End Select -->
                </div>
            </div>
            <!-- End Logo & Language -->
            {{ $logo }}
        </div>
        <!-- End Col -->

        <div class="col-lg-7 d-flex justify-content-center align-items-center min-vh-100">
            {{ $slot }}
        </div>
        <!-- End Col -->
    </div>
    <!-- End Row -->
</div>
<!-- End Content -->

