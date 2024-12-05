<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- End of HubSpot Embed Code -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>The Vacation Calendar</title>

    <link rel="stylesheet" href="{{ mix('css/theme.css') }}">
    @livewireStyles
    @stack('stylesheets')
    <style>
        .container {
            max-width: 1200px;
        }
        .body-spacing {
            margin-top: 35px;
            padding-left: 25px;
            padding-right: 25px;
            color: #2A3342;
        }
        @media (max-width: 1024px) {
            .container {
                max-width: 900px;
            }
        }
        @media (max-width: 768px) {
            .container {
                max-width: 676px;
            }
        }
        @media (max-width: 500px) {
            .container {
                max-width: 100%;
                padding: 0;
            }
        }

    </style>

</head>
<body>
<div class="container my-4">
    <!-- Include Header -->
    @include('partials.email-header')

    <!-- Welcome Message Section -->
    <div class="body-spacing">
        {{ $slot }}
        <!-- Rest of your content -->
    </div>

    <!-- Include Footer -->
    @include('partials.email-footer')
</div>
</body>

@livewireScripts
<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>

@stack('scripts')
</html>
