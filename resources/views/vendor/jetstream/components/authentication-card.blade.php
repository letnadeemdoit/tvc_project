<!-- Content -->
<div class="container-fluid px-2 overflow-hidden">
    <div class="row">
        <div
            class="col-lg-5 d-none d-lg-flex justify-content-center align-items-center min-vh-lg-100 position-relative bg-image px-0">
            <!-- Logo & Language -->
            <div class="position-absolute top-0 start-0 end-0 mt-3 mx-3">
                <div class="d-none d-lg-flex justify-content-between">
                    <a href="{{ url('/') }}">
                        <!-- <img class="w-100" src="{{ asset('logo/logo.png') }}" alt="Image Description"
                             data-hs-theme-appearance="default" style="min-width: 10rem; max-width: 10rem;"> -->
                        <h1 class="text-white p-5 poppins-bold">Vacation Calendar</h1>
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

