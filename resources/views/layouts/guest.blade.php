<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>The Vacation Calendar</title>
        <link rel="icon" type="image/x-icon" href="/logo/logo.svg">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
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
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox-plus-jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    @stack('scripts')
</html>
