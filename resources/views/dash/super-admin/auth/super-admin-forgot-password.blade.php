<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>The Vacation Calendar</title>

    <link rel="icon" type="image/x-icon" href="{{asset('logo/favicon.jpg')}}">

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
    <div class="position-fixed top-0 end-0 start-0 bg-img-start"
         style="background-image: url('{{ asset('images/login-back-card-img.svg')}}');height: 38rem"
    >
        <!-- Shape -->
        <div class="shape shape-bottom zi-1">
            <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1921 273">
                <polygon fill="#fff" points="0,273 1921,273 1921,0 "/>
            </svg>
        </div>
        <!-- End Shape -->
    </div>

    <!-- Content -->
    <div class="container py-5 py-sm-7" style="margin-top: 150px">
        <a class="d-flex justify-content-center mb-5" href="{{route('guest.welcome')}}">
            <img class="zi-2" src="{{asset('logo/logo.svg')}}" alt="Image Description" style="width: 16rem;">
        </a>

        <div class="mx-auto" style="max-width: 30rem;">
            <!-- Card -->
            <div class="card card-lg mb-5">
                <div class="card-body">
                    <!-- Form -->
                    <form action="{{route('password.email')}}" method="post">
                        @csrf
                        <div class="text-start">
                            <div class="mb-5">
                                <h1 class="display-5 poppins-bold">Reset Your <span
                                        class="text-primary">Password?</span></h1>
                                <p>{{ __('Don’t worry if you forget the password just enter your email.') }}</p>


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

{{--                                <x-jet-validation-errors class="mb-4"/>--}}


                            </div>

                            <input type="hidden" name="HouseId" value="0" />

                            <!-- Form -->
                            <div class="mb-4">
                                <label class="form-label" for="signinSrEmail">Super Admin Email Address</label>
                                <input type="email"
                                       class="form-control form-control-lg"
                                       name="email"
                                       value="{{ old('email') }}"
                                       required
                                       autofocus
                                       placeholder="Email"
                                       aria-label="email@address.com"
                                >

                                @error('email')
                                <span class="text-danger fw-semi-bold"
                                      style="font-size: 13px !important;">{{$message}}</span>
                                @enderror

                            </div>
                            <!-- End Form -->

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Email Password Reset Link</button>
                            </div>

                            <div class="">
                                <a class="btn btn-link text-secondary mt-3 d-flex align-items-center fw-normal justify-content-center"
                                   href="{{route('super-admin.login')}}"
                                >
                                    <img src="{{asset('/images/reset-password/back-arrow.png')}}" class="me-2"> Back to
                                    <span class="ms-1 fw-semibold text-primary text-decoration-underline">Login</span>
                                </a>
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
