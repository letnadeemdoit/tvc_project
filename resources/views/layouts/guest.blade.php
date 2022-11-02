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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"/>
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/theme.css') }}">
        @livewireStyles
        @stack('stylesheets')

        <style>

            .navbar-toggler {
                color: #e8604c !important;
                font-size: 30px!important;
            }

            @media (max-width: 992px) {
                .text-w-50 {
                    width: 100% !important;
                }
            }

            @media (max-width: 992px) {
                .guset-menu{
                    background-color: #e8604c05 !important;
                }
            }


        </style>

{{--        @dd(current_house())--}}
        @auth
            @if(isset(current_house()->image) && !is_null(current_house()->image) && current_house()->is_default_image === 1)
                <style>
                    .bulletin-image {
                        background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4)), url({{'/storage/'.current_house()->image}});
                        background-position: 50%;
                        background-repeat: no-repeat;
                        background-size: cover;
                        height: 180px;
                        background-color: #000000;
                    }

                </style>
            @else
                <style>
                    .bulletin-image {
                        background-image: url(/images/bulletin-images/bulletin.png);
                        background-position: 50%;
                        background-repeat: no-repeat;
                        background-size: cover;
                        height: 180px;
                    }
                </style>
            @endif
        @else
            <style>
                .bulletin-image {
                    background-image: url(/images/bulletin-images/bulletin.png);
                    background-position: 50%;
                    background-repeat: no-repeat;
                    background-size: cover;
                    height: 180px;
                }
            </style>
        @endauth

    </head>
    <body>
        <main class="bg-lightGrey" style="min-height: 100vh">
            @include('layouts.partials.navigation-menu-top-guest')
            {{ $slot }}
        </main>
        @include('layouts.partials.footer-guest')
    </body>
    @livewireScripts
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>

    @stack('scripts')

    <script>
        document.addEventListener('refresh-photos-list-in-album', function () {
            window.location.reload();
        })
    </script>

</html>
