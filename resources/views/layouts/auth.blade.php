<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-TXFZXTWXFP"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-TXFZXTWXFP');
    </script>
    <!-- Start of HubSpot Embed Code -->
    <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/23120175.js"></script>
    <!-- End of HubSpot Embed Code -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <link rel="icon" type="image/x-icon" href="{{asset('logo/favicon.jpg')}}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/theme.css') }}">
    @livewireStyles
    @stack('stylesheets')

    <style>
        .fieldset.scheduler-border{
            margin-bottom: 5px !important;
        }
    </style>

</head>
<body>
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main" class="main pt-0">
        {{ $slot }}
    </main>
    <!-- ========== END MAIN CONTENT ========== -->
    @livewireScripts
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>

    @stack('scripts')
</body>
</html>
