<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/theme.css') }}">
    @stack('stylesheets')
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

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

    @stack('scripts')

</body>
</html>
