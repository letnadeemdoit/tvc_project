<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>The Vacation Calendar</title>

    <link rel="icon" type="image/x-icon" href="{{asset('logo/favicon.svg')}}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"/>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/theme.css') }}">
    @livewireStyles
    @stack('stylesheets')

    <style>

        .navbar-toggler {
            color: #e8604c !important;
            font-size: 30px !important;
        }

        @media (max-width: 992px) {
            .text-w-50 {
                width: 100% !important;
            }
        }

        @media (max-width: 992px) {
            .guset-menu {
                background-color: #e8604c05 !important;
            }
        }


    </style>
</head>
<body>
<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main" class="main">
{{--    <div class="position-fixed top-0 end-0 start-0 bg-img-start"--}}
{{--         style="height: 32rem; background-image: url('images/login-back-card-img.svg')">--}}
{{--        <!-- Shape -->--}}
{{--        <div class="shape shape-bottom zi-1">--}}
{{--            <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1921 273">--}}
{{--                <polygon fill="#fff" points="0,273 1921,273 1921,0 "/>--}}
{{--            </svg>--}}
{{--        </div>--}}
{{--        <!-- End Shape -->--}}
{{--    </div>--}}

    <!-- Content -->
    <div class="container py-5 py-sm-7" style="margin-top: 150px">
        <a class="d-flex justify-content-center mb-5" href="./index.html">
            <img class="zi-2" src="{{asset('logo/logo.svg')}}" alt="Image Description" style="width: 16rem;">
        </a>

        <div class="mx-auto" style="max-width: 30rem;">
            <!-- Card -->
            <div class="card card-lg mb-5">
                <div class="card-body">
                    <!-- Form -->
                    <form action="{{route('super-admin.login-super-admin')}}" method="post">
                        @csrf
                        <div class="text-start">
                            <div class="mb-5">
                                <h1 class="display-5">Login</h1>
                                {{--                                <p>Don't have an account yet? <a class="link" href="./authentication-signup-basic.html">Sign up here</a></p>--}}
                            </div>

                            <!-- Form -->
                            <div class="mb-4">
                                <label class="form-label" for="signinSrEmail">Your email</label>
                                <input type="email" class="form-control form-control-lg" name="email" id="signinSrEmail"
                                       tabindex="1" placeholder="email" aria-label="email@address.com"
                                       required>
                                <span class="invalid-feedback">Please enter a valid email address.</span>
                            </div>
                            <!-- End Form -->

                            <!-- Form -->
                            <div class="mb-4">
                                <label class="form-label w-100" for="signupSrPassword" tabindex="0">
                                      <span class="d-flex justify-content-between align-items-center">
                                        <span>Password</span>
                                      </span>
                                </label>

                                <div class="input-group input-group-merge" data-hs-validation-validate-class>
                                    <input type="password" class="js-toggle-password form-control form-control-lg"
                                           name="password" id="signupSrPassword" placeholder="password"
                                           aria-label="8+ characters required" required minlength="8"
                                           data-hs-toggle-password-options='{
                                           "target": "#changePassTarget",
                                           "defaultClass": "bi-eye-slash",
                                           "showClass": "bi-eye",
                                           "classChangeTarget": "#changePassIcon"
                                         }'>
                                    <a id="changePassTarget" class="input-group-append input-group-text"
                                       href="javascript:;">
                                        <i id="changePassIcon" class="bi-eye"></i>
                                    </a>
                                </div>

                                <span class="invalid-feedback">Please enter a valid password.</span>
                            </div>
                            <!-- End Form -->

                            <!-- Form Check -->
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" value="" id="termsCheckbox">
                                <label class="form-check-label" for="termsCheckbox">
                                    Remember me
                                </label>
                            </div>
                            <!-- End Form Check -->

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Sign in</button>
                            </div>
                        </div>
                    </form>
                    <!-- End Form -->
                </div>
            </div>
            <!-- End Card -->

        </div>
    </div>
    <!-- End Content -->
</main>
<!-- ========== END MAIN CONTENT ========== -->
</body>
@livewireScripts
<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>

@stack('scripts')
</html>
